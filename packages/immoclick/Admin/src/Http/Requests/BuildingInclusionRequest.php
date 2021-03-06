<?php

namespace Immoclick\Admin\Http\Requests;

use App\Http\Requests\Request;
use Input;

class BuildingInclusionRequest extends Request {

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
                               
                                'Inclusion'         => "required",     
                                
                                 
                        ];
                    }
                case 'PUT':
                case 'PATCH': { 
                    if ( $buildingInclusion= $this->buildingInclusion ) {

                        return [
                                'Inclusion'         => "required",                                
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
