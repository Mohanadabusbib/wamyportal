<?php

use Illuminate\Database\Seeder;

class HardwareTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeDiv = ['Desktop PC','Monitor','Printer','Phone','Mouse','Keyboard','Scanner','Fax','Paper Cutter',
        'Speaker','Desktop MAC','MultiFunction','Stabilizer','H.D.D Ext.','Duplicator','Laptop','Barcode Reader',
        'Switch','PhotoCopier','CD-Rom Ext.','Headphone','Flash Memory','Doc Feeder','Mobile Credit Card','Core Switch',
        'Router','Wireless Controller','External Drive','KVM Apdapter','AV Splitter','Access Point','Server','Motitor System',
        'KVM Switch','Projector','Presenter'];

        for ($i=0; $i < count($typeDiv) ; $i++) { 
            DB::table('hardware')->insert([
                'name' => $typeDiv[$i],
                'created_at' => now(),
            ]);
        }
    }
}
