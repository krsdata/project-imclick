<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CommercantsVedette extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_commercants_vedette';
    protected $guarded = ['created_at' , 'updated_at' ];
    protected $fillable = ['SectorID', 'CommercantID','updated_at','created_at'];

}


