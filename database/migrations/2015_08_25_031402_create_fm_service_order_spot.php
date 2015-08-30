<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFmServiceOrderSpot extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('fm_service_order_spot',function($table){
                $table->increments('sos_id')->unsigned();
                $table->boolean('sos_filomedios_production');
                $table->date('sos_recording')->nulleable();
                $table->date('sos_proposal_1')->nulleable();
                $table->date('sos_proposal_2')->nulleable();               
                $table->date('sos_customer_delivery')->nulleable();
                $table->string('sos_format',4)->nulleable();
                $table->integer('sos_duration_spot')->unsigned();
                $table->integer('sos_contract_impacts')->unsigned();
                $table->integer('sos_daily_impacts')->unsigned();
                $table->integer('sos_hour_impacts')->unsigned();
                $table->string('sos_fk_service_order',9);
                $table->timestamps();
                $table->foreign('sos_fk_service_order')->references('ser_id')->on('fm_service_order')->onDelete('cascade')->onUpdate('cascade');                    
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('fm_service_order_spot');
	}

}
