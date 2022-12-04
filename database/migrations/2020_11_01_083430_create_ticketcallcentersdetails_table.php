<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketcallcentersdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticketcallcentersdetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticketcallcenters_id');
            $table->foreign('ticketcallcenters_id')->references('id')->on('ticketcallcenters')->onDelete('cascade');
            $table->integer('callerid');
            $table->string('callername');
            $table->text('purposecal');
            $table->text('procedure');
            $table->text('note')->nullable();
            $table->boolean('transftransctn')->nullable();
            $table->string('transferto')->nullable();
            $table->text('transfermessage')->nullable();
            $table->text('secondprocedure')->nullable();
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
        Schema::dropIfExists('ticketcallcentersdetails');
    }
}
