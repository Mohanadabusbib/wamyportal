<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
            'deptid' => 1,
            'name' => "الاعلام والعلاقات العامة",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 1,
            'name' => "تقنية المعلومات",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 2,
            'name' => "التخطيط والتطوير",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 2,
            'name' => "الدراسات والتقارير",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 3,
            'name' => "الاتصالات الادارية",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 3,
            'name' => "التحرير والنسخ",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 3,
            'name' => "شؤون الموظفين",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 3,
            'name' => "الحركة والأمن",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 3,
            'name' => "المشتريات والمستودع",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 4,
            'name' => "الأيتام",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 4,
            'name' => "البرامج الاجتماعية والاغاثية",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 5,
            'name' => "الطلاب والمنح",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 5,
            'name' => "الدعوة",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 6,
            'name' => "الحسابات",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 6,
            'name' => "الصندوق",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 6,
            'name' => "وحدة العقود",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 7,
            'name' => "اللجان التطوعية",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 7,
            'name' => "البرامج الشبابية",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 8,
            'name' => "الجمعيات وشؤون العضوية",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 8,
            'name' => "المكاتب الخارجية",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 9,
            'name' => "الصيانة",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 9,
            'name' => "العقارات",
            'created_at' => now(),
        ]);

        DB::table('sections')->insert([
            'deptid' => 10,
            'name' => "التواصل والمتابعة",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 10,
            'name' => "وحدة الهاتف",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 10,
            'name' => "الاستقبال",
            'created_at' => now(),
        ]);
        DB::table('sections')->insert([
            'deptid' => 10,
            'name' => "المشروعات التنموية",
            'created_at' => now(),
        ]);
    }
}
