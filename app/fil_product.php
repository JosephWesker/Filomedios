<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_product extends Model {

	protected $table = 'fil_product';
	protected $primaryKey = 'pro_id';
	protected $fillable = ['pro_name','pro_description','pro_type'];

	public function packagesDetail(){
		return $this->hasMany('App\fil_package_detail','pad_fk_product','pro_id');
	}

	public function serviceProyection(){
		return $this->hasOne('App\fil_service_proyection','spy_id','pro_id');
	}

	public function serciceProduction(){
		return $this->hasOne('App\fil_service_production','spr_id','pro_id');
	}

	public function detailProducts(){
		return $this->hasMany('App\fil_detail_product','det_fk_product','pro_id');
	}
}
