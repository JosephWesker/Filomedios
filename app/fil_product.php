<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_product extends Model {

	protected $table = 'fil_product';
	protected $primaryKey = 'pro_id';
	protected $fillable = ['pro_type','pro_description','pro_has_show','pro_has_scheme','pro_duration_type','pro_duration','pro_daily_impacts','pro_outlay'];

	public function packagesDetail(){
		return $this->hasMany('App\fil_package_detail','pad_fk_product','pro_id');
	}

	public function detailProducts(){
		return $this->hasMany('App\fil_detail_product','det_fk_product','pro_id');
	}
}
