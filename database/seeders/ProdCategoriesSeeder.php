<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProdCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prod_categories')->insert([
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
