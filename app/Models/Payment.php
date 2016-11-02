<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_payments';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = [''];
    
}


