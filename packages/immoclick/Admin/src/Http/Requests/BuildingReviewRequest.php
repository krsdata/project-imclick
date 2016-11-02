<?php

namespace Immoclick\Admin\Http\Requests;

use App\Http\Requests\Request;
use Input;

class BuildingReviewRequest extends Request {

    /**
     * The metric validation rules.
     *
     * @return array
     */
    public function rules() {
       if ( $buildingReview = $this->buildingReview ) {
            switch ( $this->method() ) {
                case 'GET':
                case 'DELETE': {
                        return [ ];
                    }
                case 'POST': {
                        return [
                               
                                'Rate'         => "required" ,     
                                'Text'        => "required|integer" , 
                                'saving'        => "required|integer" ,
                        ];
                    }
                case 'PUT':
                case 'PATCH': {
                    if ($buildingReview=$this->buildingReview) {

                        return [
                                'Rate'         => "required|integer" ,     
                                'Text'        => "required" , 
                                'saving'        => "required|integer" ,                                
                        ];
                    }
                }
                default:break;
            }
        }
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
