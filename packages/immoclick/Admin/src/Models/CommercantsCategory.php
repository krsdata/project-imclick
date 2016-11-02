<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CommercantsCategory extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_commercants_category';
    protected $guarded = ['created_at' , 'updated_at' ];
    protected $fillable = ['id', 
                            'NameFR', 
                            'NameEN', 
                            'Class', 
                            'Logo', 
                            'img', 
                            'updated_at', 
                            'created_at'];

}


