<?php

namespace App\Imports;

use App\Models\products;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Illuminate\Support\Facades\Session;

class ProductsImport implements ToModel, WithStartRow, WithCustomCsvSettings
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
    public static function getSlug($text)
    {
        $word = strtolower($text);
        $word = str_replace("ä", "ae", $word);
        $word = str_replace("ö", "oe", $word);
        $word = str_replace("ü", "ue", $word);
        $word = str_replace("ß", "ss", $word);
        $word = str_replace("&", "und", $word);
        $text = preg_replace('~[^\pL\d]+~u', '-', $word);
        $text = trim($text, '-');
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = strtolower($text);
        $text = preg_replace('~[^-\w]+~', "", $text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }
    public function model(array $row)
    {
        // dd($row);
        $csv_imp = Session::get('csv_imp');
        return new products([           
            'cId' => $csv_imp['cId'],
            'bId' => $csv_imp['bId'],
            'pModelNo' => $row[0],
            'pName' => $row[1],
            'pSlug' => $this->getSlug($row[1]),
            'thumb' => $row[2],
            'pImage' => $row[3],
            'pDescription' => $row[5],
            'pPrice' => $row[6],
            'discount' => $row[7],
            'pStock' => $row[8],
            'pActive' => $row[9] ?? 1,
            'pFeatured' => $row[10] ?? 1,            
        ]);
        Session::forgot('csv_imp');
    }
}
