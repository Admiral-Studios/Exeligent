<?php

namespace App\Services;

use App\Imports\LinkedInContactsImport;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ContactService
{

    const PER_PAGE = 20;

    public function getQuery(Request $request)
    {
        $query = Auth::user()->contacts()->select('*');
        $search_name = $request->get('search_name');
        $search_company = $request->get('search_company');
        $search_position = $request->get('search_position');
        $search_status = $request->get('search_status');
        $search_type = $request->get('search_type');
        $search_connected = $request->get('search_connected');
        if ($search_connected) {
            $search_connected_from = trim(Carbon::parse(explode('-', $search_connected)[0]) ?? now());
            $search_connected_to = trim(Carbon::parse(explode('-', $search_connected)[1]) ?? now());
        }

        if ($search_name || $search_company) {
            $query->where(function ($query) use ($search_name, $search_company) {
                if ($search_name) {
                    $query->where('first_name', 'LIKE', "%{$search_name}%")
                        ->orWhere('last_name', 'LIKE', "%{$search_name}%");
                }

                if ($search_company) {
                    $query->where('company', 'LIKE', "%{$search_company}%");
                }
            });
        }

        if ($search_position)
            $query->where('position', 'LIKE', "%$search_position%");

        if ($search_status) {
            if ($search_status === 'none')
                $query->whereNull('status');
            else
                $query->where('status', $search_status);
        }

        if ($search_type) {
            if ($search_type === 'none')
                $query->whereNull('type');
            else
                $query->where('type', $search_type);
        }

        if ($search_connected)
            $query->whereBetween('contacted_at', [
                $search_connected_from,
                $search_connected_to
            ]);

        $sort_by = $request->get('sort_by');
        if ($sort_by) {
            list($sort_name, $sort_direction) = explode(':', $sort_by);
            if (in_array($sort_direction, ['desc', 'asc'])) {
                $query->orderBy($sort_name, $sort_direction);
            }
        }

        return $query;
    }

    public function getContactsByStatus($request, $status = null, $page = 0)
    {
        $query = $this->getQuery($request);

        if ($status)
            $query->where('status', $status);

        return $query->paginate(self::PER_PAGE, $page);
    }

    public function getAjaxPaginatedContacts(Request $request)
    {
        if ($request->has('name') && $request->get('name') == 'page') {
            $page = $request->get('page');
            return $this->getContactsByStatus($request, $request->get('status'), $page);
        }
    }

    public function store(array $data): ?Contact
    {
        $data['user_id'] = Auth::id();

        try {
            $contact = Contact::create($data);
            activity('contacts')
                ->log("Added new contact");

            return $contact;
        } catch (\Exception $exception) {
            Session::flash('error', "ERROR: {$exception->getMessage()}");
            return null;
        }
    }

    public function update(array $data, Contact $contact): ?Contact
    {
        try {
            $contact->update($data);
            activity('contacts')
                ->log("User updated contact (ID:{$contact->id})");

            return $contact;
        } catch (\Exception $exception) {
            Session::flash('error', "ERROR: {$exception->getMessage()}");
            return null;
        }
    }

    public function import($user_id, array $data)
    {
        try {
            if (isset($data['import_connections'])) {
                Excel::import(new LinkedInContactsImport($user_id),
                    $data['import_connections'],
                    null,
                    \Maatwebsite\Excel\Excel::CSV);

                activity('contacts')
                    ->log('Imported contacts from LinkedIn');

                unset($data['import_connections']);
            }

            $data = array_map(function ($item) {
                return Arr::whereNotNull($item);
            }, $data); // clear NULL values

            if (isset($data['first_name']) && count($data['first_name']) > 0) {
                foreach ($data['first_name'] as $i => $first_name) {
                    $this->store([
                        'first_name' => $first_name,
                        'last_name' => $data['last_name'][$i]
                    ]);
                }
            }

            return true;
        } catch (\Exception $exception) {
            Session::flash('error', 'ERROR: ' . $exception->getMessage());
            return false;
        }
    }

    public function getSortOptions()
    {
        return [
            'contacted_at:desc' => 'Contacted at - new ones first',
            'contacted_at:asc' => 'Contacted at - old ones first',
            'first_name:desc' => 'First Name - Z-a',
            'first_name:asc' => 'First Name - A-z',
            'last_name:desc' => 'Last Name - Z-a',
            'last_name:asc' => 'Last Name - A-z',
            'company:desc' => 'Company - Z-a',
            'company:asc' => 'Company - A-z',
            'position:desc' => 'Position - Z-a',
            'position:asc' => 'Position - A-z',
            'type:desc' => 'Type - 9-1',
            'type:asc' => 'Type - 1-9',
        ];
    }

}
