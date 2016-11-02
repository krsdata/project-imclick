<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Immoclick\Admin\Http\Requests\UserRequest;
use Immoclick\Admin\Http\Requests\PackageRequest;
use Immoclick\Admin\Models\Group;
use Immoclick\Admin\Models\Package;
use Immoclick\Admin\Models\City;
use Immoclick\Admin\Models\Sector;
use Immoclick\Admin\Models\Region;
use Immoclick\Admin\Models\BuildingCategory;
use Immoclick\Admin\Models\BuildingType;
use Immoclick\Admin\Models\Building;
use Immoclick\Admin\Models\User;
use Immoclick\Admin\Models\BuildingChoice;
use Immoclick\Admin\Models\buildingRoom; 
use Immoclick\Admin\Models\Transaction;
use Immoclick\Admin\Models\SectorCity;
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
use App\Helpers\Helper as Helper;
use Response;
use Cookie;
use Hash;
/**
 * Class TransactionsController
 */
class TransactionsController extends Controller {
    /**
     * @var  Repository
     */

    /**
     * Displays all admin.
     *
     * @return \Illuminate\View\View
     */
    public function __construct(Request $request) {
     //   $this->middleware('auth');
        View::share('viewPage', 'Transactions');
        $this->lang = $request->segment(1);
        $helper = new Helper;
        if(strlen($this->lang)==2)
        {
            $this->lang = $helper->getLanguage($this->lang); 
        }else{
            $this->lang = $helper->getLanguage(null); 
        }
       // dd($request->path());
        View::share('lang', $this->lang);
        View::share('helper', new Helper);
    }

    /*
     * Dashboard
     * */

    public function index(Request $request) {
        $user = Auth::user();
        //Redirect user if not logged in
        if(!isset($user))
        {
            return redirect('/');
        }
        
        $buildingID = Input::get('buildingID');
        $building = Building::where("id", $buildingID)->where("UserID", $user->UserID)->get();
        
        //Redirect user if building id is not link to the current user.
        if(count($building) == 0)
        {
            return redirect('/');
        }
        
        $page_title     = 'Transactions'; 
        $page_action    = 'View Transactions';
        $max_price      = 1500000;
        $min_price      = 0;
        $types          = Building::with(['btype'])->groupBy('TypeID')->get();
        $types          = BuildingType::all();
        $categories     = BuildingCategory::orderBy('NameEN','ASC')->get();
        $cities         = Building::with(['city'])->groupBy('CityID')->get();
        $regions        = Region::orderBy('Name','ASC')->get();
        $rooms          = Building::where('status', 1)->groupBy('Rooms_number')->get();
        $courtiers      = User::where("GroupID", 1)->where("Transaction_Type", 1)->get();
        $sectors        = Sector::all();
        $region_id      = []; 
        //$sectorCity     = SectorCity::orderBy('Name', 'ASC')->get();  
        $sectorCity    = SectorCity::join('t_sector_region', 't_sector_region.RegionID', '=', 't_sector_city.RegionID')->where('PartenaireOnly', '=', '0')->orderBy('Region_Name', 'ASC')->orderBy('Name', 'ASC')->get();  
        
        return view('transactions.index', compact('categories','online_since','region_id', 'rooms', 'max_price', 'min_price', 'types', 'cities', 'regions', 'buildingID', 'building', 'sectors', 'sectorCity'));
    }
    
