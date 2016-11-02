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
use Immoclick\Admin\Models\BuildingImage;
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
use Immoclick\Admin\Models\BuildingPackage;
/**
 * Class ImagesController
 */
class ImagesController extends Controller {
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
        View::share('viewPage', 'Acheter');
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
    }

    /*
     * Dashboard
     * */

    public function index(Request $request) {
        $user = Auth::user();
        
        //Redirect user if not logged in
        if(!isset($user))
        {
            return redirect('/');
        }
        
        $buildingID = Input::get('buildingID');
        $building = Building::where("id", $buildingID)->where("UserID", $user->UserID)->get();
        
        //Redirect user if building id is not link to the current user.
        if(count($building) == 0)
        {
            return redirect('/');
        }
        
        $images = BuildingImage::where("BuildingID", $buildingID)->where('enable', 1)->orderBy('img_index', 'ASC')->get();
        
        $page_title     = 'Images'; 
        $page_action    = 'View Images';
        $max_price      = 1500000;
        $min_price      = 0;
        $types          = Building::with(['btype'])->groupBy('TypeID')->get();
        $types          = BuildingType::all();
        $categories     = BuildingCategory::orderBy('NameEN','ASC')->get();
        $cities         = Building::with(['city'])->groupBy('CityID')->get();
        $regions        = Region::orderBy('Name','ASC')->get();
        $rooms          = Building::where('status', 1)->groupBy('Rooms_number')->get();
        $region_id      = []; 
        
        return view('images.index', compact('categories','online_since','region_id', 'rooms', 'building', 'max_price', 'min_price', 'types', 'cities', 'regions', 'user', 'images'));
    }

    public function myimages(Request $request) {
        $user = Auth::user();
        
        //Redirect user if not logged in
        if(!isset($user))
        {
            return redirect('/');
        }
        
        $buildingID = Input::get('buildingID');
        $building = Building::where("id", $buildingID)->where("UserID", $user->UserID)->get();
        
        //Redirect user if building id is not link to the current user.
        if(count($building) == 0)
        {
            return redirect('/');
        }
        
        $images = BuildingImage::where("BuildingID", $buildingID)->orderBy('enable', 'DESC')->orderBy('img_index', 'ASC')->get();
        $package = BuildingPackage::where("id", $building[0]->PackageID)->first();
        $titles = BuildingChoice::where('GroupID', "CODE_DESCRIPTION_PHOTO")->orderBy('Value_FR', 'ASC')->get();
        $page_title     = 'Images'; 
        $page_action    = 'View Images';
        $max_price      = 1500000;
        $min_price      = 0;
        $types          = Building::with(['btype'])->groupBy('TypeID')->get();
        $types          = BuildingType::all();
        $categories     = BuildingCategory::orderBy('NameEN','ASC')->get();
        $cities         = Building::with(['city'])->groupBy('CityID')->get();
        $regions        = Region::orderBy('Name','ASC')->get();
        $rooms          = Building::where('status', 1)->groupBy('Rooms_number')->get();
        $region_id      = []; 
        
        return view('images.my-images', compact('categories','online_since','region_id', 'rooms', 'building', 'buildingID','max_price', 'min_price', 'types', 'cities', 'regions', 'user', 'images', 'package', 'titles'));
    }
    
    /*
     *updateindeximages method
     * @param
     * Methos : get
     */
    public function updateindeximages(Request $request)
    {
        try 
        {
            if ($request->ajax()) {
                $user = Auth::user();
                
                if(!isset($user))
                {
                    return "Erreur";
                    exit();
                }
                
                $data =  Input::all(); 
                
                $i = 1;

                foreach ($data['item'] as $value) {
                    
                    \DB::table('t_building_image')->join('t_building', 't_building.id', '=', 't_building_image.BuildingID')->where('t_building_image.id', $value)->where('t_building.UserID', $user->UserID)->update(['t_building_image.img_index' => $i]);
                    
                    $i++;
                }
            } 
        }
        catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }    
        echo Lang::get('website-lang.Succeed_img_order_set');
        exit;
    }
    
    /*
     *updateindeximages method
     * @param
     * Methos : get
     */
    public function edittitle(Request $request)
    {
        try 
        {
            if ($request->ajax()) {
                $user = Auth::user();
                
                if(!isset($user))
                {
                    return "Erreur";
                    exit();
                }
                
                $buildingID = Input::get('buildingID');
                $imageId = Input::get('imageId');
                $title = Input::get('title');
                
                $building = Building::where("id", $buildingID)->where("UserID", $user->UserID)->get();
                
                //Redirect user if building id is not link to the current user.
                if(count($building) == 0)
                {
                    return "Erreur building not linked to the current user";
                    exit();
                }
                
                \DB::table('t_building_image')->join('t_building', 't_building.id', '=', 't_building_image.BuildingID')->where('t_building.id', $buildingID)->where('t_building.UserID', $user->UserID)->where('t_building_image.ID', $imageId)->update(['t_building_image.Title' => $title]);
                
            } 
        }
        catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }    
        echo "Nouvelle description sauvegard&eacute;e";
        exit;
    }
    
    /*
     *updateindeximages method
     * @param
     * Methos : get
     */
    public function enableimages(Request $request)
    {
        try 
        {
            if ($request->ajax()) {
                $user = Auth::user();
                
                if(!isset($user))
                {
                    return "Erreur";
                    exit();
                }
                
                $data =  Input::all(); 
                
                $buildingID = Input::get('buildingID');
                $imagesIds = Input::get('imagesIds');
                $imagesIds = rtrim($imagesIds, ",");
                $imagesIds = explode(",", $imagesIds);
                
                $building = Building::where("id", $buildingID)->where("UserID", $user->UserID)->get();
                
                //Redirect user if building id is not link to the current user.
                if(count($building) == 0)
                {
                    return "Erreur building not linked to the current user";
                    exit();
                }
                \DB::table('t_building_image')->join('t_building', 't_building.id', '=', 't_building_image.BuildingID')->where('t_building.id', $buildingID)->where('t_building.UserID', $user->UserID)->update(['t_building_image.enable' => 0]);

                $images = BuildingImage::where("BuildingID", $buildingID)->whereIn('ID', $imagesIds)->orderBy('img_index', 'ASC')->get();
                
                foreach ($images as $image) {
                	\DB::table('t_building_image')->join('t_building', 't_building.id', '=', 't_building_image.BuildingID')->where('t_building.id', $buildingID)->where('t_building.UserID', $user->UserID)->where('t_building_image.ID', $image->ID)->update(['t_building_image.enable' => 1]);
                }
            } 
        }
        catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }    
        echo "Les images s&eacute;lectionn&eacute; ont bien &eacute;t&eacute; choisi pour &ecirc;tre dans votre fiche de propri&eacute;t&eacute;.";
        exit;
    }
}
