<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFmTaxData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fm_tax_data',function($table){
            $table->increments('tax_id')->unsigned();
            $table->string('tax_street');
            $table->string('tax_outdoor_number');
            $table->string('tax_apartment_number')->nullable();
            $table->string('tax_colony');
            $table->string('tax_postal_code');
            $table->string('tax_town');
            $table->string('tax_locality');
            $table->string('tax_state');
            $table->string('tax_country');
            $table->string('tax_tax_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fm_tax_data');
    }
}
