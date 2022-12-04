<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionstypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions-types')->insert([
            'name' => 'قائمة رئيسية',
            'created_at' => now(),
        ]);
        DB::table('permissions-types')->insert([
            'name' => 'قائمة فرعية',
            'created_at' => now(),
        ]);
        DB::table('permissions-types')->insert([
            'name' => 'إجراء',
            'created_at' => now(),
        ]);
    }
}
