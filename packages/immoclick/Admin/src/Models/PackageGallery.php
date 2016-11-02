<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class PackageGallery extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_package_gallery';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['PictureURL'];

    
     public function package()
    {
        return $this->hasOne('Immoclick\Admin\Models\Package','id','PackageID');
    }
}


