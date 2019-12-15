<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            [
                'name' => 'Chưa Xác Nhận',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Chưa Thanh Toán',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Đã Thanh Toán',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Đang vận chuyển',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Đã Giao Hàng',
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
