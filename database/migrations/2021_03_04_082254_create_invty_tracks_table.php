<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvtyTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invtytracks', function (Blueprint $table) {
            $table->id();
            $table->integer('HdwId')->unique();
            $table->string('HdwBarcode')->unique();
            $table->string('HdwName');
            $table->integer('StockIN');
            $table->integer('TohdwId');
            $table->integer('ManfId');
            $table->string('HdwModel');
            $table->integer('HdwType');
            $table->string('img')->nullable();
            $table->integer('userEntry');
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
        Schema::dropIfExists('invty_tracks');
    }
}
