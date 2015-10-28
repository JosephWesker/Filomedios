<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_invoice_data extends Model {

	protected $table = 'fil_invoice_data';
	protected $primaryKey = 'ind_id';
	protected $fillable = ['ind_cfdi'];

	public function realPayments(){
		return $this->hasMany('App\fil_real_payment','rpa_invoice_data','ind_id');
	}

}
