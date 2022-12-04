<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('numberboard');
            $table->string('color')->nullable();
            $table->string('model')->nullable();
            $table->string('klms')->nullable();
            $table->integer('price');
            $table->string('image')->default('default.jpg');
            $table->decimal('lastprice')->nullable();
            $table->integer('auctionUser')->nullable();
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
        Schema::dropIfExists('auctions');
    }
}
