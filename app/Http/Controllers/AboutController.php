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
use Immoclick\Admin\Models\Review;
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
 * Class AboutController
 */
class AboutController extends Controller {
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
        View::share('viewPage', 'about');
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

        $page_title     = 'About'; 
        $page_action    = 'View About';
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
		$reviews = Review::where('Approved', 1)->orderBy('Date','DESC')->take(5)->get();
        
        return view('about.index', compact('categories','online_since','region_id', 'rooms', 'building', 'max_price', 'min_price', 'types', 'cities', 'regions', 'reviews'));
    }
}
