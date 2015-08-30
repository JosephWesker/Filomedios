<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFmServiceOrderShows extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('fm_service_order_show',function($table){
                $table->increments('sho_id')->unsigned();           
                $table->string('sho_show',21);
                $table->integer('sho_contract_impacts')->unsigned();
                $table->integer('sho_month_impacts')->unsigned();                
                $table->text('sho_observations');
                $table->string('sho_fk_service_order',9);
                $table->timestamps();
                $table->foreign('sho_fk_service_order')->references('ser_id')->on('fm_service_order')->onDelete('cascade')->onUpdate('cascade');                    
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('fm_service_order_show');
	}

}
