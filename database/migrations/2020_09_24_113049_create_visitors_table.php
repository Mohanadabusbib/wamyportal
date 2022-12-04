<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->date('created')->format('d/m/yy');
            $table->string('vname');
            $table->string('vpurpose');
            $table->date('vdate');
            $table->tinyInteger('approved')->default(0);
            $table->boolean('mainapproved')->default(false);
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
        Schema::dropIfExists('visitors');
    }
}
