<?php

namespace App\Imports;

use App\Service;
use App\ServiceCategory;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ServicesImport implements OnEachRow, WithHeadingRow, WithChunkReading
{
    public function onRow(Row $row)
    {
        $row = (object) $row->toArray();
        echo $row->name.PHP_EOL;

        $category = ServiceCategory::where('name', $row->center)->first();
        if (!$category) return;

        $service = Service::firstOrNew([
            'product_code' => $row->product_code,
        ]);
        $service->name = $row->name;
        $service->description = $row->description;
        $service->category_id = $category->id;
        $service->price = $row->price;
        $service->eligible = (strtolower($row->eligible_for_pwd_senior) == 'yes') ? 1 : 0;
        // $service->status = (strtolower($row->include_yes_or_no) == 'yes') ? 1 : 0;
        $service->save();
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
