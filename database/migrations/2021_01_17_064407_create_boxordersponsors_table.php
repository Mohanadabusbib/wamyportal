<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxordersponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxordersponsors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('boxorders_id'); /* رقم الطلب الطلب  */
            $table->foreign('boxorders_id')->references('id')->on('boxorders');
            $table->string('empid')->nullable();  /* رقم الكافل */
            $table->string('sponsor')->nullable();  /* الكافل */
            $table->boolean('approvalSponsor')->default(false);  /* موافقة الكافل */
            $table->string('signatureSponsor')->nullable();  /* توقيع الكافل */
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
        Schema::dropIfExists('boxordersponsors');
    }
}
