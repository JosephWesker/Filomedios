<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFmServiceOrderWeb extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('fm_service_order_web',function($table){
                $table->increments('web_id')->unsigned();                
                $table->text('web_description');
                $table->string('web_fk_service_order',9);
                $table->timestamps();
                $table->foreign('web_fk_service_order')->references('ser_id')->on('fm_service_order')->onDelete('cascade')->onUpdate('cascade');                    
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::drop('fm_service_order_web');
	}

}