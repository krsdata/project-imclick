<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class BuildingPackage extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_building_package';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];    
    protected $fillable = ['NameFR' ,'NameEN','Price','Month','Picture_HDR','updated_at','created_at'];
}


