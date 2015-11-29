<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_real_payment extends Model {

	protected $table = 'fil_real_payment';
	protected $primaryKey = 'rpa_id';
	protected $fillable = ['rpa_fk_payment_date','rpa_amount','rpa_date','rpa_method','rpa_account'];

	public function paymentDate(){
		return $this->belongsTo('App\fil_payment_date','rpa_fk_payment_date','pda_id');
	}

}
