<?php

namespace App\Imports;

use App\Models\Contact;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithStartRow;

class LinkedInContactsImport implements ToModel, WithStartRow, WithCustomCsvSettings
{

    public function startRow(): int {
        return 5;
    }

    public function __construct($user_id) {
        $this->user_id = $user_id;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ','
        ];
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (empty($row[0]) || empty($row[1]))
            return null;

        return new Contact([
            "user_id" => $this->user_id,
            "first_name" => $row[0],
            "last_name" => $row[1],
            "email" => $row[3] ?? '',
            "company" => $row[4] ?? '',
            "position" => $row[5] ?? '',
            "contacted_at" => isset($row[6])
                ? (new Carbon($row[6]))->format('Y-m-d')
                : ''
        ]);
    }

}
