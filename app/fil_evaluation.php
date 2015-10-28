<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_evaluation extends Model {

	protected $table = 'fil_evaluation';
	protected $primaryKey = 'eva_id';
	protected $fillable = ['eva_fk_employee','eva_fk_goal','eva_fk_time','eva_fk_result','eva_achieved_goals'];

	public function result(){
		return $this->belongsTo('App\fil_result','eva_fk_result','res_id');
	}

	public function goals(){
		return $this->belongsTo('App\fil_goals','eva_fk_goal','goa_id');
	}

	public function time(){
		return $this->belongsTo('App\fil_time','eva_fk_time','tim_id');
	}

	public function employee(){
		return $this->belongsTo('App\fil_employee','eva_fk_employee','emp_id');
	}

}
