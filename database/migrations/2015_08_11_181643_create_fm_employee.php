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
            $table->string('emp_first_name',30);
            $table->string('emp_last_names',40);
            $table->string('emp_address',50)->nullable();
            $table->string('emp_phone_number',10)->nullable();
            $table->string('emp_cellphone_number',10)->nullable();
            $table->string('emp_email',30);
            $table->string('emp_job',30);
            $table->string('emp_username',20);
            $table->string('emp_password');
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
        Schema::drop('fm_employee');
    }
}
