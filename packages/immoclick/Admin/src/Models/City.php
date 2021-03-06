<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class City extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_building_city';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['CityName','RegionID'];
    
    public function region()
    {
        return $this->belongsTo('Immoclick\Admin\Models\Region','RegionID','id');
    }
    public function building()
    {
        return $this->hasMany('Immoclick\Admin\Models\Building','CityID','id');
    }

}


