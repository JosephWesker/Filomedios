<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_invoice_data extends Model {

	protected $table = 'fil_invoice_data';
	protected $primaryKey = 'ind_id';
	protected $fillable = ['ind_cfdi'];

	public function paymentDate(){
		return $this->belongsTo('App\fil_payment_date','ind_id','pda_id');
	}

}
