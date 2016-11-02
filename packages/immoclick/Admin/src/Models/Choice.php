<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Choice extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_choice';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['GroupID' ,'Value_FR', 'Value_EN'];
}


