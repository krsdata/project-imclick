<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Package extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_building_package';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['Price','Month','NameFR','NameEN'];
    
    
    public function building() 
    {
        return $this->hasMany('Immoclick\Admin\Models\Building','PackageID','id');
    }

}


