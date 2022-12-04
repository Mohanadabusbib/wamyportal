<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketcallcentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticketcallcenters', function (Blueprint $table) {
            $table->id();
            $table->integer('callerid');
            $table->string('callername');
            $table->text('purposecal');
            $table->text('procedure');
            $table->text('note')->nullable();
            $table->boolean('transftransctn')->nullable();
            $table->string('transferto')->nullable();
            $table->text('transfermessage')->nullable();
            $table->text('secondprocedure')->nullable();
            $table->string('recivecall');
            $table->integer('status');
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
        Schema::dropIfExists('ticketcallcenters');
    }
}
