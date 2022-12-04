<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->integer('InvId');
            $table->string('HdwBarcode');
            /* $table->date('InvDate'); */
            $table->integer('TypeId');
            $table->integer('StockIN');
            $table->integer('StockOUT');
            $table->string('Note')->nullable();
            $table->string('OSystems')->nullable();
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
        Schema::dropIfExists('inventories');
    }
}
