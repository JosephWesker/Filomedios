<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(){
		DB::table('fil_employee')->insert([
				'emp_first_name'=>'Administrador',
				'emp_last_name'=>'',
				'emp_address'=>'',
				'emp_phone_number'=>'',
				'emp_job'=>'administrador',
				'emp_email'=>'admin@admin.com',
				'emp_bus_id' => null,
				'emp_password'=>Hash::make('admin')
			]);
	}

}
