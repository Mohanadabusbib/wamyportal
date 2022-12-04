<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nominations', function (Blueprint $table) {
            $table->id();
            $table->integer('empid')->unique();
            $table->string('name');
            $table->string('mobile')->unique()->nullable();
            $table->string('avatar')->nullable();
            $table->string('dept')->nullable();
            $table->string('sectn')->nullable();
            $table->string('job')->nullable();
            $table->string('qualification')->nullable();
            $table->string('candidateposition')->nullable();
            $table->string('file')->nullable();
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
        Schema::dropIfExists('nominations');
    }
}
