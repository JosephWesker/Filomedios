<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fm_date_data extends Model {
    protected $table = 'fm_date_data';
    protected  $primaryKey = 'dat_id';
        
    public function service_order(){
        return $this->belongsTo('App\fm_service_order','tax_fk_date_data');
    }
}
