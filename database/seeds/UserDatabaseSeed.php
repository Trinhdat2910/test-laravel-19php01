<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class UserDatabaseSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'footwearshop@gmail.com',
                'password' => bcrypt('password'),
                'phone_number' => '0989888888',
                'email_verified_at' => Carbon::now(),
                'address' => 'VietNam',
                'created_at' => Carbon::now(),
                'role_id' => '0' // admin
            ]
        ]);
    }
}
