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
use Immoclick\Admin\Models\BuildingExclusion;
use Immoclick\Admin\Http\Requests\BuildingExclusionRequest;
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
class BuildingExclusionController extends Controller {
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

    public function index(BuildingExclusion $buildingExclusion, Request $request) {

        $page_title = 'Building Exclusion'; 
        $page_action = 'View Building Exclusion'; 

        $b_id = Input::get('q');
        $bid = isset($b_id) ? Input::get('q') : 0;

        $building = Building::where('id', intval($b_id))->get();

        if (count($building) > 0) {
             
            $buildingID = Input::get('q');
            $buildingExclusion = BuildingExclusion::where('BuildingID', $buildingID)->get();
        } else {
            return Redirect::to(route('building'));
        }

        return view('packages::buildingExclusion.index', compact('buildingExclusion', 'page_title', 'page_action'));
    }

    /*
     * create Group method
     * */

    public function create(BuildingExclusion $buildingExclusion) {

        $b_id = Input::get('q');
        $bid = isset($b_id) ? Input::get('q') : 0;

        $building = Building::where('id', intval($b_id))->get();

        if (count($building)) {
            $page_title = 'Building Exclusion';
            $page_action = 'Create Building Exclusion';

            return view('packages::buildingExclusion.create', compact('bid', 'buildingExclusion', 'page_title', 'page_action'));
        } else {
            return Redirect::to(route('building'));
        }
    }

    /*
     * Save Group method
     * */

    public function store(BuildingExclusionRequest $request, BuildingExclusion $buildingExclusion) {

        $buildingExclusion->fill(Input::all());
        $buildingExclusion->save();
        return Redirect::to(route('buildingExclusion', 'q=' . $buildingExclusion->BuildingID))
                        ->with('flash_alert_notice', 'Building Exclusion was successfully created !');
    }

    /*
     * Edit Group method
     * */

    public function edit(BuildingExclusion $buildingExclusion) {

        $page_title = 'Building Exclusion';
        $page_action = 'View Building Exclusion';
        return view('packages::buildingExclusion.edit', compact('buildingExclusion', 'page_title', 'page_action'));
    }

    public function update(BuildingExclusionRequest $request, BuildingExclusion $buildingExclusion) {

        $buildingExclusion->fill(Input::all());
        $buildingExclusion->save();
        return Redirect::to(route('buildingExclusion', 'q=' . $buildingExclusion->BuildingID))
                        ->with('flash_alert_notice', 'Building Exclusion was successfully updated !');
    }

    public function destroy(BuildingExclusion $buildingExclusion) {

        BuildingExclusion::destroy($buildingExclusion->id);

        return Redirect::to(route('buildingExclusion', 'q=' . $buildingExclusion->BuildingID))
                        ->with('flash_alert_notice', 'Building Exclusion was successfully deleted!')->with('flash_alert', 'alert-danger');
    }

}
