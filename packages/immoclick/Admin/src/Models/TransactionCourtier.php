<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class TransactionCourtier extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_transaction_courtier';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['updated_at','created_at'];
    
    
    public function user()
    {
        return $this->belongsTo('Immoclick\Admin\Models\User','UserID','id');
    } 
    
    public function homeType()
    {
        return $this->belongsTo('Immoclick\Admin\Models\HomeType','PackageID','id');
    }
    
     public function transaction_courtier()
    {
        return $this->hasMany('Immoclick\Admin\Models\TransactionCourtier','id','CourtierID');
    }
    
    public function region()
    {
        return $this->belongsTo('Immoclick\Admin\Models\Region','SectorID','id');
    }
    
  

}


