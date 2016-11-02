<?php

namespace App\Http\Requests;

 
use Input;

class ChangePasswordRequest extends Request {

    /**
     * The metric validation rules.
     *
     * @return array
     */

    
    public function rules() {
        return $rules = array(
        'old_password'          => 'required',
        'new_password'              => 'required|confirmed|different:cnew',
        'cnew_password' => 'required',
    );
                
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
