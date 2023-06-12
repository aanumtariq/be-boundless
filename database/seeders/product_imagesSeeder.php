<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class product_imagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('product_images')->insert([            	
            ['pId'=>'1',
            'Image'=>'images/productsImg/ancent-chair-11-1.jpg'],            
            ['pId'=>'1',
            'Image'=>'images/productsImg/ancent-chair-11-2.jpg'],            
            ['pId'=>'1',
            'Image'=>'images/productsImg/ancent-chair-11-3.jpg'],

            ['pId'=>'2',
            'Image'=>'images/productsImg/bed-set-3-1.jpg'],            
            ['pId'=>'2',
            'Image'=>'images/productsImg/bed-set-3-2.jpg'],            
            ['pId'=>'2',
            'Image'=>'images/productsImg/bed-set-3-3.jpg'],
            ['pId'=>'2',
            'Image'=>'images/productsImg/bed-set-3-4.jpg'],            
           
            ['pId'=>'3',
            'Image'=>'images/productsImg/coffee-table-6-1.jpg'],

            ['pId'=>'4',
            'Image'=>'images/productsImg/dining-table-5-1.jpg'],            
            ['pId'=>'4',
            'Image'=>'images/productsImg/dining-table-5-2.jpg'],            
            ['pId'=>'4',
            'Image'=>'images/productsImg/dining-table-5-3.jpg'],

            ['pId'=>'5',
            'Image'=>'images/productsImg/sofa-set-4-1.jpg'],            
            ['pId'=>'5',
            'Image'=>'images/productsImg/sofa-set-4-2.jpg'],            
            ['pId'=>'5',
            'Image'=>'images/productsImg/sofa-set-4-3.jpg'],

            ['pId'=>'6',
            'Image'=>'images/productsImg/bed-sheet-3-1.jpeg']
        ]);

             
    }
}
