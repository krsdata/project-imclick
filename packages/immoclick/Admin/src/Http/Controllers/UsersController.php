<?php

namespace Immoclick\Admin\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Immoclick\Admin\Http\Requests\UserRequest;
use Immoclick\Admin\Models\User;
use Immoclick\Admin\Models\Group;
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
class UsersController extends Controller {
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
        View::share('viewPage', 'user');
    }

    protected $users;

    /*
     * Dashboard
     * */

    public function index(User $user, Request $request) {
        
        $page_title = 'User';
        $page_action = 'View User';
        if ($request->ajax()) {
            $id = Input::get('id');
            $status = Input::get('status');
            $data = User::find($id);
            $s = ($status == 1) ? $status = 2 : $status = 1;
            $data->enable = $s;
            $data->save();
            echo $status;
            exit();
        }
        $grps = Group::where('Title', '!=', 'Admin')->get();
        // Search by name ,email and group
        $search = Input::get('search');
        $groupID = Input::get('GroupID');
        if ((isset($search) && !empty($search)) || (isset($groupID) && !empty($groupID))) {

            $search = isset($search) ? Input::get('search') : '';
            $groupID = isset($search) ? Input::get('GroupID') : '';
                
            $users = User::where(function($query) use($search, $groupID) {
                        if (!empty($search)) {
                            $query->Where('FirstName', 'LIKE', "%$search%")
                                    ->OrWhere('email', 'LIKE', "%$search%");
                        }

                        if (!empty($groupID)) {
                            $query->Where('GroupID', '=', $groupID);
                        }
                    })->Paginate(15);
        } else {

            $users = User::where('GroupID', '!=', '1')->with('group')->Paginate(15);
        }
        //dd($users[0]->group);
        return view('packages::users.user.index', compact('grps', 'users', 'page_title', 'page_action'));
    }

    /*
     * create Group method
     * */

    public function create(User $user) {

        $grps = Group::where('Title', '!=', 'Admin')->get();

        $page_title = 'User';
        $page_action = 'Create User';

        return view('packages::users.user.create', compact('grps', 'user', 'page_title', 'page_action', 'groups'));
    }

    /*
     * Save Group method
     * */

    public function store(UserRequest $request, User $user) {
        $user->fill(Input::all());
        $form_input = Input::all();
        if (Input::hasFile('Picture')) {
            $file = Input::file('Picture');
        } else {
            $file = '';
        }
        if ($file != '') {
            $image_name = $file->getClientOriginalName();
            $img_path = public_path('uploads/users/');
            $extension = Input::file('Picture')->getClientOriginalExtension(); // getting image extension
            $fileName = time() . '.' . $extension;
            $uploaded_at = $file->move($img_path, $fileName);
        } else {
            $fileName = '';
        }
        // echo $fileName; die;
        $user->password = bcrypt(Input::get('password'));
        $user->Picture = $fileName;
        $user->save();

        return Redirect::to(route('user'))
                        ->with('flash_alert_notice', 'New user was successfully created !');
    }

    /*
     * Edit Group method
     * @param 
     * object : $user
     * */

    public function edit(User $user) {

        $page_title = 'User';
        $page_action = 'Show Users';
        $grps = Group::where('Title', '!=', 'Admin')->get();
        return view('packages::users.user.edit', compact('grps', 'user', 'page_title', 'page_action'));
    }

    public function update(Request $request, User $user) {
        
        $user->fill(Input::all());
        $form_input = Input::all();
        $checkEmailExist = User::where('email', Input::get('email'))
                        ->where('UserID', '!=', $user->UserID)->get();
        $email_count = $checkEmailExist->count();
        if ($email_count > 0) {
            return Redirect::to(route('user.edit', $user->UserID))
                            ->with('flash_alert_notice', 'Email already exist')->withInput();
        }

        if (Input::hasFile('Picture')) {
            $file = Input::file('Picture');
        } else {
            $file = '';
        }
        if ($file != '') {
            $image_name = $file->getClientOriginalName();
            $img_path = public_path('uploads/users/');
            $extension = Input::file('Picture')->getClientOriginalExtension(); // getting image extension
            $fileName = time() . '.' . $extension;
            $uploaded_at = $file->move($img_path, $fileName);
        } else {
            $fileName = Input::get('Picture');
        }
        // echo $fileName; die;
        $user->password = bcrypt(Input::get('password'));
        $user->Picture = $fileName;
        $user->save();

        return Redirect::to(route('user'))
                        ->with('flash_alert_notice', 'User was  successfully updated !');
    }
    /*
     *Delete User
     * @param ID
     * 
     */
    public function destroy(User $user) {
        User::destroy($user->UserID);
        //  dd('test');

        return Redirect::to(route('user'))
                        ->with('flash_alert_notice', 'User was successfully deleted!');
    }

    public function show(User $user) {
        
    }

}
