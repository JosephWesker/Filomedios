<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_web extends Model {

	protected $table = 'fil_web';
	protected $primaryKey = 'web_pro_id';
	protected $fillable = ['web_pro_id','web_validity','web_media','web_replays'];

	public function product(){
		return $this->belongsTo('App\fil_product','web_pro_id','pro_id');
	}

}
