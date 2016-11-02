<?php
/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

$locale = Request::segment(1);

Route::group(
        [
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localize'] // Route translate middleware
        ], function() {
    Route::controllers([
        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
        'adminLogin' => 'Auth\AuthController',
    ]);
    /*
     * Do Login & Registration
      */
    
    Route::resource('register', 'HomeController@register');
    Route::resource('userLogin', 'HomeController@userLogin'); 
    Route::post('/login', function(Request $request) {        
        $credentials = array('email' => Input::get('email'), 'password' => Input::get('password'),'GroupID'=>'4'); 
        if (Auth::attempt($credentials, true)) {
            return Redirect::to('admin');
        }
        return Redirect::to('auth/login')->with('flash_alert_notice', 'Wrong Email or Password. Try again !')->withInput();
    });
    /*
     * Do Logout
     */
    Route::get('logout', function() {
        Auth::logout();
        return Redirect::to('admin/login');
    });
    /**
     * Logout from user panel
     */
    Route::get('logOut', function() {
        Auth::logout();
        return Redirect::to('/');
    });
    /**
     * Forgot password reset link
     */  
    Route::get('forgot-password','HomeController@forgotPassword');
    /**
     * reset-passwordlink
     */ 
    Route::get('reset-password','HomeController@resetPassword');
    /*
     * Call Home page
     */
    
  //  Route::resource('/', 'HomeController@index'); 

    Route::resource('/', 'HomeController@index');
    /*
       * get list of ville for region 
       */
    Route::resource('getVille', 'HomeController@getVille');
    /*
       * get list of ville for region 
       */
    Route::resource('getSectors', 'HomeController@getSectors');
    /*
     * Call Search page on search
     */
    Route::resource('recherche', 'HomeController@search');

    Route::resource('search-result', 'HomeController@searchResult');
    /*
     * Call Search detail page on view detail
     */
    Route::resource('propriete', 'HomeController@searchDetail');
    /*
     * emi calculate
     */
    Route::resource('emi', 'HomeController@emi');
    /*
     * activate-building
     */
    Route::resource('activate-building', 'MyAccountController@activatebuilding');
    /*
    * Add to favorite
     */
    Route::resource('addTofav', 'HomeController@addTofav');
    
    Route::resource('comment-ca-marche', 'HomeController@commentcamarche');
    /**
     * change password
     */
    Route::post('changePassword', 'MyAccountController@changePassword');
    /**
     * change password
     */
    Route::post('closeBuilding', 'MyAccountController@closeBuilding');
    /**
    *get city by region id
    */
    Route::post('get_city', 'MyAccountController@get_city');
    /**
     * Check Login Status
     */
     Route::get('rem_fav', 'MyAccountController@rem_fav');
    /**
    *save register house
    */
    Route::post('save_house', 'MyAccountController@save_house');
    /**
     * Check Login Status
      */
    Route::resource('courtiers', 'TransactionsController@courtiers', [
        'names' => [
            'index' => 'courtiers',
        ]
            ]
    );
    Route::resource('createtransaction', 'TransactionsController@createtransaction', [
        'names' => [
            'index' => 'createtransaction',
        ]
            ]
    );
    Route::resource('choisir-mon-courtier', 'TransactionsController@choisirmoncourtier', [
        'names' => [
            'index' => 'choisir-mon-courtier',
        ]
            ]
    );
    Route::resource('courtier-choisi', 'TransactionsController@courtierchoisi', [
        'names' => [
            'index' => 'courtier-choisi',
        ]
            ]
    );
    Route::resource('voir-mon-courtier', 'TransactionsController@voirmoncourtier', [
        'names' => [
            'index' => 'voir-mon-courtier',
        ]
            ]
    );
    /*******for ipn***********/
    Route::resource('getIpn', 'PaymentController@get_ipn');
 
    Route::resource('paypal_ipn', 'HomeController@paypal_ipn');
 

    /*******for remove building room according to Floor type***********/
    Route::resource('del_build_room', 'MyAccountController@del_build_room');
    Route::resource('delete_list', 'MyAccountController@delete_list');

    Route::resource('checkLoginStatus', 'HomeController@checkLoginStatus');
    Route::resource('SetSector', 'HomeController@SetSector');
    Route::resource('paypal_ipn_email', 'HomeController@paypal_ipn_email');
    
    
    // Package routes //
// <<<<<<< HEAD
//     Route::bind('packages', function($value, $route) {
//     return App\Models\Package::find($value);
//     });

//     Route::resource('packages', 'PackageController', [
// =======
    Route::bind('forfaits', function($value, $route) {
        return App\Models\Package::find($value);
    });

    Route::resource('forfaits', 'PackageController', [

        'names' => [
            'edit' => 'packages.edit',
            'show' => 'packages.show',
            'destroy' => 'packages.destroy',
            'update' => 'packages.update',
            'store' => 'packages.store',
            'index' => 'packages',
            'create' => 'packages.create',
        ]
            ]
    );
    
    // Buy routes //
    Route::bind('acheter', function($value, $route) {
    });

    Route::resource('acheter', 'BuyController', [
        'names' => [
            'index' => 'acheter',
        ]
            ]
    );
    
    Route::bind('images', function($value, $route) {
    });
    
    Route::resource('edittitle', 'ImagesController@edittitle');
    Route::resource('updateindeximages', 'ImagesController@updateindeximages');
    Route::resource('enableimages', 'ImagesController@enableimages');
    Route::resource('mes-images', 'ImagesController@myimages');
    Route::resource('images', 'ImagesController', [
        'names' => [
            'index' => 'images',
        ]
            ]
    );
    // Send sms/call
    Route::resource('immoclic_call_sms', 'HomeController@immoclic_call_sms');
    
    // Sale routes //
    Route::bind('vendre', function($value, $route) {
    });

    Route::resource('vendre', 'SaleController', [
        'names' => [
            'index' => 'vendre',
        ]
            ]
    );
    
    // Voluntary Broker routes //
    Route::bind('courtier-immobilier-volontaire', function($value, $route) {
    });

    Route::resource('courtier-immobilier-volontaire', 'VoluntaryBrokerController', [
        'names' => [
            'index' => 'courtier-immobilier-volontaire',
        ]
            ]
    );
    
    // FAQ routes //
    Route::bind('faq', function($value, $route) {
    });

    Route::resource('faq', 'FaqController', [
        'names' => [
            'index' => 'faq',
        ]
            ]
    );
    
    // Transactions routes //
    Route::bind('transactions', function($value, $route) {
    });

    Route::resource('transactions', 'TransactionsController', [
        'names' => [
            'index' => 'transactions',
        ]
            ]
    );
    
    //politique de confidentialite routes //
    Route::bind('politique-de-confidentialite', function($value, $route) {
    });

    Route::resource('politique-de-confidentialite', 'PrivacyPolicyController', [
        'names' => [
            'index' => 'politique-de-confidentialite',
        ]
            ]
    );
    
    //condition dutilisation routes //
    Route::bind('condition-dutilisation', function($value, $route) {
    });

    Route::resource('condition-dutilisation', 'TermsOfUseController', [
        'names' => [
            'index' => 'condition-dutilisation',
        ]
            ]
    );
    
    //about routes //
    Route::bind('a-propos-de-nous', function($value, $route) {
    });

    Route::resource('a-propos-de-nous', 'AboutController', [
        'names' => [
            'index' => 'a-propos-de-nous',
        ]
            ]
    );
    
     // contact routes
    Route::bind('contact', function($value, $route) {
    return App\Models\Contact::find($value);
    });

    Route::resource('contact', 'ContactController', [
        'names' => [
            'edit' => 'contact.edit',
            'show' => 'contact.show',
            'destroy' => 'contact.destroy',
            'update' => 'contact.update',
            'store' => 'contact.store',
            'index' => 'contact',
            'create' => 'contact.create',
        ]
            ]
    );
    
      // payment routes
    Route::bind('payment', function($value, $route) {
    return App\Models\Payment::find($value);
    });

    Route::resource('payment', 'PaymentController', [
        'names' => [
            'edit'      => 'payment.edit',
            'show'      => 'payment.show',
            'destroy'   => 'payment.destroy',
            'update'    => 'payment.update',
            'store'     => 'payment.store',
            'index'     => 'payment',
            'create'    => 'payment.create',
        ]
            ]
    );
    
    Route::get('register-house', [
	    'middleware' => 'auth',
	    'uses' => 'MyAccountController@edit'
	]);
    // My account Route
    Route::bind('mon-compte', function($value, $route) {
    return App\User::find($value);
    });
    
    Route::post('mon-compte/update', 'MyAccountController@update');
    
    Route::resource('mon-compte', 'MyAccountController', [
        'names' => [
            'edit'      => 'mon-compte.edit',
            'show'      => 'mon-compte.show',
            'destroy'   => 'mon-compte.destroy',
            'update'    => 'mon-compte.update',
            'store'     => 'mon-compte.store',
            'index'     => 'mon-compte',
            'create'    => 'mon-compte.create', 
            'removeFavorite'  => 'mon-compte.removeFavorite',
        ]
            ]
    );
    // Register house
    Route::resource('mon-compte/register-house', 'MyAccountController', [
        'names' => [
            'edit'      => 'register-house.edit',
            'show'      => 'register-house.show',
            'destroy'   => 'register-house.destroy',
            'update'    => 'register-house.update',
            'store'     => 'register-house.store',
            'index'     => 'register-house',
            'create'    => 'register-house.create',
        ]
            ]
    );

    // New redirected route start

    Route::get('commercants',function(){
        return Redirect::to('immobilier/partenaires');
    });

     Route::get('acheter-vendre',function(){
        return Redirect::to('immobilier/courtiers');
    }); 

    Route::get('a-propos',function(){
        return Redirect::to('/');
    });

    Route::get('financement-hypothecaire',function(){
        return Redirect::to('immobilier/financement');
    });

    Route::get('blogue',function(){
        return Redirect::to('immobilier/blogue');
    });

    Route::get('concours',function(){
        return Redirect::to('/');
    }); 
    // New redirected route End
});
 