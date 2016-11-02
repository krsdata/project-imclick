<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Immoclick\Admin\Models\Group;

class AddToFavorite extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_building_favorite';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['UserID','BuildingID','Date','updated_at','created_at'];
    
}


