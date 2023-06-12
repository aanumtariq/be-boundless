<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class brandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('brand')->insert([            
            ['bName'=>'local'],
            ['bName'=>'Loi Voton'],
            ['bName'=>'Pak Arab'],
            ['bName'=>'Artistic'],
            ['bName'=>'Master'],
            ['bName'=>'Diamond'],
        ]);
    }
}
