<?php

namespace Immoclick\Admin\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Immoclick\Admin\Http\Requests\BuildingRequest;
use Immoclick\Admin\Http\Requests\BuildingRoomRequest;
use Immoclick\Admin\Models\User;
use Immoclick\Admin\Models\Group;
use Immoclick\Admin\Models\Building;
use Immoclick\Admin\Models\BuildingRoom;
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
class BuildingRoomController extends Controller {
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

    public function index(BuildingRoom $buildingRoom, Request $request) {

        $page_title = 'Building Room';
        $page_action = 'View Building Room';

        $b_id = Input::get('q');
        $bid = isset($b_id) ? Input::get('q') : 0;
        $building = Building::where('id', intval($b_id))->get();
        //dd($buildingRoom);
        if (count($building) > 0) {
            $buildingID = $_REQUEST['q'];
            $buildingRoom = BuildingRoom::where('BuildingID', $buildingID)->get();
        } else {
            return Redirect::to(route('building'));
        }

        return view('packages::buildingRoom.index', compact('buildingRoom', 'page_title', 'page_action'));
    }

    /*
     * create Group method
     * */

    public function create(BuildingRoom $buildingRoom) {

        $b_id = Input::get('q');
        $bid = isset($b_id) ? Input::get('q') : 0;

        $building = Building::where('id', intval($b_id))->get();

        $buildingChoice = BuildingChoice::all();

        if (count($building)) {
            $page_title = 'Building Room';
            $page_action = 'Create Building Room';

            return view('packages::buildingRoom.create', compact('buildingChoice', 'bid', 'buildingRoom', 'page_title', 'page_action'));
        } else {
            return Redirect::to(route('building'));
        }
    }

    /*
     * Save Group method
     * */

    public function store(BuildingRoomRequest $request, BuildingRoom $buildingRoom) {

        $buildingRoom->fill(Input::all());

        $floorType = Input::get('Floor_type');
        $c = count($floorType);
        //dd($c);
        if ($c == 0) {
            return Redirect::to(route('buildingRoom.create', 'q=' . $buildingRoom->BuildingID))
                            ->withInput()->with('flash_alert_notice', 'Floor type is required');
        }

        $ftype = '';
        foreach ($floorType as $key => $value) {
            $ftype = $ftype . ',' . $value;
        }


        $buildingRoom->Floor_type = ltrim($ftype, ',');
        $buildingRoom->save();
        return Redirect::to(route('building'))
                        ->with('flash_alert_notice', 'Building room was successfully created !');
    }

    /*
     * Edit Group method
     * */

    public function edit(BuildingRoom $buildingRoom) {

        $page_title = 'Building Room';
        $page_action = 'View Building Room';
        $buildingChoice = BuildingChoice::all();

        $ftype = explode(',', $buildingRoom->Floor_type);


        return view('packages::buildingRoom.edit', compact('ftype', 'buildingChoice', 'buildingRoom', 'page_title', 'page_action'));
    }

    public function update(BuildingRoomRequest $request, BuildingRoom $buildingRoom) {

        $buildingRoom->fill(Input::all());
        $floorType = Input::get('Floor_type');
        $c = count($floorType);
        //dd($c);
        if ($c == 0) {
            return Redirect::to(route('buildingRoom.create', 'q=' . $buildingRoom->BuildingID))
                            ->withInput()->with('flash_alert_notice', 'Floor type is required');
        }

        $ftype = '';
        foreach ($floorType as $key => $value) {
            $ftype = $ftype . ',' . $value;
        }
        $buildingRoom->Floor_type = ltrim($ftype, ',');
        $buildingRoom->save();
        // dd($buildingRoom);
        return Redirect::to(route('buildingRoom', 'q=' . $buildingRoom->BuildingID))
                        ->with('flash_alert_notice', 'Building room was successfully updated !');
    }

    public function destroy(BuildingRoom $buildingRoom) {
        BuildingRoom::destroy($buildingRoom->id);

        return Redirect::to(route('buildingRoom', 'q=' . $buildingRoom->BuildingID))
                        ->with('flash_alert_notice', 'Building room was successfully deleted!');
    }

}
