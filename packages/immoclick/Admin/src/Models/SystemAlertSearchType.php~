<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class SystemAlertSearchType extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_system_alert_search_type';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['AlertID','TypeID','updated_at','created_at'];
    
    
    public function systemAlertSearch()
    {
        return $this->belongsTo('Immoclick\Admin\Models\SystemAlertSearch','AlertID','id');
    }

    public function buildingType()
    {
        return $this->belongsTo('Immoclick\Admin\Models\BuildingType','TypeID','id');
    }	
    
  

}


