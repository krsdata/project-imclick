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
use Immoclick\Admin\Models\BuildingInclusion;
use Immoclick\Admin\Http\Requests\BuildingInclusionRequest;
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
class BuildingInclusionController extends Controller {
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

    public function index(BuildingInclusion $buildingInclusion, Request $request) {

        $page_title = 'Building Inclusion';

        $page_action = 'View Building Inclusion';


        $b_id = Input::get('q');
        $bid = isset($b_id) ? Input::get('q') : 0;

        $building = Building::where('id', intval($b_id))->get();

        if (count($building) > 0) {

            $buildingID = $_REQUEST['q'];
            $buildingInclusion = BuildingInclusion::where('BuildingID', $buildingID)->get();
        } else {
            return Redirect::to(route('building'));
        }

        return view('packages::buildingInclusion.index', compact('buildingInclusion', 'page_title', 'page_action'));
    }

    /*
     * create Group method
     * */

    public function create(BuildingInclusion $buildingInclusion) {

        $b_id = Input::get('q');
        $bid = isset($b_id) ? Input::get('q') : 0;

        $building = Building::where('id', intval($b_id))->get();

        if (count($building)) {
            $page_title = 'Building Inclusion';
            $page_action = 'Create Building Inclusion';

            return view('packages::buildingInclusion.create', compact('bid', 'buildingInclusion', 'page_title', 'page_action'));
        } else {
            return Redirect::to(route('building'));
        }
    }

    /*
     * Save Group method
     * */

    public function store(BuildingInclusionRequest $request, BuildingInclusion $buildingInclusion) {

        $buildingInclusion->fill(Input::all());
        $buildingInclusion->save();
        return Redirect::to(route('buildingInclusion', 'q=' . $buildingInclusion->BuildingID))
                        ->with('flash_alert_notice', 'Building Inclusion was successfully created !');
    }

    /*
     * Edit Group method
     * */

    public function edit(BuildingInclusion $buildingInclusion) {

        $page_title = 'Building Inclusion';
        $page_action = 'View Building Inclusion';
        return view('packages::buildingInclusion.edit', compact('buildingInclusion', 'page_title', 'page_action'));
    }

    public function update(BuildingInclusionRequest $request, BuildingInclusion $buildingInclusion) {

        $buildingInclusion->fill(Input::all());
        $buildingInclusion->save();
        return Redirect::to(route('buildingInclusion', 'q=' . $buildingInclusion->BuildingID))
                        ->with('flash_alert_notice', 'Building Inclusion was successfully updated !');
    }

    public function destroy(BuildingInclusion $buildingInclusion) {

        BuildingInclusion::destroy($buildingInclusion->id);

        return Redirect::to(route('buildingInclusion', 'q=' . $buildingInclusion->BuildingID))
                        ->with('flash_alert_notice', 'Building Inclusion was successfully deleted!');
    }

}
