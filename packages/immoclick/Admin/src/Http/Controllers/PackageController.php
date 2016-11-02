<?php

namespace Immoclick\Admin\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Immoclick\Admin\Http\Requests\UserRequest;
use Immoclick\Admin\Http\Requests\PackageRequest;
use Immoclick\Admin\Models\User;
use Immoclick\Admin\Models\Group;
use Immoclick\Admin\Models\Package;
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
class PackageController extends Controller {
    /**
     * @var  Repository
     */

    /**
     * Displays all admin.
     *
     * @return \Illuminate\View\View
     */
    public function __construct() {
        $this->middleware('auth');
        View::share('viewPage', 'package');
    }

    /*
     * Dashboard
     * */

    public function index(Package $package, Request $request) {

        $page_title = 'Package'; 
        $page_action = 'View Package';
        $search = Input::get('search');
        if (isset($search) && !empty($search)) { 
            // echo $search;
            $packages = Package::with('building')->where('NameFR', 'LIKE', "%$search%")
                            ->orWhere('NameEN', 'LIKE', "%$search%")->get();
        } else { 
            $packages = Package::with('building')->get();
        } 

        return view('packages::package.index', compact('packages', 'page_title', 'page_action'));
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
