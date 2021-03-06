<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class SystemAlertSearch extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_system_alert_search';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['Code','Email','Disabled' ,'Min_price','Max_price','Min_rooms_number',
				'Min_bathroom_number',
				'Brand_new',
				'Free_tour',
				'Living_area_size',
				'Property_size',
				'Garage',
				'Pool',
				'No_neighbors_behind',
				'updated_at','created_at'];
    
    
    public function alertSearchType()
    {
        return $this->hasOne('Immoclick\Admin\Models\SystemAlertSearchType','id','AlertID');
    }
    
  

}


