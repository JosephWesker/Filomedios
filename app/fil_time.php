<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_time extends Model {

	protected $table = 'fil_time';
	protected $primaryKey = 'tim_id';
	protected $fillable = ['tim_year','tim_semester','tim_trimester','tim_month'];

	public function evaluations(){
		return $this->hasMany('App\fil_evaluation','eva_fk_time','tim_id');
	}

}
