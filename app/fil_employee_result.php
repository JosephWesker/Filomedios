<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_employee_result extends Model {

	protected $table = 'fil_employee_result';
	protected $primaryKey = 'emr_id';
	protected $fillable = ['emr_fk_employee','emr_customer_porcent','emr_visits_average','emr_duration_average','emr_sales_volume'];

	public function evaluation(){
		return $this->hasOne('App\fil_evaluation','eva_fk_evaluation_param','emr_id');
	}

	public function employee(){
		return $this->belongsTo('App\fil_employee','emr_fk_employee','emp_id');
	}
}
