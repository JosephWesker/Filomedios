<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_product extends Model {

	protected $table = 'fil_product';
	protected $primaryKey = 'pro_id';
	protected $fillable = ['pro_name','pro_description','pro_outlay','pro_type'];

	public function web(){
		return $this->hasOne('App\fil_web','web_pro_id','pro_id');
	}

	public function spot(){
		return $this->hasOne('App\fil_spot','spo_pro_id','pro_id');
	}

	public function show(){
		return $this->hasOne('App\fil_show','sho_pro_id','pro_id');
	}

	public function production(){
		return $this->hasOne('App\fil_production','prd_pro_id','pro_id');
	}

	public function fil_product_fil_service_order(){
		return $this->hasMany('App\fil_product_fil_service_order','pso_pro_id','pro_id');
	}
}
