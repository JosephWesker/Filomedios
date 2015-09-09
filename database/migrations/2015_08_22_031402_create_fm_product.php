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
                $table->integer('pro_media');
                $table->string('pro_description');
                $table->double('pro_outlay',8,2);
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
            Schema::drop('fm_service_order_spot');
	}

}
