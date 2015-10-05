<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_employee extends Model {

	protected $table = 'fil_employee';
	protected $primaryKey = 'emp_id';
	protected $fillable = ['emp_first_name','emp_last_name','emp_address','emp_phone_number','emp_cellphone_number','emp_job','emp_fk_business_unit','emp_email','emp_password'];

	public function customers(){
		return $this->hasMany('App\fil_customer','cus_fk_employee','emp_id');
	}

	public function results(){
		return $this->hasMany('App\fil_employee_result','emr_fk_employee','emp_id');
	}

	public function businessUnit(){
		return $this->belongsTo('App\fm_business_unit','emp_fk_business_unit','bus_id');
	}
}
