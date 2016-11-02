<?php

namespace Immoclick\Admin\Http\Requests;

use App\Http\Requests\Request;
use Input;

class PackageGalleryRequest extends Request {

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
                            'Package'   => "required" ,
                            'Picture'   => "required|mimes:jpeg,bmp,png,gif,PNG,jpg" ,
                

                             
                        ];
                    }
                case 'PUT':
                case 'PATCH': {
                    

                        return [
                             'Package'   => "required" ,
                             'Picture'   => "mimes:jpeg,bmp,png,gif,PNG,jpg" ,
                        ];
                     
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
