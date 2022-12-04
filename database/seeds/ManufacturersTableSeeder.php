<?php

use Illuminate\Database\Seeder;

class ManufacturersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $div = ['DELL','ACER','MICROSOFT','HP','NORTEL','PANASONIC','KOBRA','ASSEMPLIED','ZAI',
        'GENIUS','LG','MAC','COMPAQ','BENQ','CANON','MC','VIEW SONIC','UNKNOWN','PANDA','EPSON','SONY',
        'LOGITECH','SAMSUNG','ZC','UNITEC','STAR','MATICA','FUJISU','CROSS CUT','GCOM','UCOM',
        'GENX','MY BOOK STORE','WD','SMART DRIVE ALTRA','SEAGATE','VIN','PROMISE','GIGABYTE',
        'TOSHIBA','ZEBRA','HONYWELL','ALMAKTABA','LOGITECH','DX58S0-I7','NEC','MONSTER','DAHLE',
        'KINGSTONE','AVAYA','CTX','KONICA','IDEAL','SHARP','ELVA','EBA','AURORA','MyCase','Mov','Hypercom','ATLAS','Quietific','Diplo',
        'lenovo','MSI','Philips','Comix','Intel NUC'];

        for ($i=0; $i < count($div); $i++) { 
            DB::table('manufacturers')->insert([
                'name' =>  $div[$i],
                'created_at' => now(),
            ]);
        }
    }
}
