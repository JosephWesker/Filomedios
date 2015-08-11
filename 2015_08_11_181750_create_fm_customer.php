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
            $table->string('cus_commercial_name')->nullable();
            $table->string('cus_contact_first_name');
            $table->string('cus_contact_last_names');
            $table->string('cus_job')->nullable();
            $table->string('cus_phone_number')->nullable();
            $table->string('cus_cellphone_number')->nullable();
            $table->string('cus_email')->nullable();
            $table->string('cus_address')->nullable();
            $table->string('cus_business_name')->nullable();
            $table->integer('cus_fk_employee')->nullable()->unsigned();
            $table->integer('cus_fk_tax_data')->nullable()->unsigned();
            $table->foreign('cus_fk_employee')->references('emp_id')->on('fm_employee')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cus_fk_tax_data')->references('tax_id')->on('fm_tax_data')->onDelete('cascade')->onUpdate('cascade');
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
