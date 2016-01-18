<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class videosSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(){
        $faker = Faker\Factory::create();
        for ($i=0; $i <= 100; $i++) { 
            DB::table('fil_videos')->insert([
				'vid_detail_product'=>NULL,
				'vid_name'=>'apocalyptica - broken pieces.mp4',
				'vid_type'=>$faker->randomElement(array ('Comercial','programación')),
				'vid_duration'=>'03:54:00',
				'vid_url'=>'C:\xampp\htdocs\Filomedios\storage/app/videos/abp.mp4',
				'vid_start_date'=>$faker->dateTimeBetween('-1years','now'),
				'vid_end_date' => $faker->dateTimeBetween('now','+1 years'),
			]);
        }		
	}

}
