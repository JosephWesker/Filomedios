<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_product_fil_service_order extends Model {

	protected $table = 'fil_product_fil_service_order';
	protected $primaryKey = 'pso_id';
	protected $fillable = ['pso_ser_id','pso_pro_id','pso_amount','pso_subtotal'];

	public function serviceOrder(){
		return $this->belongsTo('App\fil_service_order','pso_ser_id','ser_id');
	}

	public function product(){
		return $this->belongsTo('App\fil_product','pso_pro_id','pro_id');
	}
}
