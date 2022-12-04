<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvtyStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invtystocks', function (Blueprint $table) {
            $table->id();
            $table->integer('StockId')->unique();
            $table->string('StockNameAr');
            $table->string('StockNameEn');
            $table->string('StockTyp')->nullable();
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
        Schema::dropIfExists('invty_stocks');
    }
}
