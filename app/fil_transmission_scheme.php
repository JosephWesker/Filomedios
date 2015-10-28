<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_transmission_scheme extends Model {

	protected $table = 'fil_transmission_scheme';
	protected $primaryKey = 'tra_id';
	protected $fillable = ['tra_id','tra_monday','tra_tuesday','tra_wednesday','tra_thrusday','tra_friday','tra_saturday','tra_sunday'];

	public function detailProduct(){
		return $this->belongsTo('App\fil_detail_product','tra_id','det_id');
	}

	public function proyectionSpot(){
		return $this->hasOne('App\fil_proyection_spot','spo_id','tra_id');
	}

}
