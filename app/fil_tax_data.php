<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_tax_data extends Model {

	protected $table = 'fil_tax_data';
	protected $primaryKey = 'tax_emp_id';
	protected $fillable = ['tax_emp_id','tax_rfc','tax_business_name','tax_street','tax_outdoor_number','tax_apartment_number','tax_colony','tax_postal_code','tax_town','tax_locality','tax_state','tax_country','tax_tax_email','tax_legal_representative'];

	public function customer(){
		return $this->belongsTo('App\fil_customer','tax_emp_id','cus_id');
	}
}
