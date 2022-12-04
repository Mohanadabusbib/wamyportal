<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctionemps', function (Blueprint $table) {
            $table->id();
            $table->integer('empid')->unique();
            $table->string('name');
            $table->decimal('total_sal')->nullable();
            $table->date('start_date')->nullable();
            $table->integer('userEntry');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('auctionemps');
    }
}
