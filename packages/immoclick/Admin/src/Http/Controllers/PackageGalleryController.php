<?php

namespace Immoclick\Admin\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Immoclick\Admin\Http\Requests\UserRequest;
use Immoclick\Admin\Http\Requests\PackageRequest;
use Immoclick\Admin\Models\User;
use Immoclick\Admin\Models\Group;
use Immoclick\Admin\Models\Package;
use Immoclick\Admin\Models\PackageGallery;
use Immoclick\Admin\Http\Requests\PackageGalleryRequest;
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
class PackageGalleryController extends Controller {
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
        View::share('viewPage', 'package-gallery');
    }

    /*
     * Dashboard
     * */

    public function index(PackageGallery $packageGallery, Request $request) {

        $page_title = 'Package'; 
        $page_action = 'View Package Gallery';
        $search = Input::get('search');
        if (isset($search)) {
            // echo $search;
            $packages = PackageGallery::Where('NameFR', 'LIKE', "%$search%")
                            ->orWhere('NameEN', 'LIKE', "%$search%")->get();
        } else if ($search) { 
            // echo $search;
            $packages = PackageGallery::Where('NameFR', 'LIKE', "%$search%")
                            ->orWhere('NameEN', 'LIKE', "%$search%")->get();
        } else {

            $packages = PackageGallery::with('package')->get();
        }


        return view('packages::packageGallery.index', compact('packages', 'page_title', 'page_action'));
    }

    /*
     * create Group method
     * */

    public function create(PackageGallery $packageGallery) {

        $packages = Package::all(); 
        $page_title = 'Package';
        $page_action = 'Add Package Image';

        return view('packages::packageGallery.create', compact('packages', 'packageGallery', 'page_title', 'page_action', 'groups'));
    }

    /*
     * Save Group method
     * */

    public function store(PackageGalleryRequest $request, PackageGallery $packageGallery) {

        $form_input = Input::all();
        if (Input::hasFile('Picture')) {
            $file = Input::file('Picture');
        } else {
            $file = '';
        }
        if ($file != '') {
            $image_name = $file->getClientOriginalName();
            $img_path = public_path('uploads/packageGallery/');
            $extension = Input::file('Picture')->getClientOriginalExtension(); // getting image extension
            $fileName = time() . '.' . $extension;
            $uploaded_at = $file->move($img_path, $fileName);
        } else {
            $fileName = '';
        }

        $packageName = Input::get('Package');

        $pn = explode('-', $packageName);

        $packageGallery->PictureName = $fileName;
        $packageGallery->PackageID = $pn['0'];
        $packageGallery->PictureURL = url('/uploads/packageGallery/' . $fileName);
        $packageGallery->Language = $pn['1'];

        $packageGallery->save();


        return Redirect::to(route('package-gallery'))
                        ->with('flash_alert_notice', 'New Package Image was successfully added !');
    }

    /*
     * Edit Group method
     * */

    public function edit(PackageGallery $packageGallery) {

        $page_title = 'Package';
        $page_action = 'View Package Gallery';
        $packages = Package::all();
        return view('packages::packageGallery.edit', compact('packages', 'packageGallery', 'page_title', 'page_action'));
    }

    public function update(PackageGalleryRequest $request, PackageGallery $packageGallery) {

        if (Input::hasFile('Picture')) {
            $file = Input::file('Picture');
        } else {
            $file = '';
        }
        if ($file != '') {
            $image_name = $file->getClientOriginalName();
            $img_path = public_path('uploads/packageGallery/');
            $extension = Input::file('Picture')->getClientOriginalExtension(); // getting image extension
            $fileName = time() . '.' . $extension;
            $uploaded_at = $file->move($img_path, $fileName);
        } else {
            $fileName = Input::get('tmpPicture');
        }

        $packageName = Input::get('Package');

        $pn = explode('-', $packageName);

        $packageGallery->PictureName = $fileName;
        $packageGallery->PackageID = $pn['0'];
        $packageGallery->PictureURL = url('/uploads/packageGallery/' . $fileName);
        $packageGallery->Language = $pn['1'];

        $packageGallery->save();

        return Redirect::to(route('package-gallery'))
                        ->with('flash_alert_notice', 'Package was successfully updated !');
    }

    public function destroy(PackageGallery $packageGallery) {
        Package::destroy($packageGallery->id);

        return Redirect::to(route('packageGallery'))
                        ->with('alert_class', 'Package was successfully deleted!');
    }

    public function show(Package $package) {
        
    }

}
