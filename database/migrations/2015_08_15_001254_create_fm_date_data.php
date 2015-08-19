<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFmDateData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fm_date_data',function($table){
            $table->increments('dat_id')->unsigned();
            $table->date('dat_start_date');
            $table->date('dat_end_date');
            $table->integer('dat_fk_tra_id')->unsigned();;
            $table->timestamps();
            $table->foreign('dat_fk_tra_id')->references('tra_id')->on('fm_transmission_data')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fm_date_data');
    }
}
