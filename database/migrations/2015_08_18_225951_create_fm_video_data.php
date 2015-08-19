<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFmVideoData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fm_video_data',function($table){

            $table->increments('vid_id')->unsigned();
            $table->string('vid_name');
            $table->time('vid_duration');
            $table->text('vid_path');
            $table->string('vid_type',10);
            $table->integer('vid_fk_service_order')->unsigned();
            $table->timestamps();
            $table->foreign('vid_fk_service_order')->references('ser_id')->on('fm_service_order')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fm_video_data');
    }
}
