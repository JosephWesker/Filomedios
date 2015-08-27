<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fm_user extends Model {	
    protected $table =  'fm_user';
    protected  $primaryKey  = 'use_id';
    
    public function employees(){
        return $this->hasMany('App\fm_employee','emp_fk_user');
    }
}
