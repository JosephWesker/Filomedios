<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_customer extends Model {

	protected $table = 'fil_customer';
	protected $primaryKey = 'cus_id';
	protected $fillable = ['cus_commercial_name','cus_contact_first_name','cus_contact_last_name','cus_job','cus_phone_number','cus_phone_extension','cus_cellphone_number','cus_email','cus_address','cus_status','cus_business_activity','cus_fk_employee'];

	public function employee(){
		return $this->belongsTo('App\fil_employee','cus_fk_employee','emp_id');
	}

	public function taxData(){
		return $this->hasOne('App\fil_tax_data','tax_fk_customer','cus_id');
	}

	public function ServiceOrders(){
		return $this->hasMany('App\fil_service_order','ser_fk_customer','cus_id');
	}
}