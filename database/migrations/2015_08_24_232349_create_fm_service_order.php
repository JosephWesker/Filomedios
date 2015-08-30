<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFmServiceOrder extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
                Schema::create('fm_service_order',function($table){
                    $table->string('ser_id',9);
                    $table->string('ser_method_payment');
                    $table->boolean('ser_authorization');
                    $table->decimal('ser_total',8,2);
                    $table->integer('ser_contract_duration')->unsigned();
                    $table->date('ser_projection_estimated_start');
                    $table->date('ser_projection_estimated_end');
                    $table->integer('ser_fk_customer')->unsigned();
                    $table->timestamps();
                    $table->primary('ser_id');
                    $table->foreign('ser_fk_customer')->references('cus_id')->on('fm_customer')->onDelete('cascade')->onUpdate('cascade');                    
                });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('fm_service_order');
	}

}