    public function courtiers() {
        $user = Auth::user();
        //Redirect user if not logged in
        if(!isset($user))
        {
            return redirect('/');
        }
        
        $buildingID = Input::get('buildingID');
        $sectorID = Input::get('SectorID');
        $type = Input::get('Type');
        $building = Building::where("id", $buildingID)->where("UserID", $user->UserID)->get();
        
        //Redirect user if building id is not link to the current user.
        if(count($building) == 0)
        {
            return redirect('/');
        }
        
        $count = 10;
        $page_title     = 'Courtiers'; 
        $page_action    = 'View Courtiers';
        $max_price      = 1500000;
        $min_price      = 0;
        $types          = Building::with(['btype'])->groupBy('TypeID')->get();
        $types          = BuildingType::all();
        $categories     = BuildingCategory::orderBy('NameEN','ASC')->get();
        $cities         = Building::with(['city'])->groupBy('CityID')->get();
        $regions        = Region::orderBy('Name','ASC')->get();
        $rooms          = Building::where('status', 1)->groupBy('Rooms_number')->get();
        $courtiers      = User::where("t_user.GroupID", 1)->join('t_coutier_property_user', 't_coutier_property_user.CourtierID', '=', 't_user.UserID')->join('t_banner', 't_banner.id', '=', 't_user.BannerID')->where("t_user.Transaction_Type", 1)->where("t_user.Vacance", 0)->where("t_coutier_property_user.CityID", $sectorID)->where("t_coutier_property_user.PropertyID", $type)->get()->toArray();
        $courtiers      = Helper::shuffle_assoc($courtiers);
        
        if(count($courtiers) < 10)
        {
            $count = count($courtiers);
        } 
        
        $courtiers = array_slice($courtiers, 0, $count);
        
        return view('transactions.courtiers',compact('categories','online_since','region_id', 'rooms', 'max_price', 'min_price', 'types', 'cities', 'regions', 'buildingID', 'building', 'sectors', 'courtiers', 'buildingID', 'sectorID', 'type', 'user'));
    }
    
    public function choisirmoncourtier() {
        $user = Auth::user();
        //Redirect user if not logged in
        if(!isset($user))
        {
            return redirect('/');
        }
        
        $transactionID = Input::get('transactionID');
        $sectorID = Input::get('SectorID');
        $type = Input::get('Type');
        $transaction = Transaction::where("ID", $transactionID)->where("UserID", $user->UserID)->get();
        
        //Redirect user if building id is not link to the current user.
        if(count($transaction) == 0)
        {
            return redirect('/');
        }
        
        $count = 10;
        $page_title     = 'Courtiers'; 
        $page_action    = 'View Courtiers';
        $max_price      = 1500000;
        $min_price      = 0;
        $types          = Building::with(['btype'])->groupBy('TypeID')->get();
        $types          = BuildingType::all();
        $categories     = BuildingCategory::orderBy('NameEN','ASC')->get();
        $cities         = Building::with(['city'])->groupBy('CityID')->get();
        $regions        = Region::orderBy('Name','ASC')->get();
        $rooms          = Building::where('status', 1)->groupBy('Rooms_number')->get();
        $courtiers      = User::join('t_transaction_courtier', 't_transaction_courtier.CourtierID', '=', 't_user.UserID')->join('t_banner', 't_banner.id', '=', 't_user.BannerID')->where("t_transaction_courtier.Accepted", 1)->where("t_transaction_courtier.TransactionID", $transactionID)->where("t_user.GroupID", 1)->get()->toArray();
        
        return view('transactions.choisir-mon-courtier',compact('categories','online_since','region_id', 'rooms', 'max_price', 'min_price', 'types', 'cities', 'regions', 'sectors', 'courtiers', 'user', 'transactionID', 'transaction'));
    }
    
