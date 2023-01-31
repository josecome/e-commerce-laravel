<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'product'=>'LCD200',
                "description"=>"40X40",
                "category"=>"TV",
                "user_id"=>1
            ],
            [
                'product'=>'LCD400',
                "description"=>"60X60",
                "category"=>"TV",
                "user_id"=>1
            ],
            [
                'product'=>'LCD600',
                "description"=>"80X80",
                "category"=>"TV",
                "user_id"=>1
            ],
        ]);
    }
}
