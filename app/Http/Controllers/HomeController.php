<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Immoclick\Admin\Models\Package;
use Immoclick\Admin\Models\City;
use Immoclick\Admin\Models\Region;
use Immoclick\Admin\Models\Review;
use Immoclick\Admin\Models\BuildingCategory;
use Immoclick\Admin\Models\BuildingType;
use Immoclick\Admin\Models\BuildingImage;
use Immoclick\Admin\Models\Building;
use Immoclick\Admin\Models\User;
use Immoclick\Admin\Models\BuildingChoice;
use Immoclick\Admin\Models\buildingRoom;
use Immoclick\Admin\Models\AddToFavorite;
use Immoclick\Admin\Models\BuildingRent;
use Immoclick\Admin\Models\Commercants;
use Immoclick\Admin\Models\CommercantsCategory;
use Immoclick\Admin\Models\SectorCity;
use App\Models\Payment;
use Input;
use Config;
use View;
use Redirect; 
use App\Helpers\Helper as Helper;
use Validator;
use Response;
use Auth;
use Crypt;
use Cookie;
use Hash;
use Lang;
use Illuminate\Log\Writer;
use Monolog\Logger as Monolog;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use Twilio;

class HomeController extends Controller {

    /**
     * Render language as per selected lang
     * @param $request->segment( 1 );
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request) {
        $this->lang = $request->segment(1);
        $helper = new Helper;
        if(strlen($this->lang)==2)
        {
            $lang = $helper->getLanguage($this->lang); 
        }else{
            $lang = $helper->getLanguage(null); 
        }  
        //View::share('current_path',$request->path());
        View::share('controller','home');
        View::share('lang',$lang);
        View::share('helper', new Helper);
        $online_since = Building::where('status', 1)->groupBy('Built_in')->get();
        View::share('online_since', $online_since);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() { 
        $user = Auth::user();
        //kill cookie if not logged-in
        if(!isset($user))
        {
            setcookie('UserMail', null, -1, '/');
            setcookie('UserPassword', null, -1, '/');
        }
        //setcookie('SectorID', null, -1, '/');
        //setcookie('SectorName', null, -1, '/');
        
        //dd(Auth::user());
        $building   = Building::with(['buildingImage', 'user', 'btype', 'package', 'bcategory', 'city'])->get();
        $max_price  = 1500000;
        $min_price  = 0;
        //$types = Building::with(['btype'])->groupBy('TypeID')->get();
        $types      = BuildingType::all();
        $categories = BuildingCategory::orderBy('NameFR','ASC')->get();
        $cities     = Building::with(['city'])->groupBy('CityID')->get();
        $regions    = Region::orderBy('Name','ASC')->get();
        $rooms      = Building::where('status', 2)->groupBy('Rooms_number')->get();
        $region_id  = [];  
        $star_building = Building::where('status', 2)->where('Star', 1)->where('Sold', 0)->orderBy('Start_Date','DESC')->take(3)->get();
		$reviews = Review::where('Approved', 1)->orderBy('Date','DESC')->take(5)->get();
        $CategoryCommercants = Helper::GetCategoryCommercants(0);
        
        
        //echo $islogin = isset(Auth::user()->id)?Auth::user()->id:0;die;

        return view('home.index', compact('categories','online_since','region_id', 'rooms', 'building', 'max_price', 'min_price', 'types', 'cities', 'regions', 'helper', 'star_building', 'reviews','islogin', 'CategoryCommercants'));
    }
    
    public function commentcamarche(){
        $building   = Building::with(['buildingImage', 'user', 'btype', 'package', 'bcategory', 'city'])->get();
        $max_price  = 1500000;
        $min_price  = 0;
        //$types = Building::with(['btype'])->groupBy('TypeID')->get();
        $types      = BuildingType::all();
        $categories = BuildingCategory::orderBy('NameFR','ASC')->get();
        $cities     = Building::with(['city'])->groupBy('CityID')->get();
        $regions    = Region::orderBy('Name','ASC')->get();
        $rooms      = Building::where('status', 2)->groupBy('Rooms_number')->get();//TODO change status to 2
        $region_id  = [];  
        $star_building = Building::where('status', 2)->where('Star', 1)->orderBy('Start_Date','DESC')->take(3)->get();//TODO change status to 2
		$reviews = Review::where('Approved', 1)->orderBy('Date','DESC')->take(5)->get();

        //echo $islogin = isset(Auth::user()->id)?Auth::user()->id:0;die;

        return view('home.comment-ca-marche', compact('categories','online_since','region_id', 'rooms', 'building', 'max_price', 'min_price', 'types', 'cities', 'regions', 'helper', 'star_building', 'reviews'));
    }
    
    public function SetSector(){
        
        $sectorID = Input::get('choose_area');
        $sectorName = Input::get('sectorName');
        $current_path = Input::get('current_path');
        
        setcookie("SectorID", $sectorID, time()+2592000,"/");
        setcookie("SectorName", $sectorName, time()+2592000,"/");

        return redirect('/' . $current_path);
    }
    
    public function getCommercants(){
        
        $CatID = Input::get('CatID');
        $CityID = Input::get('CityID');
        $Language = Input::get('Language');
        
        
        $ListCommercants = Helper::GetCommercantForCat($CatID ,$CityID ,$Language);
        echo Helper::CreatePopupHtmlCommercantsByCat($ListCommercants,$CatID,"FR");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * Display search record
     * Method @get
     */
    public function searchResult() {

        $building = Building::with(['buildingImage', 'user', 'btype', 'package', 'bcategory', 'city'])->get();
        
        $max_price  = 1500000;
        $min_price  = 0;
        $types = Building::with(['btype'])->groupBy('TypeID')->get();
        $cities = Building::with(['city'])->groupBy('CityID')->get();

        $regions = Region::orderBy('Name','ASC')->get();
        $rooms = Building::where('status', 2)->groupBy('Rooms_number')->get();

        return view('home.search', compact('rooms', 'building', 'max_price', 'min_price', 'types', 'cities', 'regions'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * Display detail of particular record
     * Method @get
     */
    public function searchDetail() {
        
        $id = Input::get('id');
        if (isset($id) && intval($id)) { 
            

            //$building = Building::with(['buildingImage', 'user', 'btype', 'package', 'bcategory', 'city', 'buildingRoom'])
                  //          ->where('id', $id)->get(); 
            
            $cityID=\DB::select('select CityID from t_building where id='.$id);
            if(!empty($cityID[0])){
                $city_id=$cityID[0]->CityID;
            }
            else{
                $city_id=array();
            }            
            $building = Building::with(['user', 'btype', 'package', 'bcategory', 'city', 'buildingRoom'])->whereIn('CityID',array($city_id))->get(); 
            $images = BuildingImage::join('t_choice', 't_choice.ID', '=', 't_building_image.Title')->where('BuildingID', $id)->where('GroupID', "CODE_DESCRIPTION_PHOTO")->where('t_building_image.enable','1')->orderBy('t_building_image.img_index', 'ASC')->get();  
          //  dd($images);
            $rents = BuildingRent::join('t_choice', 't_choice.ID', '=', 't_building_rent.Type')->where('BuildingID', $id)->where('GroupID', "NBUN")->get();             
            $con = mysqli_connect("mysql.kenotronix.com","sa","Captiv_111$");
            $protectedID = mysqli_real_escape_string($con, stripslashes($id));
            mysqli_close($con);
            
            $building_rooms = "";
            
            if(is_numeric($protectedID)){
                $building_rooms = \DB::select("select r.*, CC.Value_FR as 'Floor_Name_FR', CC.Value_EN as 'Floor_Name_EN', 
                CP.Value_FR as 'Room_Name_FR', CP.Value_EN as 'Room_Name_EN', 
                CN.Value_FR as 'Room_Stage_FR', CN.Value_EN as 'Room_Stage_EN' 
                from t_building_room r 
                INNER JOIN t_choice CC ON CC.ID = r.Floor_type 
                INNER JOIN t_choice CP ON CP.ID = r.Name 
                INNER JOIN t_choice CN ON CN.ID = r.Stage 
                WHERE CP.GroupID = 'PIECE_CODE' 
                AND CC.GroupID = 'COUVRE_PLANCHER_CODE' 
                AND CN.GroupID = 'ETAGE' 
                AND r.BuildingID = " . $protectedID);
            }
           // echo "<pre>";print_r($building);die;
           // dd($building_rooms );
            $dimension = array();
            $dimension2 = array();
            if(!empty($building[0]))
            {
                
                foreach ($building[0]->buildingRoom as $key => $value) {

                    $dimension[$key]['width_x'] = $value->Width_X;
                    $dimension[$key]['height_y'] = $value->Height_Y;
                    $dimension[$key]['name'] = $value->Name;
                    $dimension[$key]['stage'] = $value->Stage;
                    $floor_type = explode(',', $value->Floor_type);
                    //dd($floor_type);
                    $buildingChoice = BuildingChoice::whereIn('ID', $floor_type)->get();
                    // dd($buildingChoice);
                    foreach ($buildingChoice as $key1 => $choice) {
                        //dd($choice->GroupID);
                        $dimension2['name'][$key][$key1]['GroupID'] = $choice->GroupID;
                        $dimension2['name'][$key][$key1]['Value_FR'] = $choice->Value_FR;
                        $dimension2['name'][$key][$key1]['Value_EN'] = $choice->Value_EN;
                        $dimension2['name'][$key][$key1]['ID'] = $choice->ID;
                    }
                }
            }
        } else {
            return Redirect::to('/');
        }

        $helper = new Helper;
        $getLatLng = $helper->get_lat_long("Indore MP India");
        
        $max_price  = 1500000;
        $min_price  = 0;
        $types = BuildingType::all();
        $cities = Building::with(['city'])->groupBy('CityID')->get();
        $regions = Region::orderBy('Name','ASC')->get();
        $rooms = Building::where('status', 1)->groupBy('Rooms_number')->get();
        $categories = BuildingCategory::orderBy('NameFR','ASC')->get();
		$reviews = Review::where('Approved', 1)->orderBy('Date','DESC')->take(5)->get();

        //dd(Helper::get_lat_long("Indore")) 

        //$getLatLng = '';
       // $getLatLng['postalCode'] = empty($building[0])?'':$building[0]->Postal_code;

        //$map_lat_lng = json_encode($getLatLng);
        
        // Retrive lat lng from building address

        $getLatLng = '';
        $helper = new Helper;
        if(count($building)>0)
        {
            $getLatLng = $helper->get_all_lat_long($building); 
        }

        //echo $id;        
        foreach ($building as $key => $build) {             
             if($build->id==$id)
             {
                $current_build[]=$build;
             }            
         }       

        $building       =   empty($current_build)?array():$current_build;         
        $map_lat_lng    =   json_encode($getLatLng);
        //dd($building);

        $current_path = "propriete?id=" . $id;
        
        return view('home.search-detail', compact('categories','getLatLng','rooms', 'building', 'max_price', 'min_price', 'types', 'cities', 'regions', 'dimension', 'dimension2', 'map_lat_lng', 'reviews', 'images', 'building_rooms', 'rents', 'current_path'));
    }

    /**
     * Get Ville from Statte 
     * */
    public function getVille() {
        
        
        $region_id = Input::get('region');
        $city_region = City::with(['region'])->whereIn('RegionID', $region_id)->orderBy('CityName', 'ASC')->get();  
        $returnHTML = json_encode($city_region);
        echo $returnHTML;
        
        //$region = Input::get('region');
        //if (count($region) == 0) {
        //    exit(0);
        //}
        //$building = Building::with(['user', 'btype', 'package', 'bcategory', 'city'])->get();
        //// dd($building[0]);     
        //$max_price  = Building::where('status', 1)->max('Price');
        //$min_price  = Building::where('status', 1)->min('Price');
        //$types      = Building::with(['btype'])->groupBy('TypeID')->get();
        //$cities     = Building::with(['city'])->groupBy('CityID')->get();

        //$regions = Region::orderBy('Name','ASC')->get();
        //$rooms = Building::where('status', 1)->groupBy('Rooms_number')->get();

        //$region_name = Region::whereIn('id', $region)->get();
        //foreach ($region_name as $key => $rname) {
        //    $arr_region['region'][$rname->id] = $rname->Name;
        //}
        //// dd($arr_region);
        //$city_region = City::with(['region'])->whereIn('RegionID', $region)->orderBy('CityName', 'ASC')->get();
        //// $arr[] = '';
        //$counter = 0;
        //foreach ($city_region as $key => $value) {
        //    $arr_city['city_' . $value->RegionID][$counter][$value->id] = $value->CityName;
        //    $counter++;
        //}
        //// $returnHTML =  view('include.city',compact('min_price','max_price','arr_region','arr_city'))->render();        
        //$returnHTML = json_encode(array_merge($arr_region, $arr_city));
        //echo $returnHTML;
        exit();
    }

    public function getSectors() {
        
        $city_region = SectorCity::join('t_sector_region', 't_sector_region.RegionID', '=', 't_sector_city.RegionID')->orderBy('Region_Name', 'ASC')->orderBy('Name', 'ASC')->get();  
        $returnHTML = json_encode($city_region);
        echo $returnHTML;
        exit();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * Display detail of particular record
     * Method @get
     * Method Name : search
     * @param $region, $towns,$types,$rooms,$price_range
     */
    public function search(Request $request) {
        
        $region_id = Input::get('region');
        $city_region = City::with(['region'])->whereIn('RegionID', $region_id)->get();

        if (count($city_region) > 0) {
            foreach ($city_region as $key => $value) {
                $city_id[] = $value->id;
            }
        } else {
            $city_id[] = '';
        }   
      
        $max_price      = 1500000;
        $min_price      = 0;
        $courtier       = Input::get('courtier');
        $city           = Input::get('towns');
        $type           = Input::get('types');
        $room           = Input::get('rooms');
        $price          = Input::get('price_range');
        $land_area      = Input::get('land_area');
        
        $land_area_size = explode('-', $land_area);
        $unit           = Input::get('unit');
        $price_range    = explode('-', str_replace('$', '', $price));
        
        $price1 = '';
        $price2 = '';
        if (isset($price_range) && count($price_range) > 1) {
            $price1 = trim($price_range[0]);
            $price2 = trim($price_range[1]);
            
            if ($price2!=Lang::get('website-lang.unlimited') and is_numeric($price2) and $price2!='')  
            {  
                $price2 = trim($price_range[1]);
            }            
            else if (!is_numeric($price2))  
            {  
                $price2=Lang::get('website-lang.unlimited');
            }
            else
            {
                $price2 = $max_price; 
            }
        } 
        // Default record from building house   
        
        $types              = Building::with(['btype'])->groupBy('TypeID')->get();
        
        $Selectedcitys      = Input::get('towns');
        $types              = BuildingType::all();
        $cities             = City::with(['region'])->whereIn('RegionID', $region_id)->orderBy('CityName', 'ASC')->get();
        $regions            = Region::orderBy('Name','ASC')->get();
        $region             = Input::get('region');
        $cityID             = Input::get('towns');
        $type_id            = Input::get('types');
        $room_number        = Input::get('rooms');
        $categories         = BuildingCategory::orderBy('NameEN','ASC')->get();
        $land_area          = Input::get('land_area');
        $properties         = Input::get('properties');
        $bathrooms          = Input::get('bathrooms');
        $onlineSince        = Input::get('online_since');
        $etat_du_batiment   = Input::get('etat_du_batiment');
        $street_name        = Input::get('street_name');
        $hidden_street_name        = Input::get('hidden_street_name');
        $characteristics    = Input::get('characteristics');
        $pro_subtype        = Input::get('pro_subtype');
        $chk_prop_free_tour = Input::get('chk_prop_free_tour');
        $chk_prop_star      = Input::get('chk_prop_star');
        $order            = Input::get('order');
        
        $Brand_new          =   0;
        $Free_tour          =   0;
        $Sold               =   0;
        $Star               =   0;
        
        $Field = "id";
        $ASC_or_DESC = "DESC";
        
        if(isset($order))
        {
            switch ($order) {
                case "NewDESC":
                    //<option value="NewDESC">Plus récente en premier</option>		
                    $Field = "Start_Date";
                    $ASC_or_DESC = "DESC";
                    break;
                case "NewASC":
                    //<option value="NewASC">Moins récente en premier</option>	
                    $Field = "Start_Date";
                    $ASC_or_DESC = "ASC";
                    break;
                case "PriceASC":
                    //<option value="PriceASC">Prix par ordre croissant</option>
                    $Field = "Price";
                    $ASC_or_DESC = "ASC";
                    break;
                case "PriceDESC":
                    //<option value="PriceDESC">Prix par ordre décroissant</option>	
                    $Field = "Price";
                    $ASC_or_DESC = "DESC";
                    break;
            } 
        }
        
        if(isset($chk_prop_free_tour))
        {
            $Free_tour = 1;
        } 
        if(isset($chk_prop_star))
        {
            $Star = 1;
        } 
        if(isset($street_name) && !empty($street_name) || $hidden_street_name == "Empty")
        {
            $building = Building::with('buildingImage', 'user', 'city', 'package', 'bcategory', 'btype')
                                ->where(function($query) use($city, $city_id, $street_name) {
                                
                        if (isset($city) && !empty($city)) {
                            $query->whereIn('CityID', $city);
                        }
                        if ((isset($region) && !empty($region)) && empty($city)) {
                            $query->whereIn('CityID', $city_id);
                        }
                        
                        $query->where('StreetName', "like", "%$street_name%");
                    
                    $query->where('status', 2);
                })
                ->orderBy($Field, $ASC_or_DESC)->paginate(Config::get('app.record_limit'));
        }else{
            
            $building = Building::with('buildingImage', 'user', 'city', 'package', 'bcategory', 'btype')
                            ->where(function($query) use($onlineSince,$unit,$land_area_size,$Star,$Sold,$Free_tour,$Brand_new,$land_area,$bathrooms,$characteristics,$pro_subtype,$region, $city, $type, $room, $city_id, $price, $price1, $price2, $etat_du_batiment, $courtier) {

                if (isset($room) && !empty($room)) {
                    $query->where('Rooms_number',  '>=', $room);
                }
                if (isset($type) && !empty($type)) {
                    $query->whereIn('TypeID', $type);
                }
                if (isset($city) && !empty($city)) {
                    $query->whereIn('CityID', $city);
                }
                if ((isset($region) && !empty($region)) && empty($city)) {
                    $query->whereIn('CityID', $city_id);
                }

                if (isset($price) && !empty($price) && $price2!=Lang::get('website-lang.unlimited')) {
                    $query->whereBetween('Price', array($price1, $price2));
                }else if(isset($price2) && !empty($price2) && $price2==Lang::get('website-lang.unlimited') ){
                    $query->where('Price','>=', $price1);
                }
                if (isset($onlineSince) && !empty($onlineSince) && is_numeric($onlineSince)){
                    
                    $date = new \DateTime('now');
                    date_sub($date, date_interval_create_from_date_string($onlineSince . ' days'));
                    
                    $query->where('Start_date', '>=', date_format($date, 'Y-m-d'));
                }
                
                if (isset($etat_du_batiment) && !empty($etat_du_batiment)){
                    $current_year = date("Y");
                    
                    switch ($etat_du_batiment) {
                        case "new":
                            $query->where('Brand_new', 1);
                            break;
                        case "less_5":
                            $query->where('Built_in', '>=', ($current_year - 5));
                            break;
                        case "less_10":
                            $query->where('Built_in', '>=', ($current_year - 10));
                            break;
                        case "more_10":
                            $query->where('Built_in', '<=', ($current_year - 10));
                            break;
                        case "100":
                            $query->where('Built_in', '<=', ($current_year - 100));
                            break;
                    }
                }
                
                if (isset($pro_subtype) && !empty($pro_subtype)){
                    $query->whereIn('CategoryID', $pro_subtype);
                }
                if(count($characteristics)>0)
                {
                    foreach ($characteristics as $key => $value )
                    {
                        $query->where($value,'!=','0');
                    } 
                }
                if (isset($bathrooms) && !empty($bathrooms)){
                    $query->where('Bathroom_number', '>=',$bathrooms);
                }
                if (isset($Star) && !empty($Star)){
                     $query->where('Star',$Star);
                }
                if (isset($Sold) && !empty($Sold)){
                     $query->where('Sold',$Sold);
                }
                if (isset($Free_tour) && !empty($Free_tour)){
                     $query->where('Free_tour',$Free_tour);
                }
                if (isset($land_area_size) && count($land_area_size)>1){
                    $query->whereBetween('Property_size_'.$unit, $land_area_size);
                }
                if (isset($courtier) && !empty($courtier))
                {
                     $query->where('Broker_Photo', $courtier . ".jpg")->orWhere('Broker_Photo2', $courtier . ".jpg");
                }
                
                $query->where('status', 2)->where('Sold', 0);
            })

            ->orderBy($Field, $ASC_or_DESC)->paginate(Config::get('app.record_limit'));
        }
        
        $getLatLng = '';
        $helper = new Helper;

        //To get all latlng after search

        if(isset($street_name) && !empty($street_name) || $hidden_street_name == "Empty")
        {
            $building_lat_lng = Building::with('buildingImage', 'user', 'city', 'package', 'bcategory', 'btype')
                                ->where(function($query) use($city, $city_id, $street_name) {
                                
                        if (isset($city) && !empty($city)) {
                            $query->whereIn('CityID', $city);
                        }
                        if ((isset($region) && !empty($region)) && empty($city)) {
                            $query->whereIn('CityID', $city_id);
                        }
                        
                        $query->where('StreetName', "like", "%$street_name%");
                    
                    $query->where('status', 2);
                })
                ->orderBy($Field, $ASC_or_DESC)->get();
        }else{
            
            $building_lat_lng = Building::with('buildingImage', 'user', 'city', 'package', 'bcategory', 'btype')
                            ->where(function($query) use($onlineSince,$unit,$land_area_size,$Star,$Sold,$Free_tour,$Brand_new,$land_area,$bathrooms,$characteristics,$pro_subtype,$region, $city, $type, $room, $city_id, $price, $price1, $price2, $etat_du_batiment, $courtier) {

                if (isset($room) && !empty($room)) {
                    $query->where('Rooms_number',  '>=', $room);
                }
                if (isset($type) && !empty($type)) {
                    $query->whereIn('TypeID', $type);
                }
                if (isset($city) && !empty($city)) {
                    $query->whereIn('CityID', $city);
                }
                if ((isset($region) && !empty($region)) && empty($city)) {
                    $query->whereIn('CityID', $city_id);
                }

                if (isset($price) && !empty($price) && $price2!=Lang::get('website-lang.unlimited')) {
                    $query->whereBetween('Price', array($price1, $price2));
                }else if(isset($price2) && !empty($price2) && $price2==Lang::get('website-lang.unlimited') ){
                    $query->where('Price','>=', $price1);
                }
                if (isset($onlineSince) && !empty($onlineSince) && is_numeric($onlineSince)){
                    
                    $date = new \DateTime('now');
                    date_sub($date, date_interval_create_from_date_string($onlineSince . ' days'));
                    
                    $query->where('Start_date', '>=', date_format($date, 'Y-m-d'));
                }
                
                if (isset($etat_du_batiment) && !empty($etat_du_batiment)){
                    $current_year = date("Y");
                    
                    switch ($etat_du_batiment) {
                        case "new":
                            $query->where('Brand_new', 1);
                            break;
                        case "less_5":
                            $query->where('Built_in', '>=', ($current_year - 5));
                            break;
                        case "less_10":
                            $query->where('Built_in', '>=', ($current_year - 10));
                            break;
                        case "more_10":
                            $query->where('Built_in', '<=', ($current_year - 10));
                            break;
                        case "100":
                            $query->where('Built_in', '<=', ($current_year - 100));
                            break;
                    }
                }
                
                if (isset($pro_subtype) && !empty($pro_subtype)){
                    $query->whereIn('CategoryID', $pro_subtype);
                }
                if(count($characteristics)>0)
                {
                    foreach ($characteristics as $key => $value )
                    {
                        $query->where($value,'!=','0');
                    } 
                }
                if (isset($bathrooms) && !empty($bathrooms)){
                    $query->where('Bathroom_number', '>=',$bathrooms);
                }
                if (isset($Star) && !empty($Star)){
                     $query->where('Star',$Star);
                }
                if (isset($Sold) && !empty($Sold)){
                     $query->where('Sold',$Sold);
                }
                if (isset($Free_tour) && !empty($Free_tour)){
                     $query->where('Free_tour',$Free_tour);
                }
                if (isset($land_area_size) && count($land_area_size)>1){
                    $query->whereBetween('Property_size_'.$unit, $land_area_size);
                }
                if (isset($courtier) && !empty($courtier))
                {
                     $query->where('Broker_Photo', $courtier . ".jpg")->orWhere('Broker_Photo2', $courtier . ".jpg");
                }
                
                $query->where('status', 2)->where('Sold', 0);
            })

            ->orderBy($Field, $ASC_or_DESC)->get();
        }

        if(count($building_lat_lng)>0)
        {
            $getLatLng = $helper->get_all_lat_long($building_lat_lng); 
        } 
        //dd($getLatLng);
		$reviews = Review::where('Approved', 1)->orderBy('Date','DESC')->take(5)->get();
        
        $user = Auth::user();
        if(isset($user) && !empty($user)){
            $addtofav  = AddToFavorite::where('UserID', $user->UserID)->groupBy('BuildingID')->get();        
            
            foreach ($addtofav as $key => $fav) {
                if(!empty($fav->BuildingID))
                    $fav_build[]=$fav->BuildingID;
            }   
        } 
        if(empty($fav_build))
            $fav_build=array();
        
        $BuildingCount = count($building_lat_lng);
        
        return view('home.search', compact('bathrooms','onlineSince','categories','getLatLng','room_number', 'type_id', 'price1', 'price2', 'city_id', 'region_id', 'city_region', 'land_area', 'unit', 'building', 'max_price', 'min_price', 'types', 'cities', 'regions', 'Star', 'Sold', 'Free_tour', 'Brand_new', 'reviews', 'Selectedcitys', 'pro_subtype', 'characteristics', 'fav_build', 'etat_du_batiment', 'street_name', 'hidden_street_name', 'BuildingCount', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    /*
     * EMI Calculater
     * @param  $principle,$int,$yr
     */

    public function emi(Request $request) {

        if ($request->ajax()) {

            $lamount = Input::get('loan_amount'); // Loan Amount
            $mi = Input::get('interest'); // Monthly interest %ge
            $n = Input::get('no_of_year'); // No of Years

            if ($lamount == 0 || $mi == 0 || $n == 0) {
                echo "Invalid Amount";
                exit();
            } 
            $ny = $n * 12; // No of months
            $mic = ($mi / 100) / 12; // Monthly interest
            $top = pow((1 + $mic), $ny);
            $bottom = $top - 1;
            $sp = $top / $bottom;
            $emi = (($lamount * $mic) * $sp);

            echo number_format($emi, 2, '.', '');
            exit();
        } else {
            echo 'access denied';
        }
    }
   /*
    *User Login method
    * @param
    * Methos : get
    */
    public function userLogin(Request $request, User $user)
    {
       if ($request->ajax()) {
            $data =  Input::all();
            $validator =  Validator::make($data, [
               'email'      => 'required|email',
               'password'   => 'required',
            ]);
            if($validator->fails())
            {
                 $errors = $validator->messages();  
                echo json_encode($errors->all());
                exit();
            }
            else{
                $credentials = array('email' => Input::get('email'), 'password' => Input::get('password')); 
                // here you need to get the remember me checkbox value if set then tru otherwise false
                if (Auth::attempt($credentials, true)) {
                    //echo Auth::user()->UserID
                    echo json_encode(array('response'=>200)); 
                    
                    setcookie("UserMail",Input::get('email'), time()+2592000,"/");
                    setcookie("UserPassword", Helper::getPassword(), time()+2592000,"/");
                }else  {
                    $user = User::where('email', '=', Input::get('email'))->first();
                    
                    if(isset($user)) {
                        if($user->Password == md5(Input::get('password'))) { // If their password is still MD5
                            $user->Password = Hash::make(Input::get('password')); // Convert to new format
                            $user->save();
                            echo json_encode(array('response'=>400)); 
                            exit();
                        }
                    }
                    
                    echo json_encode(array('response'=>300)); 
                }
            }
        }
    }
    /*
    *Register method
    * @param
    * Methos : post
    */
    public function register(Request $request, User $user)
    {
        if ($request->ajax()) {
            $SectorID = 2;
            if(isset($_COOKIE['SectorID']))
            {
                if($_COOKIE['SectorID'] != "" && $_COOKIE['SectorID'] != "0"){
                    $SectorID = $_COOKIE['SectorID'];
                }
            } 
            $data =  Input::all();
            $validator =  Validator::make($data, [
               'FirstName'  => 'required|max:255',
               'LastName'   => 'required|max:255',
               'email'      => 'required|email|max:255|unique:t_user',               
               'password'   => 'required|min:6|same:confirm_password',
               'confirm_password'  => 'required|min:6',
               'conditions' => 'required' 
            ]);
            if($validator->fails())
            {
                $errors = $validator->messages();  
                echo json_encode($errors->all());
                exit();
            } 
            else
            {
                $user = new User;
                $user->FirstName    = Input::get('FirstName');
                $user->LastName     = Input::get('LastName');
                $user->email        = Input::get('email');
                $user->Phone        = Input::get('Phone');
                $user->GroupID      = 3;
                $user->password     = bcrypt(Input::get('password')); 
                $user->CityID       = $SectorID;
                
                $result = $user->save();
                if($result)
                {
                    $helper = new Helper; 
                    $email_content = array('receipent_email'=> Input::get('email'),'subject'=>'Immo-clic.ca : confirmation d’inscription');
                    $helper->sendMailFrontEnd($email_content,'welcome', '');

                    $credentials = array('email' => Input::get('email'), 'password' => Input::get('password'),'GroupID'=>'3'); 
                    if (Auth::attempt($credentials, true)) {
                       echo json_encode(array('response'=>200));
                    }else{
                        echo json_encode(array('response'=>200));
                    } 
                }
                else{
                   echo json_encode(array('response'=>300));
                }
            }
        }     
    }

    /*
    * Add to favorite
    */
    public function addTofav(AddToFavorite $addtofav, Request $request)
    {
       if ($request->ajax()) {
           $uid = isset(Auth::user()->UserID)?Auth::user()->UserID:null;
            if($uid==null)
            {
                return $uid; 
            } 
            $addtofav->UserID = Auth::user()->UserID;
            $addtofav->BuildingID = Input::get('bid');

            $check_add_fav  = AddToFavorite::where('BuildingID',$addtofav->BuildingID)->where('UserID',$addtofav->UserID)->get();
            if(count($check_add_fav)>0)
            {
                AddToFavorite::where('BuildingID',$addtofav->BuildingID)->where('UserID',$addtofav->UserID)->delete();
                die(0);
            }
            $addtofav->Date = date('Y-m-D h:i:s');
            $rs = $addtofav->save(); 
            if($rs)
            {
                echo true;
                exit();
            }
       } 
    }
    /**
     * Forgot password
     */
    
    public function forgotPassword(Request $request, User $user)
    {
        $helper = new Helper; 
        $token = Hash::make($request->input('email'));
      //  $decrypted = Crypt::decrypt($token);
        $email  =   Input::get('email'); 
        $is_email_exit = User::where('email',$email)->get()->count();
        
        if($is_email_exit>0)
        {
            $subject    =   'Lien pour réinitialiser votre mot de passe';
            $email_content = array('receipent_email'=> $email,'subject'=>$subject);
            $url = url('reset-password?token='.$token.'&email='.$email);
            $rs = $helper->sendMailFrontEnd($email_content,'forget-password', $url); 
            if($rs)
            {
                echo true;
            }else{
                echo false;
            }
        }
        else{
            echo "Le courriel n'existe pas!";
        } 
    }
    /**
     * resetPassword
     */
    public function resetPassword(Request $request, User $user)
    {
       
        $hashedPassword    = $request->input('token');
        $email             = $request->input('email');
        
         if ($request->ajax()) {
            $data =  Input::all();
            $validator =  Validator::make($data, [
               'password'   => 'required|min:6|same:confirm_password',
               'confirm_password'  => 'required|min:6'
            ]);
            if($validator->fails())
            {
                $errors = $validator->messages();  
                echo json_encode($errors->all());
                exit();
            }else
            {  // dd($data );
                $email = Input::get('email');
                $token = Input::get('token');
                $password = bcrypt(Input::get('password'));
                if (Hash::check($email , $token)) {
                    
                    $rs =User::where('email',$email)->update(['password'=>$password]);
                    if($rs)
                    {
                        return json_encode(['response'=>'200']); // success
                    }else{
                        return json_encode(['response'=>'300']); // fail
                    }
                }
            }
         }else{
             if (Hash::check($email , $hashedPassword)) {
                $building   = Building::with(['buildingImage', 'user', 'btype', 'package', 'bcategory', 'city'])->get();
                $max_price  = 1500000;
                $min_price  = 0;
                $types      = BuildingType::all();
                $categories = BuildingCategory::orderBy('NameFR','ASC')->get();
                $cities     = Building::with(['city'])->groupBy('CityID')->get();
                $regions    = Region::orderBy('Name','ASC')->get();
                $rooms      = Building::where('status', 2)->groupBy('Rooms_number')->get();
                $region_id  = [];  
                $star_building = Building::where('status', 2)->where('Star', 1)->orderBy('Start_Date','DESC')->take(3)->get();
                $reviews = Review::where('Approved', 1)->orderBy('Date','DESC')->take(5)->get();
                 
                return view('home.reset-password', compact('hashedPassword','email','online_since','region_id', 'rooms', 'building', 'max_price', 'min_price', 'types', 'categories', 'cities', 'regions', 'rooms', 'region_id', 'star_building', 'reviews', 'helper'));

           }  else {
               echo "Invalid Token";
           } 
         }
    }
    /**
     * Check Login Status
     */
    public function checkLoginStatus(Request $request, User $user)
    {
        if ($request->ajax()) {
           $uid = isset(Auth::user()->UserID)?Auth::user()->UserID:0;
            if($uid==null)
            {
                return $uid; 
            } 
            else
            {
                return 1;  
            }
       }
    }
   /*
   * IPN response manage
   */ 
   public function paypal_ipn() { 
       
        header('HTTP/1.1 200 OK'); 
        $paypalResponse = Input::all(); 
        Storage::append( 'paypalEvent.log' , json_encode($paypalResponse) );
        Storage::disk( 'local' )->put( 'txn_id_'.Input::get('txn_id').'.log' , json_encode($paypalResponse));
        //$paypalResponse =  '{"mc_gross":"194.95","protection_eligibility":"Ineligible","address_status":"confirmed","payer_id":"GGFTE82XN4D5U","tax":"0.00","address_street":"1 Main St","payment_date":"04:40:21 Feb 19, 2016 PST","payment_status":"Pending","charset":"windows-1252","address_zip":"95131","first_name":"test","mc_fee":"5.95","address_country_code":"US","address_name":"test buyer","notify_version":"3.8","custom":"","payer_status":"verified","address_country":"United States","address_city":"San Jose","quantity":"1","verify_sign":"AwMRUaewWLMpARtEP3hNyRl6jiUvANmcHL1aW4lUOSGWSmhS977.k7D2","payer_email":"kundan.r-buyer@cisinlabs.com","txn_id":"9KY41331HM558383N","payment_type":"instant","last_name":"buyer","address_state":"CA","receiver_email":"kundan.r-facilitator-3@cisinlabs.com","payment_fee":"5.95","receiver_id":"TWVA2CRRJCKP8","pending_reason":"paymentreview","txn_type":"express_checkout","item_name":"Package_4","mc_currency":"USD","item_number":"","residence_country":"US","test_ipn":"1","handling_amount":"0.00","transaction_subject":"","payment_gross":"194.95","shipping":"0.00","ipn_track_id":"1e810a1d8d48d"}';
        //$response = json_decode($paypalResponse,true);
        $response = $paypalResponse;  
        // to test set response value = json_decode($paypalResponse,true); and uncomment $paypalResponse
        
        $ipn_txn_id =  $response['txn_id']; 
        $item_name  =  $response['item_name']; 
        $payment = Payment::where('Txn_id',$ipn_txn_id)->get();
        $txn_id = $payment[0]->Txn_id;
        $sub_total      = $payment[0]->Price;  
        $option         = $payment[0]->option1; 
        $tpsAmount      = round((($sub_total *5)/100),2);
        $tvqAmount      = round((($sub_total*9.975)/100),2);
        $total_amt      = round(($sub_total+ $tpsAmount + $tvqAmount),2); 

        if($option==1)
        {
            $sub_total      = $payment[0]->Price+100;   
            $tpsAmount      = round((($sub_total *5)/100),2);
            $tvqAmount      = round((($sub_total*9.975)/100),2);
            $total_amt      = round(($sub_total+ $tpsAmount + $tvqAmount),2); 
        } 
        
        $response['sub_total'] = $sub_total;
        $response['tpsAmount'] = $tpsAmount;
        $response['tvqAmount'] = $tvqAmount;
        $response['total_amt'] = $total_amt;   

        if($ipn_txn_id===$txn_id)
        {
            $building = new Building;
            $building->UserID =  $payment[0]->UserID;
            $building->status = 1;
            $building->Start_Date = $payment[0]->Create_at;
            $building->End_Date =  $payment[0]->Expire_at;
            $building->PackageID = $payment[0]->Forfait_id;
            if($item_name=='Package_0' || $item_name=='Package_6')
            {
               $building->star =  1;
            }
            $building->save();
            //update building id in t_payment table
            $updatePayment = Payment::find($payment[0]->id); 
            $updatePayment->BuildingID = $building->id;
            //$updatePayment->Paid = 1;
            $updatePayment->save(); 
            // User Detail

            $userData = User::find($payment[0]->UserID);
            $userEmail = $userData->email;
            $userFullName  = $userData->FirstName.' '.$userData->LastName;
            $response['userFullName'] = $userFullName;
            $response['email'] = $userEmail;
            // Determine package Name
            $pkg_month = ltrim($item_name,'Package_'); // to get how many month 
            $packageName = ($pkg_month==4)?"L'économique":($pkg_month==6)?"L'avantageux":"unlimited";
            $response['PackageName'] = $packageName;
            $response['package_duration']   =  $pkg_month;

            // Email sent after IPN call 
            
            /*------Email to admin---*/
            $helper = new Helper; 
            $email_content = array('receipent_email'=> 'info@immo-clic.ca','subject'=>'Payment Status');
            $template_content =  $response;
            $template = 'emails.payment_notification';    
            $sendEmail = $helper->sendIPNMail($email_content, $template, $template_content);

             Storage::append( 'mail.log' , $sendEmail );

            /*------Email to User---*/  
            $helper = new Helper; 
            $email_content = array('receipent_email'=> $userData->email,'subject'=>'Payment Status');
            $template_content =  $response;
             
            $template = 'emails.payment_notification';     
            $sendEmail = $helper->sendIPNMail($email_content, $template, $template_content); 
             Storage::append( 'mail.log' , $sendEmail );
            // Send invoice to user 
            $helper = new Helper; 
            $email_content = array('receipent_email'=> $userData->email,'subject'=>'Facture immo-clic.ca');
            $template_content =  $response;
             
            $template = "emails.invoice";     
            $sendEmail = $helper->sendIPNMail($email_content, $template, $template_content); 
            Storage::append( 'mail.log' , $sendEmail );
        } 
    }
 
    // This is used for only for testing purpose . you can remove this.
    public function paypal_ipn_email() {
        $jdata = '{"PackageName":"pkg 4","email":"email","package_duration":"4 Month","userFullName":"Kundan Roy","mc_gross":"194.95","protection_eligibility":"Ineligible","address_status":"confirmed","payer_id":"GGFTE82XN4D5U","tax":"0.00","address_street":"1 Main St","payment_date":"04:40:21 Feb 19, 2016 PST","payment_status":"Pending","charset":"windows-1252","address_zip":"95131","first_name":"test","mc_fee":"5.95","address_country_code":"US","address_name":"test buyer","notify_version":"3.8","custom":"","payer_status":"verified","address_country":"United States","address_city":"San Jose","quantity":"1","verify_sign":"AwMRUaewWLMpARtEP3hNyRl6jiUvANmcHL1aW4lUOSGWSmhS977.k7D2","payer_email":"kundan.r-buyer@cisinlabs.com","txn_id":"9KY41331HM558383N","payment_type":"instant","last_name":"buyer","address_state":"CA","receiver_email":"kundan.r-facilitator-3@cisinlabs.com","payment_fee":"5.95","receiver_id":"TWVA2CRRJCKP8","pending_reason":"paymentreview","txn_type":"express_checkout","item_name":"Package_4","mc_currency":"USD","item_number":"","residence_country":"US","test_ipn":"1","handling_amount":"0.00","transaction_subject":"","payment_gross":"194.95","shipping":"0.00","ipn_track_id":"1e810a1d8d48d"}';
        $paypalResponse = json_decode($jdata,true);
        
        return view('emails.payment_notification',compact('paypalResponse'));
    } 
    

    /*
    * Send SMS or make call and send sms using Twilio package
    * method @ immoclic_call_sms
    * Author : Kundan roy
    **/
    public function immoclic_call_sms()
    {    
        // Credrtial to make call or sms 
        $accountId  =   ''; // Your account ID
        $token      =   ''; // put here you token 
        $fromNumber = ''; // from phone number  
       
        $response = Input::all(); 
        if($response['method']=='call')
        {
            $voice_message =  'hiii';  // Send your voice message
            $phone_number = '8103194076'; // this phone is for make call 
            $helper = new Helper; 
            $send_sms = $helper->immoclic_create_call($phone_number,$voice_message); 
            if($send_sms)
            {
                echo "Call connected";
            }else{
                echo " Somthing went wrong";
            }
        }elseif ($response['method']=='sms') {
            $phone_number = '8103194076'; // this  phone is for which you want to send sms
            $message =  'hiii';  // this is your msg
            $helper = new Helper; 
            $send_sms = $helper->immoclic_create_sms($phone_number,$message); 
            if($send_sms)
            {
                echo "Message sent successfully";
            }else{
                echo " Somthing went wrong";
            }
        }  
    }  
}
