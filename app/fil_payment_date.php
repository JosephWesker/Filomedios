<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_payment_date extends Model {

	protected $table = 'fil_payment_date';
	protected $primaryKey = 'pda_id';
	protected $fillable = ['pda_fk_payment_data','pda_date','pda_amount','pda_status'];

	public function paymentScheme(){
		return $this->belongsTo('App\fil_payment_scheme','pda_fk_payment_data','pay_id');
	}

	public function realPayments(){
		return $this->hasMany('App\fil_real_payment','rpa_fk_payment_date','pda_id');
	}

}
