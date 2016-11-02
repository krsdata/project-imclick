<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class BuildingRoom extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_building_room';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['BuildingID' ,'Room','Stage','Width_X','Width_Pouce','Height_Y','Height_Pouce','Dimension','Floor_type'];
    
    
    public function building()
    {
        return $this->belongsTo('Immoclick\Admin\Models\Building','BuildingID','id');
    }
    
  

}


