<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fm_employee extends Model
{
    protected $table =  'fm_employee';
    protected $primaryKey  = 'emp_id';
    protected $fillable = array(
                    'emp_first_name',
                    'emp_last_names',
                    'emp_address',
                    'emp_phone_number',
                    'emp_cellphone_number',
                    'emp_job');
    
    public function customers(){
        return $this->hasMany('App\fm_customer');
    }
    
    public function users(){
        return $this->belongsTo('App\fm_user','emp_fk_user');
    }
}
