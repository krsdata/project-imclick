<?php

namespace Immoclick\Admin\Http\Requests;

use App\Http\Requests\Request;
use Input;

class SystemAlertSearchRequest extends Request {

    /**
     * The metric validation rules.
     *
     * @return array
     */
    public function rules() {
        
            switch ( $this->method() ) {
                case 'GET':
                case 'DELETE': {
                        return [ ];
                    }
                case 'POST': {
                        return [
                               
                                
                                'Email'             =>  'email',
                                'Disabled'          =>  'integer',
                                'Min_price'         =>  'integer',
                                'Max_price'         =>  'integer',
                                'Min_rooms_number'  =>  'integer',
                                'Min_bathroom_number'=> 'integer',
                                'Brand_new'         =>  'integer',
                                'Free_tour'         =>  'integer',
                                'Living_area_size'  =>  'integer',
                                'Property_size'     =>  'integer',
                                'Garage'            =>  'integer',
                                'Pool'              =>  'integer',
                                'No_neighbors_behind'=> 'integer',   
                                 
                        ];
                    }
                case 'PUT':
                case 'PATCH': {
                    if ( $systemAlertSearch = $this->systemAlertSearch ) {

                        return [

                               
                                'Email'             =>  'email',
                                'Disabled'          =>  'integer',
                                'Min_price'         =>  'integer',
                                'Max_price'         =>  'integer',
                                'Min_rooms_number'  =>  'integer',
                                'Min_bathroom_number'=> 'integer',
                                'Brand_new'         =>  'integer',
                                'Free_tour'         =>  'integer',
                                'Living_area_size'  =>  'integer',
                                'Property_size'     =>  'integer',
                                'Garage'            =>  'integer',
                                'Pool'              =>  'integer',
                                'No_neighbors_behind'=> 'integer',                                   
                        ];
                    }
                }
                default:break;
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
