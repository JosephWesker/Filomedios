<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_payment_date extends Model {

	protected $table = 'fil_payment_date';
	protected $primaryKey = 'pda_id';
	protected $fillable = ['pda_ser_id','pda_date','pda_real_date','pda_amount','pda_method','pda_account','pda_status'];

	public function serviceOrder(){
		return $this->belongsTo('App\fil_service_order','pda_ser_id','ser_id');
	}

	public function invoice(){
		return $this->hasOne('App\fil_invoice','inv_pda_id','pda_id');
	}

}
