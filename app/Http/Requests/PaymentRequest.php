<?php

namespace App\Http\Requests;

 
use Input;

class PaymentRequest extends Request {

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
                            'credit_card'   => "required|integer" ,
                            'cvv'           => "required" ,
                            'month'         => "required",
                            'year'          => "required",
                        ];
                    }
                case 'PUT':
                case 'PATCH': {
                    if ( $admin = $this->admin ) {

                        return [
                            'credit_card'   => "required|integer" ,
                            'cvv'           => "required" ,
                            'month'         => "required",
                            'year'         => "required",
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
