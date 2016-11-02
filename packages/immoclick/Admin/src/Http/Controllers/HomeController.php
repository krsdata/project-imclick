<?php
namespace Immoclick\Admin\Http\Controllers;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
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
class HomeController extends Controller { 
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
        View::share ( 'viewPage', '');
    }
    /*
    * Dashboard
    **/
    public function index() { 
         
       return view('packages::immoclic.index');
    } 

}
