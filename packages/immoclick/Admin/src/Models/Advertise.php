<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Advertise extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 'advertisement';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['advertisement_name','advertisement_type','advertisement_script','ad_image','advertisement_url','expiration_date','country_id'];

}


