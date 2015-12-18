<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_videos extends Model {

	protected $table = 'fil_videos';
	protected $primaryKey = 'vid_id';

	public function serviceOrder(){
		return $this->belongsTo('App\fil_service_order','vid_service_order','ser_id');
	}

	public function days(){
		return $this->belongsTo('App\fil_days','vid_fk_days','day_id');
	}

	public function schedule(){
		return $this->belongsTo('App\fil_schedule','vid_fk_schedule','sch_id');
	}
}
