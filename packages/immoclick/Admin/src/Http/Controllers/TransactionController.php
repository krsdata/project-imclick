<?php

namespace Immoclick\Admin\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Immoclick\Admin\Http\Requests\UserRequest;
use Immoclick\Admin\Http\Requests\TransactionRequest;
use Immoclick\Admin\Models\User;
use Immoclick\Admin\Models\Group;
use Immoclick\Admin\Models\Transaction;
use Immoclick\Admin\Models\City;
use Immoclick\Admin\Models\Region;
use Immoclick\Admin\Models\BuildingCategory;
use Immoclick\Admin\Models\BuildingType;
use Immoclick\Admin\Models\Building;
use Immoclick\Admin\Models\HomeType;
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
class TransactionController extends Controller {
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
        View::share('viewPage', 'transaction');
    }

    /*
     * Dashboard
     * */

    public function index(Transaction $transaction, Request $request) {

        $page_title = 'Transaction';

        $page_action = 'View Transaction';  
        
        $search = Input::get('search')?Input::get('search'):0;        
        $buyOrsold = Input::get('buyOrsold');
        
        if (!empty($search) || $buyOrsold!=NULL) {            
           
            if(!empty($search))
            {
                $users = User::where(function($query) use($search) {
                    if (!empty($search)) {
                        $query->Where('FirstName', 'LIKE', "%$search%")
                                ->OrWhere('email', 'LIKE', "%$search%");
                    }
                })->get(['UserID']);
                $userID = [];
                foreach ($users as $key => $user) {
                    $userID[] = $user->UserID;
                }
            }
            else
            {
                $userID=array();
            }            
            if($buyOrsold==1 || $buyOrsold==0 and !empty($search))
            {
                $results = Transaction::with(['user'])
                            ->whereIn('UserID', $userID)->where('BuyOrSold',$buyOrsold)->paginate(Config::get('app.record_limit'));
            }
            else if($buyOrsold==1 || $buyOrsold==0)
            {
                $results = Transaction::where('BuyOrSold',$buyOrsold)->paginate(Config::get('app.record_limit'));
            }
            else
            {
                $results = Transaction::with(['user'])
                            ->whereIn('UserID', $userID)->paginate(Config::get('app.record_limit'));
            }


        } else {
            $results = Transaction::with('user')->paginate(Config::get('app.record_limit'));
        }

        //dd($results);

        return view('packages::transaction.index', compact('results', 'page_title', 'page_action'));
    }

    /*
     * create Group method
     * */

    public function create() {

        
    }

    /*
     * Save Group method
     * */

    public function store() {
       
    }

    /*
     * Edit Group method
     * */

    public function edit(Transaction $transaction, Request $request) {

        $page_title = 'Transaction';
        $page_action = 'View Transaction';        
        $mytransaction = Transaction::where('ID', $transaction->ID)->get();               
        return view('packages::transaction.edit', compact('mytransaction', 'page_title', 'page_action'));
    }

    public function update(Request $request, Transaction $transaction) {        
        $input=Input::all(); 
        $id=Input::get('id');      
        $validator =  Validator::make($input, [
               'BuyOrSold'      => 'required|numeric',
               'CourtierID'     => 'required|numeric',
               'Address'        => 'required', 
               'AddressNumber'  => 'required|numeric',
               'Appartement'    => 'required',
               'visitor'        => 'required|numeric',
               'Status'         => 'required|numeric',
               'TypeOfProperty' => 'required|numeric',              
               'end_date'       => 'date_format:yyyy-mm-dd',
               'SectorID'       => 'required|numeric',
               'StreetType'     => 'required|numeric',
               'StreetName'     => 'required',
               'CityName'       => 'required',
               'PostalCode'     => 'required',
               'SectorResearched'  => 'required',
               'AddedByBroker'  => 'required|numeric',
               'PropertyID'     => 'required|numeric',
               'PAFinale'       => 'required|numeric',               
            ]);
            if($validator->fails())
            {                       
                return Redirect::to(route('transaction.edit',$id))->withErrors($validator);
            } 
        $input = Input::except('_token','_method');        
        $transaction::where('ID', $id)->update($input);
        
        return Redirect::to(route('transaction'))
                        ->with('flash_alert_notice', 'transaction was successfully updated !');
    }

    public function destroy(Transaction $transaction) {        
        Transaction::where('ID', $transaction->ID)->delete();     
        return Redirect::to(route('transaction'))
                        ->with('alert_class', 'Transaction was successfully deleted!');
    }

    public function show(Package $package) {
        
    }

}
