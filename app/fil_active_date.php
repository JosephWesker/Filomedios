<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_active_date extends Model {

	protected $table = 'fil_active_date';
	protected $primaryKey = 'act_id';
	protected $fillable = ['act_id','act_start_date','act_end_date'];

	public function proyectionSpot(){
		return $this->belongsTo('App\fil_proyection_spot','act_id','spo_id');
	}

}
