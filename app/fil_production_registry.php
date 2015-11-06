<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class fil_production_registry extends Model {

	protected $table = 'fil_production_registry';
	protected $primaryKey = 'prr_pro_id';
	protected $fillable = ['prr_id','prr_proposal_1','prr_customer_answer_1','prr_customer_answer_1_comment','prr_proposal_2','prr_customer_answer_2','prr_customer_answer_2_comment','prr_proposal_3','prr_customer_answer_3','prr_customer_answer_3_comment','prr_customer_approbation'];
	public $incrementing = false;

	public function detailProduction(){
		return $this->belongsTo('App\fil_detail_production','prr_id','dpr_id');
	}

}
