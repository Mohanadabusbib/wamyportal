<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'empid' => 11829,
            'name' => 'مهند محمد علي',
            'email'  => 'moali@wamy.org',
            'mobile' => '0534870595',
            'password' => '130961',
            'role_id' => 1,
            'lang' => 'ar',
            'email_verified_at' => now(),
            'created_at' => now(),
        ]);
    }
}
