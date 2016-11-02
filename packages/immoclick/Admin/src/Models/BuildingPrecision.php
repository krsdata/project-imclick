<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class BuildingPrecision extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_building_precision';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];    
    protected $fillable = ['NameFR' ,'NameEN','updated_at','created_at'];
}


