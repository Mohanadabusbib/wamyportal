<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class permissionsroleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('permissions_role')->insert([
            'role_id' => 2,
            'permissions_id' => 1,
            'created_at' => now(),
        ]);
        DB::table('permissions_role')->insert([
            'role_id' => 2,
            'permissions_id' => 2,
            'created_at' => now(),
        ]);
        DB::table('permissions_role')->insert([
            'role_id' => 2,
            'permissions_id' => 5,
            'created_at' => now(),
        ]);
        DB::table('permissions_role')->insert([
            'role_id' => 2,
            'permissions_id' => 5,
            'created_at' => now(),
        ]);
        DB::table('permissions_role')->insert([
            'role_id' => 2,
            'permissions_id' => 6,
            'created_at' => now(),
        ]);
        DB::table('permissions_role')->insert([
            'role_id' => 2,
            'permissions_id' => 7,
            'created_at' => now(),
        ]);
        DB::table('permissions_role')->insert([
            'role_id' => 2,
            'permissions_id' => 8,
            'created_at' => now(),
        ]);
        DB::table('permissions_role')->insert([
            'role_id' => 2,
            'permissions_id' => 13,
            'created_at' => now(),
        ]);
        DB::table('permissions_role')->insert([
            'role_id' => 2,
            'permissions_id' => 5,
            'created_at' => now(),
        ]);
    }
}
