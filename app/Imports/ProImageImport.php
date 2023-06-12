<?php

namespace App\Imports;

use App\Models\product_images;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Illuminate\Support\Facades\Session;

class ProImageImport implements ToCollection, WithStartRow, WithCustomCsvSettings
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ','
        ];
    }
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            product_images::where('Id',$row[0])->update([
                'pId' => $row[1],
                'pModelNo' => $row[2],
                'orgImg' => $row[3],
                'Image' => $row[4],
                'thumb' => $row[5],           
            ]);
        }
        return 'success';
    }
    // public function model(array $row)
    // {      
    //     return new product_images([
    //         'pId' => $row[0],
    //         'pModelNo' => $row[1],
    //         'orgImg' => $row[2],
    //         'Image' => $row[3],
    //         'thumb' => $row[4],           
    //     ]);
    // }
}
