<?php
namespace Immoclick\Admin\Http\Controllers; 

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Immoclick\Admin\Http\Requests\LoginRequest;
use Immoclick\Admin\Http\Requests\ForgotPasswordRequest;
use Immoclick\Admin\Models\AdminLogin; 
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
class AdminController extends Controller { 
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
        $this->middleware( 'auth' );
    }
    /*
    * Dashboard
    **/
    public function index() { 
       return view('packages::dashboard.index');
    }
     public function login(LoginRequest $request , AdminLogin $adminLogin) {         
       return view('packages::loginpage.login',compact( 'adminLogin')); 
    }
   /*
    * Forgot password method
    **/
    public function forgotPassword( ForgotPasswordRequest $request , AdminLogin $adminLogin )
    {
        return view('packages::loginpage.forgot-pwd'); 
    }

}