    public function createtransaction()
    {
        $page_title     = 'Transactions'; 
        $page_action    = 'View Transactions';
        
        date_default_timezone_set('America/Montreal');
        $user = Auth::user();
        //Redirect user if not logged in
        if(!isset($user))
        {
            return redirect('/');
        }   
        
        $buildingID = Input::get('buildingID');
        $sectorID = Input::get('sectorID');
        $type = Input::get('type');
        $phone_number = Input::get('phone_number');
        $cell_number = Input::get('cell_number');
        $residence_number = Input::get('residence_number');
        $app_number = Input::get('app_number');
        $street_name = Input::get('street_name');
        $street_type = Input::get('street_type');
        $postal_code = Input::get('postal_code');
        $brokersIds = Input::get('brokersIds');
        $city = Input::get('city');
        $building = Building::where("id", $buildingID)->where("UserID", $user->UserID)->get();
        $max_price      = 1500000;
        $min_price      = 0;
        
        //Redirect user if building id is not link to the current user.
        if(count($building) == 0)
        {
            return redirect('/');
        }
        
        if(!isset($sectorID) || empty($sectorID)){
            return redirect('/');
        }
        
        if(!isset($type) || empty($type)){
            return redirect('/');
        }
        
        //Update contact infos
        \DB::table('t_user')->where('UserID', $user->UserID)->update(['Phone' => $phone_number, 'Cell' => $cell_number]);
        
         //Insert transaction
        $transactionID = \DB::table('t_transaction')->insertGetId(
            array('Transaction_Type' => 1, 'UserID' => $user->UserID, 'Transaction_Date' => date('Y-m-d H:i:s'), 'BuyOrSold' => 1, 'AddressNumber' => $residence_number,
            'Appartement' => $app_number, 'visitor' => 0, 'Status' => '0', 'TypeOfProperty' => $type, 'SectorID' => $sectorID, 'StreetType' => $street_type, 'StreetName' => $street_name,
            'CityName' => $city, 'PostalCode' => $postal_code, 'PropertyID' => $type, 'Address' => 'Volontaire')
        );
        
        \DB::table('t_building')->where('UserID', $user->UserID)->where('id', $buildingID)->update(['TransactionID' => $transactionID]);
        
        $brokers = explode(",", $brokersIds);
        
        $data = array("transactionID" => $transactionID);
        
        for ($i = 0; $i < count($brokers); $i++)
        {
            $Broker = User::where("UserID", $brokers[$i])->get()->first();
            
            \DB::table('t_transaction_courtier')->insert(
                array('TransactionID' => $transactionID, 'CourtierID' => $brokers[$i], 'Accepted' => 0, 'insert_Date' => date('Y-m-d H:i:s'))
            );
            
            if(!empty($transactionID)){
                $helper = new Helper;
                $phone = $helper->formatCellForTwilio($Broker->Cell);
                $send_sms = $helper->immoclic_create_sms($phone,"Immo-Clic.ca : Vous avez une nouvelle demande! Vous avez 12 heures pour accepter ou refuser! No de la demande : $transactionID, Cliquez sur le lien suivant pour voir la demande www.immo-clic.ca"); 
                
                $helper = new Helper; 
                $email_content = array('receipent_email'=> $Broker->email,'subject'=>'Nouvelle transaction');
                $helper->sendMailFrontEnd($email_content, 'new-transaction', $data);
            }
        }
        
        $helper = new Helper; 
        $email_content = array('receipent_email'=> "info@immo-clic.ca",'subject'=>'Nouvelle transaction');
        $helper->sendMailFrontEnd($email_content, 'new-transaction-admin', $data);
        
        return view('transactions.createtransaction',compact('max_price', 'min_price'));
    }
    
    public function courtierchoisi()
    {
        $user = Auth::user();
        //Redirect user if not logged in
        if(!isset($user))
        {
            return redirect('/');
        }   
        
        $page_title     = 'Transactions'; 
        $page_action    = 'View Transactions';
        $TransactionID = Input::get('TransactionID');
        $CourtierID = Input::get('CourtierID');
        $Transaction = Transaction::where("ID", $TransactionID)->where("UserID", $user->UserID)->get();
        $max_price      = 1500000;
        $min_price      = 0;
        
        //Redirect user if building id is not link to the current user.
        if(count($Transaction) == 0)
        {
            return redirect('/');
        }
        
        //Update transaction
        \DB::table('t_transaction')->where('UserID', $user->UserID)->where('ID', $TransactionID)->update(['CourtierID' => $CourtierID, 'Status' => 1]);
        
        
        $Broker = User::where("UserID", $CourtierID)->get()->first();
        
        $data = array("transactionID" => $TransactionID);
        $helper = new Helper; 
        $email_content = array('receipent_email'=>$Broker->email, 'subject'=>'Vous avez été choisi');
        $helper->sendMailFrontEnd($email_content, 'broker-selected', $data);
         
        return view('transactions.courtier-choisi',compact('max_price', 'min_price'));
    }
    
    public function voirmoncourtier()
    {
        $user = Auth::user();
        //Redirect user if not logged in
        if(!isset($user))
        {
            return redirect('/');
        }   
        
        $page_title     = 'Transactions'; 
        $page_action    = 'View Transactions';
        $TransactionID = Input::get('transactionID');
        $CourtierID = Input::get('CourtierID');
        $Transaction = Transaction::where("ID", $TransactionID)->where("UserID", $user->UserID)->first();
        $max_price      = 1500000;
        $min_price      = 0;
        
        //Redirect user if building id is not link to the current user.
        if(count($Transaction) == 0)
        {
            return redirect('/');
        }
        
        $courtier = User::where("UserID", $Transaction->CourtierID)->first();
        
        return view('transactions.voir-mon-courtier',compact('max_price', 'min_price', 'courtier', 'Transaction'));
    }
}
