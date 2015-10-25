<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_package extends Model {

	protected $table = 'fil_package';
	protected $primaryKey = 'pac_id';
	protected $fillable = ['pac_name','pac_description'];

	public function packagesDetail(){
		return $this->hasMany('App\fil_package_detail','pad_fk_package','pac_id');
	}

}
