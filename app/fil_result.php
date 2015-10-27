<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_result extends Model {

	protected $table = 'fil_result';
	protected $primaryKey = 'res_id';
	protected $fillable = ['res_customer_porcent','res_visits_average','res_duration_average','res_sales_volume'];

	public function evaluations(){
		return $this->hasMany('App\fil_evaluation','eva_res_id','res_id');
	}

}
