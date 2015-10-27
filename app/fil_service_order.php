<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_service_order extends Model {

	protected $table = 'fil_service_order';
	protected $primaryKey = 'ser_id';
	protected $fillable = ['ser_id','ser_discount_month','ser_outlay_total','ser_iva','ser_duration','ser_start_date','ser_end_date','ser_cus_id','ser_auth_admin','ser_auth_production','ser_auth_sales'];

	public function customer(){
		return $this->belongsTo('App\fil_customer','ser_cus_id','cus_id');
	}

	public function detailProduction()){
		return $this->hasOne('App\fil_detail_production','dpr_ser_id','ser_id');
	}

	public function paymentsDate(){
		return $this->hasMany('App\fil_payment_date','pad_ser_id','ser_id');
	}

	public function fil_product_fil_service_order(){
		return $this->hasMany('App\fil_product_fil_service_order','pso_ser_id','ser_id');
	}
}
