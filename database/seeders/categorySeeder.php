<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('category')->insert([                    
            ['cName'=>'Mattresses'],
            ['cName'=>'Furniture'],
            ['cName'=>'Bed sets'],
            ['cName'=>'Sofa sets'],
            ['cName'=>'Dinning Tables'],
            ['cName'=>'Coffee Tables'],
            ['cName'=>'Lamps'],
            ['cName'=>'Carpets'],
            ['cName'=>'Sectional Sofa Sets'],
            ['cName'=>'Accent Furniture'],
            ['cName'=>'Accent Chairs']
        ]);
    }
}
