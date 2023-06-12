<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class productsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
            ['cId'=>'11',	
            'bId'=>'1',
            'pName'=>'House chair',
            'pDescription'=>'Blue house chair with 25X15X15 Dimension and many more',
            'pModelNo'=>'AC 111',
            'pPrice'=>'$17.99',
            'discount'=>'15',
            'pColor'=>'blue',
            'pStock'=>'4',
            'imgId'	=>'1',
            'pImage'=>'images/productsImg/ancent-chair-11-1.jpg'],

            ['cId'=>'3',	
            'bId'=>'2',
            'pName'=>'Full Bed Set',
            'pDescription'=>'A Full Bed Set with 45X50X15 Dimension and many more',
            'pModelNo'=>'BS 31',
            'pPrice'=>'$699',
            'discount'=>'10',
            'pColor'=>'blue',
            'pStock'=>'4',
            'imgId'	=>'8',
            'pImage'=>'images/productsImg/bed-set-3-1.jpg'],

            ['cId'=>'6',	
            'bId'=>'3',
            'pName'=>'House chair',
            'pDescription'=>'A 4 seater coffee Table with 25X15X15 Dimension and many more',
            'pModelNo'=>'CT 61',
            'pPrice'=>'$99',
            'discount'=>'13',
            'pColor'=>'blue',
            'pStock'=>'4',
            'imgId'	=>'6',
            'pImage'=>'images/productsImg/coffee-table-6-1.jpg'],

            ['cId'=>'5',	
            'bId'=>'4',
            'pName'=>'House chair',
            'pDescription'=>'A 6 seater dining table with 25X15X15 Dimension and many more',
            'pModelNo'=>'DT 51',
            'pPrice'=>'$159',
            'discount'=>'10',
            'pColor'=>'blue',
            'pStock'=>'4',
            'imgId'	=>'2',
            'pImage'=>'images/productsImg/dining-table-5-1.jpg'],

            ['cId'=>'4',	
            'bId'=>'5',
            'pName'=>'House chair',
            'pDescription'=>'A 8 seater sofa set with 25X15X15 Dimension and many more',
            'pModelNo'=>'SS 41',
            'pPrice'=>'$399',
            'discount'=>'12',
            'pColor'=>'Purple',
            'pStock'=>'4',
            'imgId'	=>'5',
            'pImage'=>'images/productsImg/sofa-set-4-1.jpg'],

            ['cId'=>'3',	
            'bId'=>'6',
            'pName'=>'Rainbow Bed Sheet',
            'pDescription'=>'A rainbow color bed sheet with 25X15X15 Dimension and many more',
            'pModelNo'=>'BS 31',
            'pPrice'=>'$19.99',
            'discount'=>'15',
            'pColor'=>'rainbow',
            'pStock'=>'3',
            'imgId'	=>'6',
            'pImage'=>'images/productsImg/bed-sheet-3-1.jpeg'],
           
        ]);

        
        

    }
}
