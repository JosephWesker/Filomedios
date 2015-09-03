<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFmProduct extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('fm_product',function($table){
                $table->increments('pro_id')->unsigned();
                $table->string('pro_type');
                $table->decimal('pro_amount',8,2);                
                $table->boolean('pro_filomedios_production')->nulleable();
                $table->date('pro_recording')->nulleable();
                $table->date('pro_proposal_1')->nulleable();
                $table->date('pro_proposal_2')->nulleable();               
                $table->date('pro_customer_delivery')->nulleable();
                $table->string('pro_format',4)->nulleable();
                $table->string('sho_show',21)->nulleable();
                $table->integer('pro_contract_impacts')->unsigned();
                $table->integer('pro_moth_impacts')->unsigned();
                $table->integer('pro_daily_impacts')->unsigned();
                $table->integer('pro_hour_impacts')->unsigned();
                $table->text('pro_description');
                $table->text('pro_observations');                
                $table->string('pro_fk_service_order',9);
                $table->timestamps();
                $table->foreign('pro_fk_service_order')->references('ser_id')->on('fm_service_order')->onDelete('cascade')->onUpdate('cascade');                    
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
