<?php
// app/Imports/YourImport.php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MyImport implements ToArray, WithHeadingRow
{
    protected $data;

    public function array(array $array)
    {
        $this->data[] = $array;
    }

    public function getData()
    {
        return $this->data;
    }
}

