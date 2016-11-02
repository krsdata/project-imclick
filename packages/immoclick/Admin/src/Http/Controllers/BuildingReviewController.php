<?php

namespace Immoclick\Admin\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Immoclick\Admin\Http\Requests\BuildingReviewRequest;
use Immoclick\Admin\Models\BuildingReview;
use Immoclick\Admin\Models\User;
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
class BuildingReviewController extends Controller {
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

    public function index(BuildingReview $buildingReview, Request $request) {

        $buildingReview = BuildingReview::with(['user'])->get();
        $page_title = 'Building Review';
        $page_action = 'View Building Review';

        if ($request->ajax()) {
            $id = Input::get('id');
            $status = Input::get('status');
            $data = BuildingReview::find($id);
            $data->Approved = $status;
            $data->save();
            echo $status;
            exit();
        } else {

            $search = Input::get('search');
            if (isset($search) && !empty($search)) { 

                $users = User::where(function($query) use($search) {
                            if (!empty($search)) {
                                $query->Where('FirstName', 'LIKE', "%$search%")
                                        ->OrWhere('email', 'LIKE', "%$search%");
                            }
                        })->get(['id']);
                $userID = [];
                foreach ($users as $key => $user) {
                    $userID[] = $user->id;
                }
                // dd($userID);

                $buildingReview = BuildingReview::with(['user'])
                                ->whereIn('UserID', $userID)->paginate(15);
            }

            //dd($buildingReview);
            return view('packages::buildingReview.index', compact('buildingReview', 'page_title', 'page_action'));
        }
    }

    /*
     * create Group method
     * */

    public function create(BuildingReview $buildingReview) {

        $page_title = 'Create Building Review';
        return view('packages::buildingReview.create', compact('BuildingReview', 'page_title'));
    }

    /*
     * Save Group method
     * */

    public function store(BuildingReviewRequest $request, BuildingReview $buildingReview) {
        $group->fill(Input::all());
        $group->save();
        return Redirect::to(route('buildingReview.create'))
                        ->with('flash_alert_notice', 'New Building review was successfully created !')->with('alert_class', 'alert-success alert-dismissable');
    }

    /*
     * Edit Group method
     * */

    public function edit(BuildingReview $buildingReview) {

        $page_title = 'Building Review';
        $page_action = 'Building Review Edit';

        return view('packages::buildingReview.edit', compact('buildingReview', 'page_title', 'page_action'));
    }

    public function update(BuildingReviewRequest $request, BuildingReview $buildingReview) {
        $buildingReview->fill(Input::all());
        //dd($buildingReview); 
        $buildingReview->save();
        return Redirect::to(route('buildingReview'))
                        ->with('flash_alert_notice', 'Building review was successfully updated !');
    }

    public function destroy(BuildingReview $buildingReview) {

        BuildingReview::destroy($buildingReview->id);

        return Redirect::to(route('buildingReview'))
                        ->with('flash_alert_notice', 'Building review was successfully deleted!')->with('flash_alert', 'alert-danger');
    }

}
