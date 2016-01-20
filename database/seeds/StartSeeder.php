<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class startSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(){
        $faker = Faker\Factory::create();
        //Start Business Unit
        DB::table('fil_business_unit')->insert([
            'bus_name'=>'Plaza Americas Xalapa',
            'bus_address'=>'Carretera Federal 140,Pastoresa,Xalapa Enríquez, Ver.'
        ]);
        //End Business Unit
        //Start Show
        DB::table('fil_show')->insert([
            'sho_name'=>'Al Aire',
            'sho_description'=>'Programa de noticias',
            'sho_media'=>'televisión',
            'sho_status'=>'activo'
        ]);
        DB::table('fil_show')->insert([
            'sho_name'=>'Americas Life',
            'sho_description'=>'Programa de espectaculos',
            'sho_media'=>'televisión',
            'sho_status'=>'activo'
        ]);
        DB::table('fil_show')->insert([
            'sho_name'=>'Deporte al 100',
            'sho_description'=>'Programa de deportes',
            'sho_media'=>'televisión',
            'sho_status'=>'activo'
        ]);
        DB::table('fil_show')->insert([
            'sho_name'=>'Venue',
            'sho_description'=>'Video musical',
            'sho_media'=>'televisión',
            'sho_status'=>'activo'
        ]);
        DB::table('fil_show')->insert([
            'sho_name'=>'Bloopers',
            'sho_description'=>'programa de videos graciosos',
            'sho_media'=>'televisión',
            'sho_status'=>'activo'
        ]);
        DB::table('fil_show')->insert([
            'sho_name'=>'Los 5 Mejores Goles',
            'sho_description'=>'programa de deportes',
            'sho_media'=>'televisión',
            'sho_status'=>'activo'
        ]);
        DB::table('fil_show')->insert([
            'sho_name'=>'Institucionales',
            'sho_description'=>'Programas sobre la institución',
            'sho_media'=>'televisión',
            'sho_status'=>'activo'
        ]);
        //End Show
        //Start Products
        DB::table('fil_product')->insert([
            'pro_id'=>'1',
            'pro_name'=>'Spot 20 Segundos',
            'pro_description'=>'',
            'pro_type'=>'transmisión',
            'pro_status'=>'activo'
        ]);
        DB::table('fil_service_proyection')->insert([
            'spy_id'=>'1',
            'spy_proyection_media'=>'televisión',
            'spy_has_show'=>'0',
            'spy_duration'=>'20',
            'spy_outlay'=>'6'
        ]);
        DB::table('fil_product')->insert([
            'pro_id'=>'2',
            'pro_name'=>'Cintillos de 10 Segundos',
            'pro_description'=>'',
            'pro_type'=>'transmisión',
            'pro_status'=>'activo'
        ]);
        DB::table('fil_service_proyection')->insert([
            'spy_id'=>'2',
            'spy_proyection_media'=>'televisión',
            'spy_has_show'=>'1',
            'spy_duration'=>'10',
            'spy_outlay'=>'6'
        ]);
        DB::table('fil_product')->insert([
            'pro_id'=>'3',
            'pro_name'=>'Nota Comercial',
            'pro_description'=>'',
            'pro_type'=>'transmisión',
            'pro_status'=>'activo'
        ]);
        DB::table('fil_service_proyection')->insert([
            'spy_id'=>'3',
            'spy_proyection_media'=>'televisión',
            'spy_has_show'=>'1',
            'spy_duration'=>NULL,
            'spy_outlay'=>'200'
        ]);
        DB::table('fil_product')->insert([
            'pro_id'=>'4',
            'pro_name'=>'Patrocinio de programa',
            'pro_description'=>'',
            'pro_type'=>'transmisión',
            'pro_status'=>'activo'
        ]);
        DB::table('fil_service_proyection')->insert([
            'spy_id'=>'4',
            'spy_proyection_media'=>'televisión',
            'spy_has_show'=>'1',
            'spy_duration'=>NULL,
            'spy_outlay'=>'250'
        ]);
        DB::table('fil_product')->insert([
            'pro_id'=>'5',
            'pro_name'=>'Cobertura informativa con boletin de prensa',
            'pro_description'=>'',
            'pro_type'=>'transmisión',
            'pro_status'=>'activo'
        ]);
        DB::table('fil_service_proyection')->insert([
            'spy_id'=>'5',
            'spy_proyection_media'=>'televisión',
            'spy_has_show'=>'1',
            'spy_duration'=>NULL,
            'spy_outlay'=>'300'
        ]);
        DB::table('fil_product')->insert([
            'pro_id'=>'6',
            'pro_name'=>'Cobertura informativa con reportero y camarografo',
            'pro_description'=>'',
            'pro_type'=>'transmisión',
            'pro_status'=>'activo'
        ]);
        DB::table('fil_service_proyection')->insert([
            'spy_id'=>'6',
            'spy_proyection_media'=>'televisión',
            'spy_has_show'=>'1',
            'spy_duration'=>NULL,
            'spy_outlay'=>'450'
        ]);
        DB::table('fil_product')->insert([
            'pro_id'=>'7',
            'pro_name'=>'Banner superior fijo (30 Dias)',
            'pro_description'=>'',
            'pro_type'=>'transmisión',
            'pro_status'=>'activo'
        ]);
        DB::table('fil_service_proyection')->insert([
            'spy_id'=>'7',
            'spy_proyection_media'=>'web',
            'spy_has_show'=>'0',
            'spy_duration'=>NULL,
            'spy_outlay'=>'33.34'
        ]);
        DB::table('fil_product')->insert([
            'pro_id'=>'8',
            'pro_name'=>'Banner superior Movil (15 Dias)',
            'pro_description'=>'',
            'pro_type'=>'transmisión',
            'pro_status'=>'activo'
        ]);
        DB::table('fil_service_proyection')->insert([
            'spy_id'=>'8',
            'spy_proyection_media'=>'web',
            'spy_has_show'=>'0',
            'spy_duration'=>NULL,
            'spy_outlay'=>'53.34'
        ]);
        DB::table('fil_product')->insert([
            'pro_id'=>'9',
            'pro_name'=>'Cuadro banner laterial (30 Dias)',
            'pro_description'=>'',
            'pro_type'=>'transmisión',
            'pro_status'=>'activo'
        ]);
        DB::table('fil_service_proyection')->insert([
            'spy_id'=>'9',
            'spy_proyection_media'=>'web',
            'spy_has_show'=>'0',
            'spy_duration'=>NULL,
            'spy_outlay'=>'26.66'
        ]);
        DB::table('fil_product')->insert([
            'pro_id'=>'10',
            'pro_name'=>'Nota comercial en secciones (10 Dias)',
            'pro_description'=>'',
            'pro_type'=>'transmisión',
            'pro_status'=>'activo'
        ]);
        DB::table('fil_service_proyection')->insert([
            'spy_id'=>'10',
            'spy_proyection_media'=>'web',
            'spy_has_show'=>'0',
            'spy_duration'=>NULL,
            'spy_outlay'=>'70'
        ]);
        DB::table('fil_product')->insert([
            'pro_id'=>'11',
            'pro_name'=>'Producción Spot 20 Segundos',
            'pro_description'=>'',
            'pro_type'=>'producción',
            'pro_status'=>'activo'
        ]);
        DB::table('fil_service_production')->insert([
            'spr_id'=>'11',
            'spr_has_production_registry'=>'1',
            'spr_outlay'=>'1500'
        ]);
        DB::table('fil_product')->insert([
            'pro_id'=>'12',
            'pro_name'=>'Producción Cintillo 10 Segundos',
            'pro_description'=>'',
            'pro_type'=>'producción',
            'pro_status'=>'activo'
        ]);
        DB::table('fil_service_production')->insert([
            'spr_id'=>'12',
            'spr_has_production_registry'=>'0',
            'spr_outlay'=>'850'
        ]);
        DB::table('fil_product')->insert([
            'pro_id'=>'13',
            'pro_name'=>'Producción Nota Comercial',
            'pro_description'=>'',
            'pro_type'=>'producción',
            'pro_status'=>'activo'
        ]);
        DB::table('fil_service_production')->insert([
            'spr_id'=>'13',
            'spr_has_production_registry'=>'0',
            'spr_outlay'=>'1500'
        ]);
        DB::table('fil_product')->insert([
            'pro_id'=>'14',
            'pro_name'=>'Diseño de Banner',
            'pro_description'=>'',
            'pro_type'=>'producción',
            'pro_status'=>'activo'
        ]);
        DB::table('fil_service_production')->insert([
            'spr_id'=>'14',
            'spr_has_production_registry'=>'0',
            'spr_outlay'=>'500'
        ]);
	}

}
