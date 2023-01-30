<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'category'=>'TV',
                "description"=>"All sizes",
                "user_id"=>1
            ],
            [
                'category'=>'CellPhone',
                "description"=>"All sizes",
                "user_id"=>1
            ],
            [
                'category'=>'Tables',
                "description"=>"All sizes",
                "user_id"=>1
            ]
        ]);
    }
}
