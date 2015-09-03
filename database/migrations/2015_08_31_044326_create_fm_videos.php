<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFmVideos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
                Schema::create('fm_videos',function($table){
                    $table->increments('vid_id')->unsigned();
                    $table->text('vid_url');
                    $table->date('vid_start_proyection');
                    $table->date('vid_end_proyection');
                    $table->integer('vid_fk_product')->unsigned();
                    $table->timestamps();
                $table->foreign('vid_fk_product')->references('pro_id')->on('fm_product')->onDelete('cascade')->onUpdate('cascade');
                });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fm_videos');
	}

}
