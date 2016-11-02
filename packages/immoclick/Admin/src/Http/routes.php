<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;

$locale = Request::segment(1);

//Route::group( ['prefix' => $locale ] , function () {

Route::get('admin', 'Immoclick\Admin\Http\Controllers\AdminController@index');
Route::get('immoclic', function() {
    return view('packages::immoclic.index');
});
Route::get('admin/login', 'Immoclick\Admin\Http\Controllers\AdminController@login');

Route::post('admin/loginAuthentication', 'Immoclick\Admin\Http\Controllers\AdminController@loginAuthentication');

Route::get('admin/forgot-password', 'Immoclick\Admin\Http\Controllers\AdminController@forgotPassword');
Route::post('admin/forgot-password', 'Immoclick\Admin\Http\Controllers\AdminController@forgotPassword');


Route::bind('group', function($value, $route) {
    return Immoclick\Admin\Models\Group::find($value);
});

Route::resource('admin/group', 'Immoclick\Admin\Http\Controllers\GroupController', [
    'names' => [
        'edit' => 'group.edit',
        'show' => 'group.show',
        'destroy' => 'group.destroy',
        'update' => 'group.update',
        'store' => 'group.store',
        'index' => 'group',
        'create' => 'group.create',
    ]
        ]
);


// USers Routs
Route::bind('user', function($value, $route) {
    return Immoclick\Admin\Models\User::find($value);
});

Route::resource('admin/user', 'Immoclick\Admin\Http\Controllers\UsersController', [
    'names' => [
        'edit' => 'user.edit',
        'show' => 'user.show',
        'destroy' => 'user.destroy',
        'update' => 'user.update',
        'store' => 'user.store',
        'index' => 'user',
        'create' => 'user.create',
    ]
        ]
);

// package Routs 
Route::bind('package', function($value, $route) {
    return Immoclick\Admin\Models\Package::find($value);
});

Route::resource('admin/package', 'Immoclick\Admin\Http\Controllers\PackageController', [
    'names' => [
        'edit' => 'package.edit',
        'show' => 'package.show',
        'destroy' => 'package.destroy',
        'update' => 'package.update',
        'store' => 'package.store',
        'index' => 'package',
        'create' => 'package.create',
    ]
        ]
);

// package Routs 
Route::bind('package-gallery', function($value, $route) {
    return Immoclick\Admin\Models\PackageGallery::find($value);
});

Route::resource('admin/package-gallery', 'Immoclick\Admin\Http\Controllers\PackageGalleryController', [
    'names' => [
        'edit' => 'package-gallery.edit',
        'show' => 'package-gallery.show',
        'destroy' => 'package-gallery.destroy',
        'update' => 'package-gallery.update',
        'store' => 'package-gallery.store',
        'index' => 'package-gallery',
        'create' => 'package-gallery.create',
    ]
        ]
);


// package Routs 
Route::bind('building', function($value, $route) {
    return Immoclick\Admin\Models\Building::find($value);
});

Route::resource('admin/building', 'Immoclick\Admin\Http\Controllers\BuildingController', [
    'names' => [
        'edit' => 'building.edit',
        'show' => 'building.show',
        'destroy' => 'building.destroy',
        'update' => 'building.update',
        'store' => 'building.store',
        'index' => 'building',
        'create' => 'building.create',
    ]
        ]
);

// package images 
Route::bind('buildingImage', function($value, $route) {
    return Immoclick\Admin\Models\buildingImage::find($value);
});

Route::resource('admin/buildingImage', 'Immoclick\Admin\Http\Controllers\BuildingImageController', [
    'names' => [
        'edit'      => 'buildingImage.edit',
        'show'      => 'buildingImage.show',
        'destroy'   => 'buildingImage.destroy',
        'update'    => 'buildingImage.update',
        'store'     => 'buildingImage.store',
        'index'     => 'buildingImage',
        'create'    => 'buildingImage.create',
    ]
        ]
);


Route::bind('buildingRoom', function($value, $route) {
    return Immoclick\Admin\Models\BuildingRoom::find($value);
});

