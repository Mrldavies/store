<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;

class ProductImport implements ToArray, WithHeadingRow
{

    /**
     * Impoort Products and Categories
     *
     * @param array $array
     * @return void
     */
    public function array(array $array)
    {
    }
}
