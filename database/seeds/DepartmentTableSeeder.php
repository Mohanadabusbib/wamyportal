<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dept = "إدارة الاعلام وتقنية المعلومات";
        DB::table('departments')->insert([
            'id' => 1,
            'name' => $dept,
            'created_at' => now(),
        ]);
        $dept = "إدارة التخطيط والتطوير";
        DB::table('departments')->insert([
            'id' => 2,
            'name' => $dept,
            'created_at' => now(),
        ]);
        $dept = "إدارة الشؤون الادارية";
        DB::table('departments')->insert([
            'id' => 3,
            'name' => $dept,
            'created_at' => now(),
        ]);
        $dept = "إدارة الشؤون الإجتماعية";
        DB::table('departments')->insert([
            'id' => 4,
            'name' => $dept,
            'created_at' => now(),
        ]);
        $dept = "إدارة الشؤون التعليمية";
        DB::table('departments')->insert([
            'id' => 5,
            'name' => $dept,
            'created_at' => now(),
        ]);
        $dept = "إدارة الشؤون المالية";
        DB::table('departments')->insert([
            'id' => 6,
            'name' => $dept,
            'created_at' => now(),
        ]);
        $dept = "إدارة العمل التطوعي الشبابي";
        DB::table('departments')->insert([
            'id' => 7,
            'name' => $dept,
            'created_at' => now(),
        ]);
        $dept = "إدارة المكاتب والعلاقات الدولية";
        DB::table('departments')->insert([
            'id' => 8,
            'name' => $dept,
            'created_at' => now(),
        ]);
        $dept = "إدارة الممتلكات";
        DB::table('departments')->insert([
            'id' => 9,
            'name' => $dept,
            'created_at' => now(),
        ]);
        $dept = "إدارة تنمية الموارد";
        DB::table('departments')->insert([
            'id' => 10,
            'name' => $dept,
            'created_at' => now(),
        ]);
    }
}
