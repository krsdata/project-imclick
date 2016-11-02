<?php

namespace Immoclick\Admin\Http\Requests;

use App\Http\Requests\Request;
use Input;

class BuildingRoomRequest extends Request {

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
                                 
                                'Room'         => "required|integer" ,     
                                'Stage'        => "required|integer" ,     
                                'Width_X'        => "required|integer" ,     
                                'Height_Y'        => "required|integer" ,     
                                    
                        ];
                    }
                case 'PUT':
                case 'PATCH': {
                    if ( $buildingRoom= $this->buildingRoom ) {

                        return [
                                 
                                 
                                'Room'         => "required|integer" ,     
                                'Stage'        => "required|integer" ,     
                                'Width_X'        => "required|integer" ,     
                                'Height_Y'        => "required|integer" ,   
                                                      
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
