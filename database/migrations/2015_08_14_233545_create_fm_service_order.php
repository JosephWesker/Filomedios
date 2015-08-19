<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFmServiceOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fm_service_order',function($table){
            $table->increments('ser_id')->unsigned();
            $table->integer('ser_fk_vid_id')->unsigned();
            $table->integer('ser_fk_tra_id')->unsigned();
            $table->integer('ser_fk_cus_id')->unsigned();
            $table->timestamps();
            $table->foreign('ser_fk_vid_id')->references('vid_id')->on('fm_video_data')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ser_fk_tra_id')->references('tra_id')->on('fm_transmission_data')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ser_fk_cus_id')->references('cus_id')->on('fm_customer')->onDelete('cascade')->onUpdate('cascade');
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
