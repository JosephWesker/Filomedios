<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_proyection_spot extends Model {

	protected $table = 'fil_proyection_spot';
	protected $primaryKey = 'spo_id';
	protected $fillable = ['spo_id','spo_duration','spo_url'];

	public function transmissionScheme(){
		return $this->belongsTo('App\fil_transmission_scheme','spo_id','tra_id');
	}

	public function activeDate(){
		return $this->hasOne('App\fil_active_date','act_id','spo_id');
	}

}
