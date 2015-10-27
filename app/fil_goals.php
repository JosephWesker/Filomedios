<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_goals extends Model {

	protected $table = 'fil_goals';
	protected $primaryKey = 'goa_id';
	protected $fillable = ['goa_customer_porcent','goa_visits_average','goa_duration_average','goa_sales_volume'];

	public function evaluations(){
		return $this->hasMany('App\fil_evaluation','eva_goa_id','goa_id');
	}

}
