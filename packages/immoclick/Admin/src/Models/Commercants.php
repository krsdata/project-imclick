<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Commercants extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_commercants';
    protected $guarded = ['created_at' , 'updated_at' ];
    protected $fillable = ['id', 
                            'CityID', 
                            'CategoryID', 
                            'Name', 'Logo', 
                            'CityName', 
                            'Mail', 
                            'SiteWeb', 
                            'TexteFR', 
                            'TexteEN', 
                            'ServiceFR', 
                            'ServiceEN', 
                            'Phone', 
                            'Realisations', 
                            'RedirectTo', 
                            'UrlName', 
                            'Span', 
                            'PromoVisitor', 
                            'PromoMember', 
                            'CertifiedLogo', 
                            'updated_at', 
                            'created_at'];

}


