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
                $table->decimal('pay_amount',8,2);
                $table->date('pay_estimated_date');
                $table->string('pay_fk_service_order',9);
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
