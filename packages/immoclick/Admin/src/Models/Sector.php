<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Sector extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_city';
    protected $guarded = ['created_at' , 'updated_at' , 'CityID' ];
    protected $fillable = ['CityName','CountryID'];
}


