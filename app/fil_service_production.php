<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_service_production extends Model {

	protected $table = 'fil_service_production';
	protected $primaryKey = 'spr_id';
	protected $fillable = ['spr_has_production_registry','spr_outlay'];
	public $incrementing = false;

	public function product(){
		return $this->belogsTo('App\fil_product','spr_id','pro_id');
	}

}
