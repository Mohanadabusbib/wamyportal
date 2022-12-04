<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavingsbkpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savingsbkps', function (Blueprint $table) {
            $table->id();
            $table->integer('empid');
            $table->string('emp_name');
            $table->string('salary');
            $table->string('newpremium');
            $table->string('contribute');
            $table->string('userdeleted');
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
        Schema::dropIfExists('savingsbkps');
    }
}
