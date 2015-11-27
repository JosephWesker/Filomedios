<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_detail_product extends Model {

	protected $table = 'fil_detail_product';
	protected $primaryKey = 'det_id';
	protected $fillable = ['det_fk_service_order','det_fk_product','det_fk_business_unit','det_fk_show','det_impacts','det_validity','det_discount','det_final_price','det_description'];

	public function transmissionScheme(){
		return $this->hasOne('App\fil_transmission_scheme','tra_id','det_id');
	}

	public function detailProduction(){
		return $this->hasOne('App\fil_detail_production','dpr_id','det_id');
	}

	public function serviceOrder(){
		return $this->belongsTo('App\fil_service_order','det_fk_service_order','ser_id');
	}

	public function product(){
		return $this->belongsTo('App\fil_product','det_fk_product','pro_id');
	}

	public function businessUnit(){
		return $this->belongsTo('App\fil_business_unit','det_fk_business_unit','bus_id');
	}

	public function show(){
		return $this->belongsTo('App\fil_show','det_fk_show','sho_id');
	}
}
