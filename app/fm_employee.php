<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fm_employee extends Model
{
    protected $table =  'fm_employee';
    protected  $primaryKey  = 'emp_id';
    
    public function customer(){
        return $this->hasMany('App\fm_customer');
    }
}
