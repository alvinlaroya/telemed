<?php

namespace App\Imports;

use App\Service;
use App\ServiceCategory;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class CentersImport implements OnEachRow, WithHeadingRow, WithChunkReading
{
    public function onRow(Row $row)
    {
        $row = (object) $row->toArray();

        $center = new ServiceCategory;
        $center->name = $row->name;
        $center->save();
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
