<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fm_customer extends Model
{
    protected $table = 'fm_customer';
    protected  $primaryKey = 'cus_id';
    
    public function employee(){
        return $this->belongsTo('App\fm_employee','cus_fk_employee');
    }
    
    public function tax_data(){
        return $this->hasMany('App\fm_tax_data','tax_fk_customer');
    }
}
