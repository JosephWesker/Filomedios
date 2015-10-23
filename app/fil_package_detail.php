<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_package_detail extends Model {

	protected $table = 'fil_package_detail';
	protected $primaryKey = 'pad_id';
	protected $fillable = ['pad_fk_package','pad_fk_product','pad_impacts','pad_validity','pad_discount'];


	public function package(){
		return $this->BelongsTo('App\fil_package','pad_fk_package','pac_id');
	}

	public function product(){
		return $this->BelongsTo('App\fil_product','pad_fk_product','pro_id');
	}
}
