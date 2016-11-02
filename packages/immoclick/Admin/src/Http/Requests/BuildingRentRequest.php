<?php

namespace Immoclick\Admin\Http\Requests;

use App\Http\Requests\Request;
use Input;

class BuildingRentRequest extends Request {

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
                               
                                'Type'         => "required" ,     
                                'price_by_month'        => "required|integer" ,     
                                 
                        ];
                    }
                case 'PUT':
                case 'PATCH': {
                    if ( $buildingRent= $this->buildingRent ) {

                        return [
                                'Type'         => "required" ,     
                                'price_by_month'        => "required|integer" ,                                 
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
