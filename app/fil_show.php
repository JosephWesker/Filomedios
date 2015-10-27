<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_show extends Model {

	protected $table = 'fil_show';
	protected $primaryKey = 'sho_pro_id';
	protected $fillable = ['sho_pro_id','sho_duration','sho_replays'];

	public function product(){
		return $this->belongsTo('App\fil_product','sho_pro_id','pro_id');
	}

}
