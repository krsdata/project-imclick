<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class SystemAlertSearchCity extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_system_alert_search_city';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['AlertID','CityID','updated_at','created_at'];
    
    
    public function systemAlertSearch()
    {
        return $this->belongsTo('Immoclick\Admin\Models\SystemAlertSearch','AlertID','id');
    }

    public function city()
    {
        return $this->belongsTo('Immoclick\Admin\Models\City','CityID','id');
    }	
    
  

}


