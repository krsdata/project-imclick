<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class BuildingReview extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_review';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['UserID','Date','Rate' ,'Text','saving','Approved','updated_at','created_at'];
    
    
    public function user()
    {
        return $this->belongsTo('Immoclick\Admin\Models\User','UserID','id');
    }
    
  

}


