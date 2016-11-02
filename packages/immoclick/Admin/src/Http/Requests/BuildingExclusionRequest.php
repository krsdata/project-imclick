<?php

namespace Immoclick\Admin\Http\Requests;

use App\Http\Requests\Request;
use Input;

class BuildingExclusionRequest extends Request {

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
                               
                                'Exclusion'         => "required",     
                                
                                 
                        ];
                    }
                case 'PUT':
                case 'PATCH': { 
                    if ( $buildingExclusion= $this->buildingExclusion ) {

                        return [
                                'Exclusion'         => "required",                                
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
