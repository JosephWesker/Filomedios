<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fm_postal_code extends Model {
	protected $table =  'fm_postal_code';
    protected $primaryKey  = 'ps_postal_code';
    public $timestamps = false;
}
