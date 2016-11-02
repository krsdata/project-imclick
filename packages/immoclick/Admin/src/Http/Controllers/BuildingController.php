<?php

namespace Immoclick\Admin\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Immoclick\Admin\Http\Requests\UserRequest;
use Immoclick\Admin\Http\Requests\BuildingRequest;
use Immoclick\Admin\Models\User;
use Immoclick\Admin\Models\Group;
use Immoclick\Admin\Models\Package;
use Immoclick\Admin\Models\City;
use Immoclick\Admin\Models\Region;
use Immoclick\Admin\Models\BuildingCategory;
use Immoclick\Admin\Models\BuildingType;
use Immoclick\Admin\Models\Building;
use Illuminate\Pagination\Paginator;
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
class BuildingController extends Controller {
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
        View::share('viewPage', 'building');
    }

    /*
     * Dashboard
     * */

    public function index(Building $building, Request $request) {
        
        $page_title = 'Building';

        $page_action = 'View Building';
        if ($request->ajax()) {
            $id = Input::get('id');
            $status = Input::get('status');
            $data = Building::find($id);
            
            if($status == 3){
                $s = 1;
            }
            else{
                $s = $status + 1;
            }
            
            //$s = ($status == 0) ? $status = 1 : $status = 0;
            $data->status = $s;
            $data->save();
            echo $s;
            exit();
        }
        $search = Input::get('search');
        if (isset($search) && !empty($search)) {
            $search = Input::get('search');

            $users = User::where(function($query) use($search) {
                        if (!empty($search)) {
                            $query->Where('FirstName', 'LIKE', "%$search%")
                                    ->OrWhere('email', 'LIKE', "%$search%");
                        }
                    })->get(['UserID']);
            $userID = [];
            foreach ($users as $key => $user) {
                $userID[] = $user->UserID;
            }
            // dd($userID);

            $buildings = Building::with(['user', 'city', 'package', 'bcategory', 'btype'])
                            ->whereIn('UserID', $userID)->paginate(15);
        } else {
            $buildings = Building::with('user', 'city', 'package', 'bcategory', 'btype')->paginate(15);
        } 

      
        return view('packages::building.index', compact('buildings', 'page_title', 'page_action'));
    }

    /*
     * create Group method
     * */

    public function create(Building $building) {

        $bcat = BuildingCategory::all();
        $btype = BuildingType::all();
        $city = City::all();
        $package = Package::all();
        $user = Package::find(Auth::user()->UserID);

        $page_title = 'Building';
        $page_action = 'Create Building';

        return view('packages::building.create', compact(
                        'user', 'building', 'city', 'btype', 'bcat', 'package', 'page_title', 'page_action'));
    }

    /*
     * Save building 
     * method @ store
     * Request : Post
     * */

    public function store(BuildingRequest $request, Building $building) {
        $building->fill(Input::all());
        $form_input = Input::all();
        if (Input::hasFile('Picture')) {
            $file = Input::file('Picture');
        } else {
            $file = '';
        }
        if ($file != '') {
            $image_name = $file->getClientOriginalName();
            $img_path = public_path('uploads/building/');
            $extension = Input::file('Picture')->getClientOriginalExtension(); // getting image extension
            $fileName = time() . '.' . $extension;
            $uploaded_at = $file->move($img_path, $fileName);
        } else {
            $fileName = '';
        } 
        $building->Default_Picture = $fileName; 
        // dd($building);
        $building->save();

        return Redirect::to(route('building'))
                        ->with('flash_alert_notice', 'Building was successfully updated !');
    }

    /*
     * Edit Group method
     * */

    public function edit(Building $building) {

        $page_title = 'Building';
        $page_action = 'View Building';

        $bcat = BuildingCategory::all();
        $btype = BuildingType::all();
        $city = City::all();
        $package = Package::all();
        $user = Package::find(Auth::user()->UserID);  
        return view('packages::building.edit', compact('bcat', 'btype', 'city', 'package', 'building', 'page_title', 'page_action'));
    }

    public function update(BuildingRequest $request, Building $building) {
        $id= $building->id;
        $input = Input::except('_token','Mortgage_by_year');
        $building->fill($input);
        $form_input = $input;
        if (Input::hasFile('Picture')) {
            $file = Input::file('Picture');
        } else {
            $file = '';
        }
        if ($file != '') {
             
            $image_name = $file->getClientOriginalName();
            if (!file_exists(public_path('uploads/building/'.$id.'/'))) {
                mkdir(public_path('uploads/building/'.$id.'/'), 0777, true);
            }

            $img_path = public_path('uploads/building/'.$id.'/');
            $extension = Input::file('Picture')->getClientOriginalExtension(); // getting image extension
            $fileName = time() . '.' . $extension;
            $uploaded_at = $file->move($img_path, $fileName);
        } else {
            $fileName = Input::get('tmpPicture');
        }


        $building->Default_Picture = $fileName;

        // dd($building);
        $building->save();

        return Redirect::to(route('building'))
                        ->with('flash_alert_notice', 'Building was successfully updated !');
    }

    public function destroy(Building $building) {
        Building::destroy($building->id);

        return Redirect::to(route('building'))
                        ->with('alert_class', 'Package was successfully deleted!');
    }

    public function show(Package $package) {
        
    }

}
