<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_invoice extends Model {

	protected $table = 'fil_invoice';
	protected $primaryKey = 'inv_pda_id';
	protected $fillable = ['inv_pda_id','inv_cfdi'];

	public function paymentDate(){
		return $this->belongsTo('App\fil_paymnet_date','inv_pda_id','pda_id');
	}

}
