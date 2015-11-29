<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_service_order extends Model {

	protected $table = 'fil_service_order';
	protected $primaryKey = 'ser_id';
	protected $fillable = ['ser_id','ser_discount_month','ser_outlay_total','ser_iva','ser_duration','ser_start_date','ser_end_date','ser_fk_customer','ser_auth_admin','ser_auth_production','ser_auth_sales'];
	public $incrementing = false;

	public function customer(){
		return $this->belongsTo('App\fil_customer','ser_fk_customer','cus_id');
	}

	public function paymentScheme(){
		return $this->hasOne('App\fil_payment_scheme','pay_id','ser_id');
	}

	public function detailsProducts(){
		return $this->hasMany('App\fil_detail_product','det_fk_service_order','ser_id');
	}
}
