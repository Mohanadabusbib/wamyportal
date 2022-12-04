<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savings', function (Blueprint $table) {
            $table->id();
            /* $table->integer('empid'); */
            $table->unsignedBigInteger('empid')->unique();
            /* $table->foreign('empid')->references('empid')->on('user')->onDelete('cascade'); */
            $table->string('name');
            $table->string('memberid')->nullable();
            $table->string('participationType');
            $table->date('datePremium');
            $table->decimal('previouspremium')->nullable();
            $table->decimal('newpremium');
            $table->decimal('contribute')->nullable();
            $table->string('salary');
            $table->date('dateOfAppointment');
            $table->string('signature');
            $table->string('file')->nullable();
            $table->boolean('agree');
            $table->string('duration')->nullable();
            $table->date('stDate')->nullable();
            $table->date('enDate')->nullable();
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
        Schema::dropIfExists('savings');
    }
}
