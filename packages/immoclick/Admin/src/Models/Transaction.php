<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Transaction extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_transaction';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['Transaction_Type',
                            'UserID' ,
                            'Transaction_Date',
                            'BuyOrSold',
                            'CourtierID',
                            'Address',
                            'AddressNumber',
                            'Appartement',
                            'visitor',
                            'Status',
                            'TypeOfProperty',
                            'End_Date',
                            'SectorID',
                            'StreetType',
                            'CityName',
                            'PostalCode',
                            'SectorResearched',
                            'AddedByBroker',
                            'PropertyID',
                            'PAFinale',
                            'LastReminder', 
                            'updated_at',
                            'created_at'];
    
    
    public function user()
    {
        return $this->belongsTo('Immoclick\Admin\Models\User','UserID','UserID');
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


