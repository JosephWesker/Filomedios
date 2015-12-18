<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_schedule extends Model {

	protected $table = 'fil_schedule';
	protected $primaryKey = 'sch_id';

	public function videos(){
		return $this->hasMany('App\fil_videos','vid_fk_schedule','sch_id');
	}
}
