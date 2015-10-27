<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_evaluation extends Model {

	protected $table = 'fil_evaluation';
	protected $primaryKey = 'eva_id';
	protected $fillable = ['eva_emp_id','eva_goa_id','eva_tim_id','eva_res_id','eva_achieved_goals'];

	public function result(){
		return $this->belongsTo('App\fil_result','eva_res_id','res_id');
	}

	public function goals(){
		return $this->belongsTo('App\fil_goals','eva_goa_id','goa_id');
	}

	public function time(){
		return $this->belongsTo('App\fil_time','eva_tim_id','tim_id');
	}

	public function employee(){
		return $this->belongsTo('App\fil_employee','eva_emp_id','emp_id');
	}

}
