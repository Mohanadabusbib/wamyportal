<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 1,
            'role' => 'Super-Admin',
            'created_at' => now(),
        ]);
        DB::table('roles')->insert([
            'id' => 2,
            'role' => 'Admin',
            'created_at' => now(),
        ]);
        DB::table('roles')->insert([
            'id' => 3,
            'role' => 'User',
            'created_at' => now(),
        ]);
        DB::table('roles')->insert([
            'id' => 4,
            'role' => 'Security',
            'created_at' => now(),
        ]);
    }
}
