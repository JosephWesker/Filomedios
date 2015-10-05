<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_evaluation extends Model {

	protected $table = 'fil_evaluation';
	protected $primaryKey = 'eva_id';
	protected $fillable = ['eva_fk_employee_result','eva_fk_evaluation_param','eva_month','eva_year','eva_result'];

	public function employeeResult(){
		return $this->BelongsTo('App\fil_employee_result','eva_fk_employee_result','emr_id');
	}

	public function EvaluationParam(){
		return $this->BelongsTo('App\fil_evaluation_param','eva_fk_evaluation_param','evp_id');
	}

}
