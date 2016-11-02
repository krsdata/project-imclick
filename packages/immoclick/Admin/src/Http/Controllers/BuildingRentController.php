<?php

namespace Immoclick\Admin\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Immoclick\Admin\Http\Requests\BuildingRequest;
use Immoclick\Admin\Http\Requests\BuildingRentRequest;
use Immoclick\Admin\Models\User;
use Immoclick\Admin\Models\Group;
use Immoclick\Admin\Models\Building;
use Immoclick\Admin\Models\BuildingRent;
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
class BuildingRentController extends Controller {
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

    public function index(BuildingRent $buildingRent, Request $request) {

        $page_title = 'Building Rent';

        $page_action = 'View Building Rent';


        $b_id = Input::get('q');
        $bid = isset($b_id) ? Input::get('q') : 0;

        $building = Building::where('id', intval($b_id))->get();

        if (count($building) > 0) {

            $buildingID = $_REQUEST['q'];
            $buildingRent = BuildingRent::where('BuildingID', $buildingID)->get();
        } else {
            return Redirect::to(route('building'));
        }

        return view('packages::buildingRent.index', compact('buildingRent', 'page_title', 'page_action'));
    }

    /*
     * create Group method
     * */

    public function create(BuildingRent $buildingRent) {

        $b_id = Input::get('q');
        $bid = isset($b_id) ? Input::get('q') : 0;

        $building = Building::where('id', intval($b_id))->get();

        if (count($building)) {
            $page_title = 'Building Rent';
            $page_action = 'Create Building Rent';

            return view('packages::buildingRent.create', compact('bid', 'buildingRent', 'page_title', 'page_action'));
        } else {
            return Redirect::to(route('building'));
        }
    }

    /*
     * Save Group method
     * */

    public function store(BuildingRentRequest $request, BuildingRent $buildingRent) {

        $buildingRent->fill(Input::all());
        $buildingRent->save();
        return Redirect::to(route('building'))
                        ->with('flash_alert_notice', 'Building Rent was successfully created !');
    }

    /*
     * Edit Group method
     * */

    public function edit(BuildingRent $buildingRent) {

        $page_title = 'Building Rent';
        $page_action = 'View Building Rent';
        return view('packages::buildingRent.edit', compact('buildingRent', 'page_title', 'page_action'));
    }

    public function update(BuildingRentRequest $request, BuildingRent $buildingRent) {

        $buildingRent->fill(Input::all());
        $buildingRent->save();
        return Redirect::to(route('buildingRent', 'q=' . $buildingRent->buildingID))
                        ->with('flash_alert_notice', 'Building Rent was successfully updated !');
    }

    public function destroy(BuildingRent $buildingRent) {

        BuildingRent::destroy($buildingRent->id);

        return Redirect::to(route('buildingRent', 'q=' . $buildingRent->buildingID))
                        ->with('alert_class', 'Building Rent was successfully deleted!');
    }

}
