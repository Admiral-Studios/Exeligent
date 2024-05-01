<?php

namespace App\Exports;

use App\Models\Contact;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ContactsExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Auth::user()->contacts;
    }

    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'Company',
            'Position',
            'Contact Method',
            'Location',
            'Relationship',
            'Contacted At',
            'Status',
            'Goal Of Contact',
            'Notes'
        ];
    }

    public function map($row): array
    {
        return [
            $row->first_name,
            $row->last_name,
            $row->company,
            $row->position,
            $row->contact_method,
            $row->location,
            $row->relationship_title,
            $row->iso_contacted_at,
            $row->status_title,
            $row->goal_title,
            $row->notes
        ];
    }
}
