<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            
            $table->string('name');
            $table->unsignedBigInteger('dept_id');
            
            $table->unsignedBigInteger('section_id');
            
            $table->string('job')->nullable();
            $table->string('tel')->nullable();
            $table->string('extn')->nullable();
            $table->boolean('active')->default(false);
            $table->timestamps();
        });
        
        /* Schema::table('employees', function($table)
        {
            $table->foreign('emp_id')->references('empid')->on('users');
            $table->foreign('dept_id')->references('id')->on('departments');
            $table->foreign('section_id')->references('id')->on('sections');
            
        }); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
