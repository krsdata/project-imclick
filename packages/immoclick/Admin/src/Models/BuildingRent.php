<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class BuildingRent extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_building_rent';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['BuildingID' ,'Type','price_by_month','already_rent','updated_at','created_at'];
    
    
    public function building()
    {
        return $this->belongsTo('Immoclick\Admin\Models\Building','BuildingID','id');
    }
    
  

}


