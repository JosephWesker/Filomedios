<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_business_unit extends Model {

	protected $table = 'fil_business_unit';
	protected $primaryKey = 'bus_id';
	protected $fillable = ['bus_name','bus_address'];

	public function employees(){
		return $this->hasMany('App\fil_employee','emp_fk_business_unit','bus_id');
	}
}
