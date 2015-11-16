<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class EmployeesSeeder extends Seeder {
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(){
		$faker = Faker::create();
		for ($i=0; $i < 11; $i++) { 
			DB::table('fil_employee')->insert([
				'emp_first_name'=>$faker->firstName,
				'emp_last_name'=>$faker->lastName,
				'emp_address'=>$faker->address,
				'emp_phone_number'=>$faker->phoneNumber,
				'emp_job'=>'vendedor',
				'emp_email'=>$faker->unique()->email,
				'emp_bus_id' => null,
				'emp_password'=>Hash::make('1234')
			]);
		}
		
	}

}
