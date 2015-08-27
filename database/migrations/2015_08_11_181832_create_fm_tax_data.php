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
            $table->integer('tax_fk_customer')->unsigned();
            $table->string('tax_business_name',30)->nullable();
            $table->string('tax_rfc',13);
            $table->string('tax_street',25);
            $table->string('tax_outdoor_number',5);
            $table->string('tax_apartment_number',5)->nullable();
            $table->string('tax_colony',25);
            $table->string('tax_postal_code',5);
            $table->string('tax_town',25);
            $table->string('tax_locality',25);
            $table->string('tax_state',25);
            $table->string('tax_country',20);
            $table->string('tax_tax_email',40)->nullable();
            $table->string('tax_legal_representative',40)->nullable();
            $table->foreign('tax_fk_customer')->references('cus_id')->on('fm_customer')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('fm_tax_data');
    }
}
