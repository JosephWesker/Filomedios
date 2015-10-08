<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_service_proyection extends Model {

	protected $table = 'fil_service_proyection';
	protected $primaryKey = 'spy_id';
	protected $fillable = ['spy_proyection_media','spy_has_show','spy_has_transmission_scheme','spy_duration','spy_outlay'];

	public function product(){
		return $this->belogsTo('App\fil_product','spr_id','pro_id');
	}

}
