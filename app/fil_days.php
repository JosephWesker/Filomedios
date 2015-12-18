<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_days extends Model {

	protected $table = 'fil_days';
	protected $primaryKey = 'day_id';

	public function videos(){
		return $this->hasMany('App\fil_videos','vid_fk_days','day_id');
	}

}
