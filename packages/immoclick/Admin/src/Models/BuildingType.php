<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class BuildingType extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_building_type';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['NameFR','NameEN'];

}


