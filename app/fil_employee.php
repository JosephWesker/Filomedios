<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_employee extends Model {

	protected $table = 'fil_employee';
	protected $primaryKey = 'emp_id';
	protected $fillable = ['emp_first_name','emp_last_name','emp_address','emp_phone_number','emp_cellphone_number','emp_job','emp_bus_id','emp_email','emp_password'];

	public function customers(){
		return $this->hasMany('App\fil_customer','cus_emp_id','emp_id');
	}

	public function evaluations(){
		return $this->hasMany('App\fil_evaluation','eva_emp_id','emp_id');
	}

	public function businessUnit(){
		return $this->belongsTo('App\fil_business_unit','emp_bus_id','bus_id');
	}
}
