<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvtyTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invtytypes', function (Blueprint $table) {
            $table->id();
            $table->integer('TypeId')->unique();
            $table->string('TypeNameAr');
            $table->string('TypeNameEn');
            $table->string('TType')->nullable();
            $table->integer('Tnumber')->nullable();
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
        Schema::dropIfExists('invty_types');
    }
}
