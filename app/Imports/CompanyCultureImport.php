<?php

namespace App\Imports;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CompanyCultureImport implements ToCollection, WithCustomCsvSettings
{

    public $data;

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ','
        ];
    }


    public function collection(Collection $collection)
    {
        $this->data = $collection;
    }

}
