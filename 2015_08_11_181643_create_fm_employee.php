<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFmEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fm_employee',function($table){
            $table->increments('emp_id')->unsigned();
            $table->string('emp_first_name');
            $table->string('emp_last_names');
            $table->string('emp_address')->nullable();
            $table->string('emp_phone_number')->nullable();
            $table->string('emp_cellphone_number')->nullable();
            $table->string('emp_email')->nullable();
            $table->string('emp_job');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fm_seller');
    }
}
