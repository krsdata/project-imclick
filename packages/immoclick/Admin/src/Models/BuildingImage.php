<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class BuildingImage extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_building_image';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['BuildingID', 'File_name', 'Title', 'Description_fr', 'Description_en', 'img_index', 'updated_at', 'created_at'];
    
    
    public function user()
    {
        return $this->belongsTo('Immoclick\Admin\Models\User','UserID','id');
    }
    
    public function city()
    {
        return $this->belongsTo('Immoclick\Admin\Models\City','CityID','id');
    }
    
    public function package()
    {
        return $this->belongsTo('Immoclick\Admin\Models\Package','PackageID','id');
    }
    
     public function bcategory()
    {
        return $this->belongsTo('Immoclick\Admin\Models\BuildingCategory','CategoryID','id');
    }
    
    public function btype()
    {
        return $this->belongsTo('Immoclick\Admin\Models\BuildingType','TypeID','id');
    }
    
    public function building()
    {
        return $this->belongsTo('Immoclick\Admin\Models\Building','BuildingID','id');
    }
}


