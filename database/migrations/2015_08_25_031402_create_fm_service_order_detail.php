<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFmServiceOrderDetail extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('fm_service_order_detail',function($table){
                $table->increments('sod_id')->unsigned();
                $table->string('sod_fk_service_order',9);
                $table->integer('sod_fk_product')->unsigned();
                $table->string('sod_show',21)->nulleable();
                $table->integer('sod_daily_impacts')->unsigned();
                $table->integer('sod_month_impacts')->unsigned();                
                $table->integer('sod_hour_impacts')->unsigned();
                $table->double('sod_discount',5,2);
                $table->double('sod_outlay_month',8,2);
                $table->text('sod_description');
                $table->timestamps();
                $table->foreign('sod_fk_service_order')->references('ser_id')->on('fm_service_order')->onDelete('cascade')->onUpdate('cascade');                    
                $table->foreign('sod_fk_product')->references('pro_id')->on('fm_product')->onDelete('cascade')->onUpdate('cascade');                    
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('fm_service_order_detail');
	}

}
