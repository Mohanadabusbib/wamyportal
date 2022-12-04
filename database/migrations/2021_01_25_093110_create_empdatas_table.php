<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpdatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empdatas', function (Blueprint $table) {
            $table->id();
            $table->integer('emp_no');
            $table->string('emp_nm');
            $table->string('e_mail')->nullable();
            $table->decimal('total_sal')->nullable();
            $table->string('hirch_nm')->nullable();
            $table->string('hirchy_prnt_nm')->nullable();
            $table->date('start_date')->nullable();
            $table->string('qlfction_lst_nm')->nullable();
            $table->string('emp_job_nm')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('card_no')->nullable();
            $table->string('nat_nm')->nullable();
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
        Schema::dropIfExists('empdatas');
    }
}
