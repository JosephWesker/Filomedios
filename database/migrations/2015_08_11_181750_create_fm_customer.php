<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFmCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fm_customer',function($table){
            $table->increments('cus_id')->unsigned();
            $table->string('cus_commercial_name',30)->nullable();
            $table->string('cus_contact_first_name',30);
            $table->string('cus_contact_last_names',40);
            $table->string('cus_job',30)->nullable();
            $table->string('cus_phone_number',10)->nullable();
            $table->string('cus_cellphone_number',10)->nullable();
            $table->string('cus_email',30)->nullable();
            $table->string('cus_address',50)->nullable();
            $table->string('cus_business_name',30)->nullable();
            $table->integer('cus_fk_employee')->unsigned();
            $table->foreign('cus_fk_employee')->references('emp_id')->on('fm_employee')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('fm_customer');
    }
}
