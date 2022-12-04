<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoronaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coronas', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('empid')->unsigned();
            $table->boolean('mixtures');
            $table->boolean('fever');
            $table->boolean('cough');
            $table->boolean('breathing');
            $table->boolean('approved')->default(false);
            $table->boolean('mainapproved')->default(false);
            $table->date('created')->format('d/m/yy');
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
        Schema::dropIfExists('coronas');
    }
}
