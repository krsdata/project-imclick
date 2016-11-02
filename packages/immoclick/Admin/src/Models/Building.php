<?php

namespace Immoclick\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Building extends BaseModel {

    /**
     * The metrics table.
     * 
     * @var string
     */
    protected $table = 't_building';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['UserID',
                            'CityID',
                            'PackageID' ,
                            'CategoryID',
                            'TypeID',
                            'CentrisID',
                            'CentrisLink',
                            'Built_in',
                            'Price',
                            'Default_Picture',
                            'HouseNumber',
                            'City_Name',
                            'Postal_code',
                            'Start_Date',
                            'End_Date',
                            'Latitude',
                            'Longitude',
                            'Star',
                            'Rooms_number',
                            'Bathroom_number',
                            'Parking_outdoor_number',
                            'Parking_garage_number',
                            'Sold',
                            'Brand_new',
                            'Free_tour',
                            'Living_area_size_feet',
                            'Property_size_feet',
                            'Living_area_size_meter',
                            'Property_size_meter',
                            'Garage',
                            'Pool',
                            'No_neighbors_behind',
                            'Mortgage_by_year',
                            'Municipal_taxes_by_year',
                            'School_taxes_by_year',
                            'Electricity_by_year',
                            'Insurance_by_year',
                            'Description_fr',
                            'Description_en',
                            'Evaluation_ground',
                            'Evaluation_building',
                            'Evaluation_total',
                            'Size_land_frontage',
                            'Size_land_depth',
                            'Size_land_area',
                            'Size_building_width',
                            'Size_building_depth',
                            'indoor_cupboard_other',
                            'indoor_heating_energy',
                            'indoor_basement',
                            'indoor_basement_other',
                            'indoor_heating_system',
                            'indoor_heating_system_other',
                            'indoor_windows',
                            'indoor_windows_other',
                            'indoor_windows_type',
                            'indoor_windows_type_other',
                            'indoor_roofing',
                            'indoor_roofing_other',
                            'indoor_equipment_available',
                            'indoor_equipment_available_other',
                            'outdoor_driveway',
                            'outdoor_driveway_other',
                            'outdoor_water_supply',
                            'outdoor_water_supply_other',
                            'outdoor_siding',
                            'outdoor_siding_other',
                            'outdoor_sewage_system',
                            'outdoor_sewage_system_other',
                            'outdoor_landscaping',
                            'outdoor_landscaping_other',
                            'outdoor_foundation',
                            'outdoor_foundation_other',
                            'outdoor_proximity',
                            'outdoor_proximity_other',
                            'outdoor_topography',
                            'outdoor_topography_other',
                            'outdoor_garage',
                            'outdoor_garage_other',
                            'outdoor_pool',
                            'outdoor_pool_other',
                            'updated_at',
                            'created_at'];
    
    
            public function user()
            {
                return $this->belongsTo('Immoclick\Admin\Models\User','UserID');
            }
            
            public function city()
            {
                return $this->belongsTo('Immoclick\Admin\Models\City','CityID','id'); 
            }
            
            public function package()
            {
                return $this->belongsTo('Immoclick\Admin\Models\Package','PackageID','id');
            }
            
            public function bcategory()
            {
                return $this->belongsTo('Immoclick\Admin\Models\BuildingCategory','CategoryID','id');
            }
            
            public function btype()
            {
                return $this->belongsTo('Immoclick\Admin\Models\BuildingType','TypeID','id');
            }

            public function buildingImage()
            {
                return $this->hasMany('Immoclick\Admin\Models\BuildingImage','BuildingID','id');
            }

            public function buildingRoom()
            {
                return $this->hasMany('Immoclick\Admin\Models\BuildingRoom','BuildingID','id'); 
            }
}


