<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class HomeType extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_home_type';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['FRName','ENName'];

}


