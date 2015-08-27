<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFmServiceOrderSnood extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('fm_service_order_snood',function($table){
                $table->increments('sno_id')->unsigned();                
                $table->integer('sno_contract_impacts')->unsigned();
                $table->integer('sno_month_impacts')->unsigned();
                $table->integer('sno_show_impacts')->unsigned();
                $table->text('sno_observations');
                $table->string('sno_fk_service_order',9);
                $table->timestamps();
                $table->foreign('sno_fk_service_order')->references('ser_id')->on('fm_service_order')->onDelete('cascade')->onUpdate('cascade');                    
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::drop('fm_service_order_snood');
	}

}
