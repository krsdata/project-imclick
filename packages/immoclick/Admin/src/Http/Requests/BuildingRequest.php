<?php

namespace Immoclick\Admin\Http\Requests;

use App\Http\Requests\Request;
use Input;

class BuildingRequest extends Request {

    /**
     * The metric validation rules.
     *
     * @return array
     */
    public function rules() {
        //if ( $metrics = $this->metrics ) {
            switch ( $this->method() ) {
                case 'GET':
                case 'DELETE': {
                        return [ ];
                    }
                case 'POST': {
                        return [
                            'CityID'   => "required" ,
                            'PackageID'   => "required" ,
                            'CategoryID'   => "required" ,
                            'TypeID'   => "required" ,

                            'Built_in'   => "required" ,
                            'Price'   => "required" ,
                            'Default_Picture'   => "required" ,
                            'HouseNumber'   => "required" ,
                            'City_Name'   => "required" ,
                            'Postal_code'   => "required" ,
                           
                           // 'Picture'   => "required|mimes:jpeg,bmp,png,gif,PNG,jpg" ,
                

                             
                        ];
                    }
                case 'PUT':
                case 'PATCH': {
                    if ( $building= $this->building ) {

                        return [
                            //'PackageID'             => "required" ,
                            //'CategoryID'            => "required" ,
                            //'TypeID'                => "required" ,
                            'Built_in'              => "required|integer" ,
                            'Price'                 => "required|numeric" ,
                            'Picture'               => "mimes:jpeg,png,gif|image" ,
                            //'HouseNumber'           => "required" ,
                            //'City_Name'             => "required" ,
                            //'Postal_code'           => "required" , 
                            'Star'                  => 'integer',
                            'Rooms_number'          => 'integer',
                            'Bathroom_number'       => 'integer',
                            'Parking_outdoor_number'=> 'integer',
                            'Parking_garage_number' => 'integer',
                            'School_taxes_by_year'  => 'integer',
                            'Municipal_taxes_by_year'=> 'integer',
                            'Electricity_by_year'   => 'integer',
                            'Insurance_by_year'     => 'integer',
                            'Mortgage_by_year'      => 'integer',
                            'No_neighbors_behind'   => 'integer',
                            'School_taxes_by_year'  => 'integer',
                            'School_taxes_by_year'  => 'integer',
                            'Brand_new'             => 'integer',
                            'Free_tour'             => 'integer',
                            'Living_area_size_feet' => 'integer',
                            'Property_size_feet'    => 'integer',
                            'Living_area_size_meter'=> 'integer',
                            'Property_size_meter'   => 'integer',
                            'Garage'                => 'integer',
                            'Pool'                  => 'integer',
                            'No_neighbors_behind'   => 'integer',
                            'Evaluation_ground'     => 'integer',
                            'Evaluation_building'   => 'integer',
                            'Evaluation_total'      => 'integer',  
                            
                        ];
                    }
                }
                default:break;
            }
        //}
    }

    /**
     * The
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

}
