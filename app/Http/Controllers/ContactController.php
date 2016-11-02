<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Immoclick\Admin\Http\Requests\UserRequest;
use Immoclick\Admin\Http\Requests\PackageRequest;
use Immoclick\Admin\Models\Group;
use Immoclick\Admin\Models\Package;
use Immoclick\Admin\Models\City;
use Immoclick\Admin\Models\Region;
use Immoclick\Admin\Models\BuildingCategory;
use Immoclick\Admin\Models\BuildingType;
use Immoclick\Admin\Models\Building;
use Immoclick\Admin\Models\User;
use Immoclick\Admin\Models\BuildingChoice;
use Immoclick\Admin\Models\buildingRoom;
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
use App\Helpers\Helper as Helper;
use Response;
use Cookie;
use Hash;
use Input;
/**
 * Class AdminController
 */
class ContactController extends Controller {
    /**
     * @var  Repository
     */

    /**
     * Displays all admin.
     *
     * @return \Illuminate\View\View
     */
    public function __construct(Request $request) {
     //   $this->middleware('auth');
        View::share('viewPage', 'package');
        $this->lang = $request->segment(1);
        $helper = new Helper;
        $this->lang = $helper->getLanguage($this->lang);
        View::share('lang', $this->lang);
        View::share('helper', new Helper);
        $online_since = Building::where('status', 1)->groupBy('Built_in')->get();
        View::share('online_since', $online_since);
        
    }

    /*
     * Dashboard
     * */

    public function index(User $package, Request $request) {

          
        
        $building = Building::with(['buildingImage', 'user', 'btype', 'package', 'bcategory', 'city'])->get();
        $max_price      = 1500000;
        $min_price      = 0;
        $types = Building::with(['btype'])->groupBy('TypeID')->get();
        $types = BuildingType::all();
        $categories = BuildingCategory::orderBy('NameEN','ASC')->get();
        $cities = Building::with(['city'])->groupBy('CityID')->get();
        $regions = Region::orderBy('Name','ASC')->get();
        $rooms = Building::where('status', 1)->groupBy('Rooms_number')->get();
        $region_id = [];  

        return view('contact.index', compact('categories','online_since','region_id', 'rooms', 'building', 'max_price', 'min_price', 'types', 'cities', 'regions', 'helper'));
    }

    /*
     * create Group method
     * */

    public function create(Package $package) {

        $grps = Group::where('Title', '!=', 'Admin')->get();

        $page_title = 'Package';
        $page_action = 'Create Package';

        return view('packages::package.create', compact('grps', 'package', 'page_title', 'page_action', 'groups'));
    }

    /*
     * Save Group method
     * */

    public function store(Request $request) { 
              
        $data=Input::all();
        $validator =  Validator::make($data, [               
               'Phone' => 'required|numeric|min:8', 
               'email' => 'required|email',
               'your_msg' => 'required',              
            ]);
            if($validator->fails())
            {                
                $errors = $validator->messages();  
                echo json_encode($errors->all());
                exit();
            }
            else
            {
                $helper = new Helper; 
                $email_content = array('receipent_email'=> 'info@immo-clic.ca','subject'=>'Contact Information');
                //$email_content = array('receipent_email'=> 'ismael12@mailinator.com','subject'=>'Contact Information');
                $dd = $helper->sendMailFrontEnd($email_content,'Contact', $data); 
                return Redirect::to(route('contact'))
                        ->with('flash_alert_notice', 'Merci de nous avoir écrit!');
            }

    }

    /*
     * Edit Group method
     * */

    public function edit(Package $package) {

        $page_title = 'Package';
        $page_action = 'View Package';

        return view('packages::package.edit', compact('package', 'page_title', 'page_action'));
    }

    public function update(PackageRequest $request, Package $package) {

        $package->fill(Input::all());
        $form_input = Input::all();
        if (Input::hasFile('Picture')) {
            $file = Input::file('Picture');
        } else {
            $file = '';
        }
        if ($file != '') {
            $image_name = $file->getClientOriginalName();
            $img_path = public_path('uploads/package/');
            $extension = Input::file('Picture')->getClientOriginalExtension(); // getting image extension
            $fileName = time() . '.' . $extension;
            $uploaded_at = $file->move($img_path, $fileName);
        } else {
            $fileName = Input::get('tmpPicture');
        }

//            $lang = Input::get('language');
//            $packageLang = ($lang == 'en')?'er':'en'; 
//            if($packageLang=='en')
//            {
//               $package->NameEN = Input::get('PackageName');
//               $package->NameFR = "";
//            }else
//            {
//                 $package->NameFR = Input::get('PackageName');
//                 $package->NameEN = ""; 
//            } 

        $package->Picture_HDR = $fileName;
        $package->save();

        return Redirect::to(route('package'))
                        ->with('flash_alert_notice', 'Package was successfully updated !');
    }

    public function destroy(Package $package) {
        Package::destroy($package->id);

        return Redirect::to(route('package'))
                        ->with('alert_class', 'Package was successfully deleted!');
    }

    public function show(Package $package) {
        
    }

}
