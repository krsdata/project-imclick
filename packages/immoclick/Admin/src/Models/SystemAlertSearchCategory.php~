<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class SystemAlertSearchCategory extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_system_alert_search_category';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['AlertID','CategoryID','updated_at','created_at'];
    
    
    public function systemAlertSearch()
    {
        return $this->belongsTo('Immoclick\Admin\Models\SystemAlertSearch','AlertID','id');
    }

    public function buildingCategory()
    {
        return $this->belongsTo('Immoclick\Admin\Models\BuildingCategory','CategoryID','id');
    }	
    
  

}


