<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFmMethodPayment extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('fm_method_payment',function($table){
                $table->increments('met_id')->unsigned();
                $table->string('met_method',15);
                $table->string('met_account');
                $table->integer('met_fk_customer')->unsigned();
                $table->foreign('met_fk_customer')->references('cus_id')->on('fm_customer')->onDelete('cascade')->onUpdate('cascade');
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
		Schema::drop('fm_method_payment');
	}

}
