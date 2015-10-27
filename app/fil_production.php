<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_production extends Model {

	protected $table = 'fil_production';
	protected $primaryKey = 'prd_pro_id';
	protected $fillable = ['prd_pro_id','prd_need_dates'];

	public function product(){
		return $this->belongsTo('App\fil_product','prd_pro_id','pro_id');
	}

}
