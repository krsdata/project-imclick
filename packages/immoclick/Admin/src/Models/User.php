<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Immoclick\Admin\Models\Group;

class User extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_user';    
    protected $primaryKey='UserID';    
    protected $guarded = ['created_at' , 'updated_at'];
    protected $fillable = ['email','Repository','FirstName','LastName',
    					'remember_token','LastConnectionDate','LastSoldDate','LastBuyDate',
    					'LastTransaction','CityID','GroupID','Language','Phone','Cell','Vacance',
    				'Bilingue','Militaire','Adresse','WebSite','PostalCode','BannerID',
    				'Transaction_Type','Reference','CourtierCityName','SmsNumber','updated_at','created_at'];


    public function group()
    {
        return $this->hasOne('Immoclick\Admin\Models\Group','GroupID','GroupID');
    }
    
    public function getAuthPassword()
    {
         return $this->attributes['Password'];//change the 'passwordFieldinYourTable' with the name of your field in the table
    }
}


