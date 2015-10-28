<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_detail_production extends Model {

	protected $table = 'fil_detail_production';
	protected $primaryKey = 'dpr_id';
	protected $fillable = ['dpr_id','dpr_recording_date','dpr_proposal_1_date','dpr_proposal_2_date','dpr_status'];

	public function detailProduct(){
		return $this->belongsTo('App\fil_detail_product','dpr_id','det_id');
	}

	public function productionRegistry(){
		return $this->hasOne('App\fil_production_registry','prr_id','dpr_id');
	}

}
