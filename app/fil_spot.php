<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_spot extends Model {

	protected $table = 'fil_spot';
	protected $primaryKey = 'spo_pro_id';
	protected $fillable = ['spo_pro_id','spo_impacts','spo_duration'];

	public function product(){
		return $this->belongsTo('App\fil_product','spo_pro_id','pro_id');
	}

}
