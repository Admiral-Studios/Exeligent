<?php

namespace App\Imports\Admin;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;

class TableImport implements ToArray
{
    private $data = [];

    public function array(array $array)
    {
        foreach ($array as $row)
            $this->data[] = $row;
    }

    public function getData(): array
    {
        return $this->data;
    }

}
