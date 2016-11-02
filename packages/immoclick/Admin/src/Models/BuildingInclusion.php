<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class BuildingInclusion extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_building_inclusion';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['BuildingID' ,'Inclusion','updated_at','created_at'];
    
    
    public function building()
    {
        return $this->belongsTo('Immoclick\Admin\Models\Building','BuildingID','id');
    }
    
  

}


