<?php
namespace Immoclick\Admin\Http\Controllers;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Immoclick\Admin\Http\Requests\LoginRequest;
use Immoclick\Admin\Http\Requests\ForgotPasswordRequest;
use Immoclick\Admin\Models\AdminLogin; 
use Immoclick\Admin\Models\Country; 
use Immoclick\Admin\Models\Advertise;
use Input;
use Validator;
use Auth;
use Paginate;
use Grids;
use HTML;
use Form;
use View;
use URL;
use Lang;
use App\Http\Controllers\Controller;




 
/**
 * Class AdminController
 */
class AdvertisementController extends Controller { 
    /**
     * @var  Repository
     */ 
    /**
     * Displays all admin.
     *
     * @return \Illuminate\View\View
     */
    
    
    public function __construct()
    {
        //
    }
    /*
    * Dashboard
    **/
    public function index() { 
       
        if(!Auth::check()){
           return Redirect::to('admin/login');
        }
       return view('packages::dashboard.index');
    }
     public function login(LoginRequest $request , AdminLogin $adminLogin) { 
       return view('packages::loginpage.login',compact( 'adminLogin')); 
    }
   /*
    * Create ad
    **/
    public function create()  {

        $countries =  Country::lists('country_name','id');
         
        return view('packages::advertisement.index',compact('countries')); 
        
    }

    public function store(){

            $form_input = Input::all(); 

            if (Input::hasFile('image'))
            {
              $file = Input::file('image');            
            } else {
              $file = '';
            }
             
            if($file != '')
            {        
                $image_name  = $file->getClientOriginalName();        
                $img_path    = public_path('uploads/ad/');
                $extension   = Input::file('image')->getClientOriginalExtension(); // getting image extension
                $fileName    = time().'.'.$extension;
                $is_uploaded = $file->move($img_path, $fileName);

            } else {
                $image_name = '';
            }

           
            $advertiseObj = new Advertise;
            $advertiseObj->advertisement_name = $form_input['advertisement_name'];
            $advertiseObj->advertisement_type = $form_input['advertisement_type'];
            $advertiseObj->advertisement_script = $form_input['advertisement_script'];
            $advertiseObj->ad_image = $fileName;
            $advertiseObj->advertisement_url = $form_input['advertisement_url'];
            $expiry_date = date('Y-m-d', strtotime($form_input['expiration_date']));
            $advertiseObj->expiration_date = $expiry_date;
            $advertiseObj->country_id = ($form_input['country_id'] != '') ? $form_input['country_id'] : '';
            $advertiseObj->published = 1;
            $advertiseObj->save();

           
            return true; 

    }

}
