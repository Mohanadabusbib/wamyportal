<?php

use Illuminate\Database\Seeder;

class InventoryTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inventory_types')->insert([
            'TypeId' =>100 ,
            'TypeNameAr' => 'عهدة' ,
            'TypeNameEn' => 'Property' ,
            'created_at' => now(),
        ]);
        DB::table('inventory_types')->insert([
            'TypeId' => 200,
            'TypeNameAr' => 'جديد' ,
            'TypeNameEn' => 'New' ,
            'created_at' => now(),
        ]);
        DB::table('inventory_types')->insert([
            'TypeId' => 300,
            'TypeNameAr' => 'مستودع' ,
            'TypeNameEn' => 'Store' ,
            'created_at' => now(),
        ]);
        DB::table('inventory_types')->insert([
            'TypeId' => 400,
            'TypeNameAr' => 'متلف' ,
            'TypeNameEn' => 'Destructive' ,
            'created_at' => now(),
        ]);
        DB::table('inventory_types')->insert([
            'TypeId' => 103,
            'TypeNameAr' => 'صيانة' ,
            'TypeNameEn' => 'Maintenance' ,
            'created_at' => now(),
        ]);
        DB::table('inventory_types')->insert([
            'TypeId' => 600,
            'TypeNameAr' => 'إعارة' ,
            'TypeNameEn' => 'Loan' ,
            'created_at' => now(),
        ]);
        DB::table('inventory_types')->insert([
            'TypeId' => 101,
            'TypeNameAr' => 'نقل عهدة' ,
            'TypeNameEn' => 'Transfer custody' ,
            'created_at' => now(),
        ]);
        DB::table('inventory_types')->insert([
            'TypeId' => 102,
            'TypeNameAr' => 'OUT' ,
            'TypeNameEn' => 'OUT' ,
            'created_at' => now(),
        ]);
        








    }
}
