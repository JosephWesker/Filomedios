<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_videos extends Model {

	protected $table = 'fil_videos';
	protected $primaryKey = 'vid_id';

	public function serviceOrder(){
		return $this->belongsTo('App\fil_detail_product','vid_detail_product','det_id');
	}
}
