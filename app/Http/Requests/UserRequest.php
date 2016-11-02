<?php

namespace App\Http\Requests;

 
use Input;

class UserRequest extends Request {

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
                            'FirstName'   => "" , 
                        ];
                    }
                case 'PUT':
                case 'PATCH': {
                    

                        return [
                            'FirstName'   => "" , 
                        ];
                    
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
