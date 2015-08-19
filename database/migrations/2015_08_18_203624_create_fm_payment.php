<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFmPayment extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('fm_payment',function($table){
            $table->increments('pay_id')->unsigned();
            $table->integer('pay_number_payment')->unsigned();
            $table->date('pay_payment_date');
            $table->decimal('pay_amount',10,2);
            $table->integer('pay_fk_service_order')->unsigned();
            $table->timestamps();
            $table->foreign('pay_fk_service_order')->references('ser_id')->on('fm_service_order')->onDelete('cascade')->onUpdate('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
