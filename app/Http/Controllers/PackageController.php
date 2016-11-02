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
use App\Helpers\Helper as Helper;
use Response;
use Cookie;
use Hash;
/**
 * Class AdminController
 */
class PackageController extends Controller {
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
        if(strlen($this->lang)==2)
        {
            $this->lang = $helper->getLanguage($this->lang); 
        }else{
            $this->lang = $helper->getLanguage(null); 
        }
       // dd($request->path());
        View::share('lang', $this->lang);
        View::share('helper', new Helper);
        $online_since = Building::where('status', 1)->groupBy('Built_in')->get();
        View::share('online_since', $online_since);   
    }

    /*
     * Dashboard
     * */

    public function index(Package $package, Request $request) {

        $page_title     = 'Package'; 
        $page_action    = 'View Package';
        $building       = Building::with(['buildingImage', 'user', 'btype', 'package', 'bcategory', 'city'])->get();
        $max_price      = 1500000;
        $min_price      = 0;
        $types          = Building::with(['btype'])->groupBy('TypeID')->get();
        $types          = BuildingType::all();
        $categories     = BuildingCategory::orderBy('NameEN','ASC')->get();
        $cities         = Building::with(['city'])->groupBy('CityID')->get();
        $regions        = Region::orderBy('Name','ASC')->get();
        $rooms          = Building::where('status', 1)->groupBy('Rooms_number')->get();
        $region_id      = []; 
        
        $classic    = Package::find(1);
        $premium    = Package::find(2);
        $prestige   = Package::find(3);
        
        $packages =  Package::all();
       
        
        return view('package.package', compact('prestige','premium','classic','packages','categories','online_since','region_id', 'rooms', 'building', 'max_price', 'min_price', 'types', 'cities', 'regions', 'helper'));
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

    public function store(PackageRequest $request, Package $package) {
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
            $fileName = '';
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
                        ->with('flash_alert_notice', 'New Package was successfully created !');
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
