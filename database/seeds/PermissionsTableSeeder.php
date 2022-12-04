<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('permissions')->insert([
            'name' => 'mm-box-savings',
            'desc' => 'صندوق الإدخار',
            'type_id' => 1,
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'mm-disclosure-form',
            'desc' => 'نموذج الإفصاح',
            'type_id' => 1,
            'created_at' => now(),

        ]);
        DB::table('permissions')->insert([
            'name' => 'mm-wamy-visitors',
            'desc' => 'زوار الندوة',
            'type_id' => 1,
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'mm-security',
            'desc' => 'الأمن',
            'type_id' => 1,
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'mm-setting',
            'desc' => 'الإعدادات',
            'type_id' => 1,
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'sm-box-registr',
            'desc' => 'تسجيل الصندوق',
            'type_id' => 2,
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'sm-disclosure',
            'desc' => 'تسجيل الإفصاح',
            'type_id' => 2,
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'sm-order-disclosure',
            'desc' => 'طلب دخول الإفصاح',
            'type_id' => 2,
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'sm-alldata-disclosure',
            'desc' => 'جميع بيانات الإفصاح',
            'type_id' => 2,
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'sm-order-visit',
            'desc' => 'طلب زيارة',
            'type_id' => 2,
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'sm-approval-visit',
            'desc' => 'موافقات الزيارة',
            'type_id' => 2,
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'sm-display-security',
            'desc' => 'عرض الأمن',
            'type_id' => 2,
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'sm-profile',
            'desc' => 'الملف الشخصي',
            'type_id' => 2,
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'sm-dept',
            'desc' => 'الإدارات',
            'type_id' => 2,
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'sm-sctn',
            'desc' => 'الأقسام',
            'type_id' => 2,
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'sm-permission',
            'desc' => 'الصلاحيات',
            'type_id' => 2,
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'proc-permission',
            'desc' => 'إضافة دور',
            'type_id' => 3,
            'created_at' => now(),
        ]);
    }
}
