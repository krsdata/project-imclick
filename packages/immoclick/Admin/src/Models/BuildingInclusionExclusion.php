<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class BuildingInclusionExclusion extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_building_inclusion_exclusion';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['BuildingID' ,'Exclusion','updated_at','created_at'];
    
    
    public function building()
    {
        return $this->belongsTo('Immoclick\Admin\Models\Building','BuildingID','id');
    }
    
  

}


