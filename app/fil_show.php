<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_show extends Model {

	protected $table = 'fil_show';
	protected $primaryKey = 'sho_id';
	protected $fillable = ['sho_name','sho_description','sho_media','sho_impacts','sho_duration','sho_status'];

	public function detailProducts(){
		return $this->hasMany('App\fil_detail_product','det_fk_show','sho_id');
	}
}
