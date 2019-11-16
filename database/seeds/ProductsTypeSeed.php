<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ProductsTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products_type')->insert([
            [
                'name' => 'Men',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Women',
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