Route::resource('admin/buildingRoom', 'Immoclick\Admin\Http\Controllers\BuildingRoomController', [
    'names' => [
        'edit' => 'buildingRoom.edit',
        'show' => 'buildingRoom.show',
        'destroy' => 'buildingRoom.destroy',
        'update' => 'buildingRoom.update',
        'store' => 'buildingRoom.store',
        'index' => 'buildingRoom',
        'create' => 'buildingRoom.create',
    ]
        ]
);

// Building rent route
Route::bind('buildingRent', function($value, $route) {
    return Immoclick\Admin\Models\BuildingRent::find($value);
});

Route::resource('admin/buildingRent', 'Immoclick\Admin\Http\Controllers\BuildingRentController', [
    'names' => [
        'edit' => 'buildingRent.edit',
        'show' => 'buildingRent.show',
        'destroy' => 'buildingRent.destroy',
        'update' => 'buildingRent.update',
        'store' => 'buildingRent.store',
        'index' => 'buildingRent',
        'create' => 'buildingRent.create',
    ]
        ]
);


// Building Inclusion route
Route::bind('buildingInclusion', function($value, $route) {
    return Immoclick\Admin\Models\BuildingInclusion::find($value);
});

Route::resource('admin/buildingInclusion', 'Immoclick\Admin\Http\Controllers\BuildingInclusionController', [
    'names' => [
        'edit' => 'buildingInclusion.edit',
        'show' => 'buildingInclusion.show',
        'destroy' => 'buildingInclusion.destroy',
        'update' => 'buildingInclusion.update',
        'store' => 'buildingInclusion.store',
        'index' => 'buildingInclusion',
        'create' => 'buildingInclusion.create',
    ]
        ]
);


// Building Exclusion route

Route::bind('buildingExclusion', function($value, $route) {
    return Immoclick\Admin\Models\BuildingExclusion::find($value);
});

Route::resource('admin/buildingExclusion', 'Immoclick\Admin\Http\Controllers\BuildingExclusionController', [
    'names' => [
        'edit' => 'buildingExclusion.edit',
        'show' => 'buildingExclusion.show',
        'destroy' => 'buildingExclusion.destroy',
        'update' => 'buildingExclusion.update',
        'store' => 'buildingExclusion.store',
        'index' => 'buildingExclusion',
        'create' => 'buildingExclusion.create',
    ]
        ]
);

// Building Exclusion route

Route::bind('buildingReview', function($value, $route) {
    return Immoclick\Admin\Models\BuildingReview::find($value);
});

Route::resource('admin/buildingReview', 'Immoclick\Admin\Http\Controllers\BuildingReviewController', [
    'names' => [
        'edit' => 'buildingReview.edit',
        'show' => 'buildingReview.show',
        'destroy' => 'buildingReview.destroy',
        'update' => 'buildingReview.update',
        'store' => 'buildingReview.store',
        'index' => 'buildingReview',
        'create' => 'buildingReview.create',
    ]
        ]
);

Route::bind('systemAlertSearch', function($value, $route) {
    return Immoclick\Admin\Models\SystemAlertSearch::find($value);
});

Route::resource('admin/systemAlertSearch', 'Immoclick\Admin\Http\Controllers\SystemAlertSearchController', [
    'names' => [
        'edit' => 'systemAlertSearch.edit',
        'show' => 'systemAlertSearch.show',
        'destroy' => 'systemAlertSearch.destroy',
        'update' => 'systemAlertSearch.update',
        'store' => 'systemAlertSearch.store',
        'index' => 'systemAlertSearch',
        'create' => 'systemAlertSearch.create',
    ]
        ]
);

Route::bind('transaction', function($value, $route) {
    return Immoclick\Admin\Models\Transaction::find($value);
});

Route::resource('admin/transaction', 'Immoclick\Admin\Http\Controllers\TransactionController', [
    'names' => [
        'edit' => 'transaction.edit',
        'show' => 'transaction.show',
        'destroy' => 'transaction.destroy',
        'update' => 'transaction.update',
        'store' => 'transaction.store',
        'index' => 'transaction',
        'create' => 'transaction.create',
    ]
        ]
); 