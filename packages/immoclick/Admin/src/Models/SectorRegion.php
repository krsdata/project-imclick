<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class SectorRegion extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_sector_region';
    protected $guarded = ['created_at' , 'updated_at' , 'RegionID' ];
    protected $fillable = ['Region_Name','Class'];

}


