<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_business_activity extends Model {

	protected $table = 'fil_business_activity';
	protected $primaryKey = 'act_id';
	protected $fillable = ['act_name'];

}
