<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxorders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empid');
            $table->string('name');
            $table->unsignedBigInteger('reqType'); /* نوع الطلب  */
            $table->foreign('reqType')->references('id')->on('boxorderstypes');
            $table->integer('installmentPeriod'); /*  مدة التقسيط  */
            $table->integer('rate'); /*  مدة التقسيط  */
            $table->decimal('purchasingValue')->nullable(); /*  القيمة الشرائية */
            $table->string('descDevice')->nullable(); /* وصف الاجهزة */
            $table->integer('qtyDevice')->nullable(); /* كمية الاجهزة */
            $table->string('descFurniture')->nullable(); /* وصف الاجهزة */
            $table->integer('qtyFurniture')->nullable(); /* كمية الاثاث */
            $table->string('descCar')->nullable(); /* وصف السيارة */
            $table->integer('qtyCar')->nullable(); /* كمية السيارة */

            /* $table->decimal('salary');
            $table->decimal('deductionsHr');
            $table->decimal('deductionsBox'); 

            $table->string('sponsorid')->nullable();  
            $table->string('sponsor')->nullable();  
            $table->boolean('approvalSponsor')->default(false); 
            $table->string('signatureSponsor')->nullable();  */

            $table->string('signature')->nullable(); /* توقيع صاحب الطلب */
            $table->string('status')->default('جديد'); /* حالة الطلب */

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boxorders');
    }
}
