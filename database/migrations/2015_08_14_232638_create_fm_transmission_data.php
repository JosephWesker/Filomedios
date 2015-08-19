<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFmTransmissionData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fm_transmission_data',function($table){
            $table->increments('tra_id')->unsigned();
            $table->integer('tra_impacts')->unsigned();
            $table->boolean('tra_monday');
            $table->boolean('tra_tuesday');
            $table->boolean('tra_wednesday');
            $table->boolean('tra_thursday');
            $table->boolean('tra_friday');
            $table->boolean('tra_saturday');
            $table->boolean('tra_sunday');
            $table->boolean('tra_schedule_a');
            $table->boolean('tra_schedule_aa');
            $table->boolean('tra_schedule_aaa');
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
        Schema::drop('fm_transmission_data');
    }
}
