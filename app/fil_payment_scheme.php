<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_payment_scheme extends Model {

	protected $table = 'fil_payment_scheme';
	protected $primaryKey = 'pay_id';
	protected $fillable = ['pay_id','pay_amount_kind','pay_amount_cash','pay_number_payments'];
	public $incrementing = false;
	
	public function serviceOrder(){
		return $this->belongsTo('App\fil_service_order','pay_id','ser_id');
	}

	public function paymentDates(){
		return $this->hasMany('App\fil_payment_date','pda_fk_payment_data','pay_id');
	}
}
