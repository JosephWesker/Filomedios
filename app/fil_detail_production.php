<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_detail_production extends Model {

	protected $table = 'fil_detail_production';
	protected $primaryKey = 'dpr_ser_id';
	protected $fillable = ['dpr_ser_id','dpr_recording_date','dpr_proposal_1_date','dpr_proposal_2_date','dpr_status'];

	public function serviceOrder(){
		return $this->belongsTo('App\fil_service_order','dpr_ser_id','ser_id');
	}

	public function productionRegistry(){
		return $this->hasOne('App\fil_production_registry','prr_ser_id','dpr_ser_id');
	}

}
