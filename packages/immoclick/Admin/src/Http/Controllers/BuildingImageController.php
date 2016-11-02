<?php

namespace Immoclick\Admin\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Helpers\Helper as Helper;
use App\Http\Requests;
use Illuminate\Http\Request;
use Immoclick\Admin\Http\Requests\UserRequest;
use Immoclick\Admin\Http\Requests\BuildingRequest;
use Immoclick\Admin\Http\Requests\BuildingImageRequest;
use Immoclick\Admin\Models\User;
use Immoclick\Admin\Models\Package;
use Immoclick\Admin\Models\City;
use Immoclick\Admin\Models\BuildingImage;
use Immoclick\Admin\Models\Building;
use Immoclick\Admin\Models\BuildingChoice;
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
class BuildingImageController extends Controller {
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

    public function index(BuildingImage $buildingImage, Request $request) {

        $page_title = 'Building Images'; 
        $page_action = 'View Image';
        $buildingID = Input::get('q');

        if (isset($buildingID) && !empty($buildingID)) {
            $buildingImage = BuildingImage::with(['building'])
                            ->where('BuildingID', $buildingID)->paginate(15);
        } else {
            $buildingImage = BuildingImage::with(['building'])->paginate(15);
        } 
        return view('packages::buildingImage.index', compact('buildingImage', 'page_title', 'page_action'));
    }

    /*
     * create Group method
     * */

    public function create(BuildingImage $buildingImage) {

        $b_id = Input::get('q');
        $building = Building::all();
        $page_title = 'Building Image';
        $page_action = 'Create Building Image';
        $building = Building::where('id', intval($b_id))->get();
        $building_choice = BuildingChoice::where('groupId','CODE_DESCRIPTION_PHOTO')->get();
        //dd($building_choice);
        if (count($building)) {
            $bid = isset($b_id) ? Input::get('q') : 0;
            return view('packages::buildingImage.create', compact('building_choice','bid', 'building', 'buildingImage', 'page_title', 'page_action'));
        } else {
            return Redirect::to(route('building'));
        }
    }

    /*
     * Save Group method
     * */

    public function store(BuildingImageRequest $request, BuildingImage $buildingImage,BuildingChoice $choice) {
        //dd(Input::all());
        
        $id=input::get('BuildingID');
        $files = Input::file('File_name');
        
        foreach ($files as $file) {
            $destinationPath = public_path('uploads/building/'.$id.'/');
            $filename = $file->getClientOriginalName(); 
            $upload_success = $file->move($destinationPath, $filename);
            
            $test = \DB::table('t_building_image')->insertGetId(
            array('BuildingID' => $id, 'File_name' => $filename, 'Title' => "", 'Description_fr' => "", 'Description_en' => "", 'img_index' => 0, 'enable' => 0)
            );
        }
        
        $b_id = $id;
        $building = Building::all();
        $page_title = 'Building Image';
        $page_action = 'Create Building Image';
        $building = Building::where('id', intval($b_id))->get();
        $User = User::where('UserID', intval($building[0]->UserID))->get()->first();
        $building_choice = BuildingChoice::where('groupId','CODE_DESCRIPTION_PHOTO')->get();
        $msg = "Image ajouter et courriel envoy&eacute; avec succ&egrave;s";
        
        $data = array();
        $helper = new Helper; 
        $email_content = array('receipent_email'=>$User->email, 'subject'=>'Vos photos Immo-Clic.ca ont été ajoutées!');
        $helper->sendMailFrontEnd($email_content, 'pictures-added', $data);
        
        if (count($building)) {
            $bid = isset($b_id) ? Input::get('q') : 0;
            return view('packages::buildingImage.create', compact('building_choice','bid', 'building', 'buildingImage', 'page_title', 'page_action', 'msg'));
        } else {
            return Redirect::to(route('building'));
        }
        
        //return view('packages::buildingImage.create', compact('building_choice','bid', 'building', 'buildingImage', 'page_title', 'page_action'));
        //return Redirect::to(route('buildingImage.create'))
    }

    /*
     * Edit Group method
     * */

    public function edit(BuildingImage $buildingImage) {

        $page_title = 'Building';
        $page_action = 'View Building';

        $bcat = BuildingCategory::all();
        $btype = BuildingType::all();
        $city = City::all();
        $package = Package::all();
        $user = Package::find(Auth::user()->id);
        return view('packages::building.edit', compact('bcat', 'btype', 'city', 'package', 'building', 'page_title', 'page_action'));
    }

    public function update(BuildingRequest $request, BuildingImage $buildingImage) {

        $buildingImage->fill(Input::all());
        $form_input = Input::all();
        if (Input::hasFile('Picture')) {
            $file = Input::file('Picture');
        } else {
            $file = '';
        }
        if ($file != '') {
            $image_name = $file->getClientOriginalName();
            $img_path = public_path('uploads/buildingImage/');
            $extension = Input::file('Picture')->getClientOriginalExtension(); // getting image extension
            $fileName = time() . '.' . $extension;
            $uploaded_at = $file->move($img_path, $fileName);
        } else {
            $fileName = Input::get('tmpPicture');
        }


        $buildingImage->File_name = $fileName;

        // dd($building);
        $buildingImage->save();

        return Redirect::to(route('building'))
                        ->with('flash_alert_notice', 'Building Image was successfully updated !');
    }

    public function destroy(BuildingImage $buildingImage) {
        Building::destroy($buildingImage->id);

        return Redirect::to(route('building'))
                        ->with('alert_class', 'Building Image was successfully deleted!');
    }

    public function show(BuildingImage $buildingImage) {
        
    }

}
