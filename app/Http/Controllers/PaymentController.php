<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Immoclick\Admin\Http\Requests\UserRequest;
use Immoclick\Admin\Http\Requests\PackageRequest;
use App\Http\Requests\PaymentRequest;
use Immoclick\Admin\Models\Group;
use Immoclick\Admin\Models\Package;
use Immoclick\Admin\Models\City;
use Immoclick\Admin\Models\Region;
use Immoclick\Admin\Models\BuildingCategory;
use Immoclick\Admin\Models\BuildingType;
use Immoclick\Admin\Models\Building;
use Immoclick\Admin\Models\User;
use App\Models\Payment; 
use Immoclick\Admin\Models\BuildingChoice;
use Immoclick\Admin\Models\buildingRoom;
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
use Input;
use Session;
use Omnipay\Omnipay;
use Omnipay\Common\CreditCard; 
use Omnipay\PayPal;
use Fahim\PaypalIPN\PaypalIPNListener;
use Illuminate\Log\Writer;
use Monolog\Logger as Monolog;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Storage;
//use CreditCard;
 
/**
 * Class AdminController
 */
class PaymentController extends Controller {
    /**
     * @var  Repository
     */

    /**
     * Displays all admin.
     *
     * @return \Illuminate\View\View
     */
    public function __construct(Request $request) {
      
        View::share('viewPage', 'package');
        $this->lang = $request->segment(1);
        $helper = new Helper;
        if(strlen($this->lang)==2)
        {
            $this->lang = $helper->getLanguage($this->lang); 
        }else{
            $this->lang = $helper->getLanguage(null); 
        } 
        View::share('lang', $this->lang);
        View::share('helper', new Helper);
        $online_since = Building::where('status', 1)->groupBy('Built_in')->get();
        View::share('online_since', $online_since);
        
    }

    /*
     * Dashboard
     * */

    public function index(Payment $payment, Request $request) { 
        
        $packageID      = $request->input('packageID'); 
        $credit_card    = $packageID;  
        if($packageID==null)
        {
            return Redirect::to($this->lang.'/forfaits'); 
        }
        $package = Package::find($packageID);
        $gateway = Omnipay::create( 'PayPal_Express' );
        $gateway->setUsername( 'kundan.r-facilitator-2_api1.cisinlabs.com' );
        $gateway->setPassword( 'MSQS653H9A4QS7FB' );
        $gateway->setSignature( 'ABr3Vod5oMAm7SisuCYQGg59mo7fAexp9AJrWOgeSGOQrSWc4RLWIDfr' );
        $gateway->setTestMode( true );

        $building   = Building::with(['buildingImage', 'user', 'btype', 'package', 'bcategory', 'city'])->get();
        // $max_price  = Building::where('status', 1)->max('Price');
        // $min_price  = Building::where('status', 1)->min('Price');
        $max_price      = 1500000;
        $min_price      = 0;
        $types      = Building::with(['btype'])->groupBy('TypeID')->get();
        $types      = BuildingType::all();
        $categories = BuildingCategory::orderBy('NameEN','ASC')->get();
        $cities     = Building::with(['city'])->groupBy('CityID')->get();
        $regions    = City::with(['region'])->groupBy('RegionID')->get();
        $rooms      = Building::where('status', 1)->groupBy('Rooms_number')->get();
        $region_id  = [];  

        return view('payment.index', compact('package','packageID','payment','categories','online_since','region_id', 'rooms', 'building', 'max_price', 'min_price', 'types', 'cities', 'regions', 'helper'));
    }

    /*
     * create Group method
     * */

    public function create(Payment $payment) {        
        $page_title = 'Payment'; 
        $page_action = 'View Payment';
        $max_price      = 1500000;
        $min_price      = 0;
        $building = Building::with(['buildingImage', 'user', 'btype', 'package', 'bcategory', 'city'])->get();
        $max_price = Building::where('status', 1)->max('Price');
        $min_price = Building::where('status', 1)->min('Price');
        $types = Building::with(['btype'])->groupBy('TypeID')->get();
        $types = BuildingType::all();
        $categories = BuildingCategory::orderBy('NameEN','ASC')->get();
        $cities = Building::with(['city'])->groupBy('CityID')->get();
        $regions = City::with(['region'])->groupBy('RegionID')->get();
        $rooms = Building::where('status', 1)->groupBy('Rooms_number')->get();
        $region_id = [];  
        return view('payment.index', compact('payment','categories','online_since','region_id', 'rooms', 'building', 'max_price', 'min_price', 'types', 'cities', 'regions', 'helper','max_price','min_price'));
     }

    /*
     * Save Group method
     * */

    public function store(PaymentRequest $request, Payment $payment) {  
        
        $is_user_login  = isset(Auth::user()->UserID)?Auth::user()->UserID:false;
        $package_id     = Input::get('package_id');
        $packages       = Package::find($package_id);
        $packagePrice   = $packages->Price;
        $tpsAmount      = round((($packagePrice*5)/100),2);
        $tvqAmount      = round((($packagePrice*9.975)/100),2);
        $package_price  = round(($packagePrice+$tpsAmount+$tvqAmount),2);
        $subTotal       = $packagePrice;
        
        //echo $packages->Price.'->'.$tpsAmount.'->'.$tvqAmount.'->'.$package_price;
        $option = '';
        if((isset($request->fb_add_amt)) && !empty($request->fb_add_amt))
        {
           $package_price   = $package_price+114.98;
           $option          = 1;
           $subTotal        = $packagePrice+100;  
        }
       
        if($is_user_login && $packages!=null)
        {  
           $package_name    = $packages->NameEN;
          
           $package_month   = $packages->Month;
           $package_hdr     = $packages->Picture_HDR;
           $created_at      = date('Y-m-d');
           $expriry_at      = ($package_month==4)?$package_month:($package_month==6)?$package_month:0;
            
           $date            = $created_at; 
           $newdate         = strtotime ( $expriry_at.' month' , strtotime ( $date ) ) ;
           $newdate         = date ( 'Y-m-j' , $newdate );
           $expriry_date    = $newdate;
           $userID          =   Auth::user()->UserID;
           $userName        =   Auth::user()->FirstName;
           $userEmail       =   Auth::user()->email;
           if($expriry_date==$created_at)
           {
                $expriry_date = "0000-00-00";
           }

           $card_num = Input::get('credit_card');   
            
            if($package_id===$card_num)
            {                
                $gateway = Omnipay::create('PayPal_Express');
                $gateway->setUsername('info_api1.immo-clic.ca');
                $gateway->setPassword('2SQYW8UGURWSDGGM');
                $gateway->setSignature('AYz7BNjNgcIFwX1-eo77gMUl1HfIAbyeLdnu2-dzqXZH7ziExWLfiJwv');
                /*$gateway->setUsername( 'kundan.r-facilitator-3_api1.cisinlabs.com' );
                $gateway->setPassword( '32UN5286G4FDKWK7' );
                $gateway->setSignature( 'AgsyRufAX1NOEGmzAg0vXIX4pkjQAEaRyKcNiHzfR5Ka0I-74umoKXhH' );
                $gateway->setTestMode( true ); */
               
                //$TransactionID = Helper::RandomString();
                
                $params = array(
                    //'transactionId' => $TransactionID,
                    'cancelUrl'   => url( $this->lang . '/payment/show?cancelUrl=true' ) ,
                    'returnUrl'   => url( $this->lang . '/payment/show?returnUrl=true' ) ,
                    'notify_url'  =>  'http://www.immo-clic.ca/paypal_ipn',
                    'name'        =>  $package_name, 
                    'description' => 'Package_'.$package_month,
                    'amount'      => $package_price ,
                    'currency'    => 'CAD',
                ); 
                
                $response = $gateway->purchase( $params )->send(); 
                $data       = $response->getData();
                $txd_id     =  str_replace("EC-", "", $response->getTransactionReference());
                
                $payment                = new Payment;
                $payment->BuildingID    =  0;
                $payment->Txn_id        =  $txd_id;
                $payment->Paypal_id     =  "Building";    
                $payment->Price         =  $subTotal;
                $payment->Create_at     =  $created_at;
                $payment->Paid          =  0;
                $payment->Expire_at     =  $expriry_date; 
                $payment->Forfait_id    =  $package_id;
                $payment->Txn_type      =  "Paypal Express";
                $payment->UserID        =  Auth::user()->UserID;
                $payment->Token         =  0;
                $payment->AuthID        =  0;
                $payment->option1        =  $option;
                $payment->save(); 
                
                Session::put( 'params' , $params );
                Session::save();
                Session::put( 'payment_last_id' , $payment->id);
                Session::save();
                
                if ( $response->isSuccessful() ) { 
                   Cookie::forget('fb_ad_amt'); 
                   return $response;
                }
                elseif ( $response->isRedirect() ) {
                    Cookie::forget('fb_ad_amt');
                    $result = $response->redirect(); 
                }
                else {
                  Cookie::forget('fb_ad_amt');
                  return $response->getMessage();
                } 
            }
            else {
                
                $gateway = Omnipay::create('PayPal_Pro');
                /*$gateway->setUsername( 'kundan.r-facilitator-3_api1.cisinlabs.com' );
                $gateway->setPassword( '32UN5286G4FDKWK7' );
                $gateway->setSignature( 'AgsyRufAX1NOEGmzAg0vXIX4pkjQAEaRyKcNiHzfR5Ka0I-74umoKXhH' );*/
                $gateway->setUsername('info_api1.immo-clic.ca');
                $gateway->setPassword('2SQYW8UGURWSDGGM');
                $gateway->setSignature('AYz7BNjNgcIFwX1-eo77gMUl1HfIAbyeLdnu2-dzqXZH7ziExWLfiJwv');

               // $gateway->setTestMode( true );

                $card = new CreditCard(array(
                    'firstName'             => $userEmail,
                    'number'                => Input::get('credit_card'),
                    'expiryMonth'           => Input::get('month'),
                    'expiryYear'            => Input::get('year'),
                    'cvv'                   => Input::get('cvv'),
                )); 
                    try {
                        $transaction = $gateway->purchase(array(
                         'currency'         => 'CAD',
                         'description'      => 'Package_'.$package_month,
                         'card'             =>  $card,
                         'name'             =>  $package_name, 
                         'amount'           =>  $package_price  
                    ));

                    $response   = $transaction->send();
                    $data       = $response->getData();
                    $txd_id     =  isset($data['TRANSACTIONID'])?$data['TRANSACTIONID']:0;
                    $uid        = Auth::user()->UserID;
                    $ACK        = (isset($data['ACK']) && $data['ACK']=='Success')?1:(isset($data['ACK']) && $data['ACK']=='Failure')?2:0;
                    // dd($response);  
                    if ($response->isSuccessful()) { 

                        $payment                =  new Payment;
                        $payment->Txn_id        =  $txd_id;
                        $payment->BuildingID    =  0;
                        $payment->Paypal_id     =  "Building";      
                        $payment->Price         =  $subTotal;  
                        $payment->Create_at     =  $created_at;
                        $payment->Paid          =  $ACK;
                        $payment->Expire_at     =  $expriry_date; 
                        $payment->Forfait_id    =  $package_id;
                        $payment->Txn_type      =  'Credit Card';
                        $payment->UserID        =  $uid;
                        $payment->Token         =  0;
                        $payment->AuthID        =  0;
                        $payment->option1        =  $option;
                        $payment->save();

                        return Redirect::to('mon-compte#List');

                    }else
                    {  
                        $payment = new Payment;  
                        $payment->Txn_id        =  $txd_id;
                        $payment->BuildingID    =  0;
                        $payment->Paypal_id     =  "Building";      
                        $payment->Price         =  $subTotal;
                        $payment->Create_at     =  $created_at;
                        $payment->Paid          =  $ACK;
                        $payment->Expire_at     =  $expriry_date; 
                        $payment->Forfait_id    =  0;
                        $payment->Txn_type      =  'Credit Card';
                        $payment->UserID        =  $uid;
                        $payment->Token         =  0;
                        $payment->AuthID        =  0;
                        $payment->option1       =  $option;
                        $payment->save();
                        
                      echo "Your payment is  Failure <a href='".url('/')."'>Click here to redirect home</a>";

                    }
                } catch (\Exception $e) {
                   
                    return Redirect::back()->withErrors([$e->getMessage()])->withInput()->with('message',$e->getMessage());
                  //  return Redirect::to($this->lang.'/payment?packageID='.$package_id.'&msg='.$e->getMessage())->witherror('msg','msg');
                }
            }                
        }else{
             
            return Redirect::back()->withErrors('Something went wrong !');
        }
    }
    /*
     * Edit Group method
     * */
    public function edit(Payment $payment) {
    }

    public function update(PaymentRequest $request, Payment $payment) {
    }

    public function destroy(Payment $payment) {    
      /*  Package::destroy($package->id);
        return Redirect::to(route('package'))
                        ->with('alert_class', 'Package was successfully deleted!');*/
    }
    /*
    * Express checkout response for return URL
    * @method : GET
    * Author : Kundan roy
    */
    public function show(Payment $payment, User $user) { 

        $gateway = Omnipay::create( 'PayPal_Express' );
        /*--------------Sandbox credetial start---------------*/
       /* $gateway->setUsername( 'kundan.r-facilitator-3_api1.cisinlabs.com' );
        $gateway->setPassword( '32UN5286G4FDKWK7' );
        $gateway->setSignature( 'AgsyRufAX1NOEGmzAg0vXIX4pkjQAEaRyKcNiHzfR5Ka0I-74umoKXhH' );
        $gateway->setTestMode( true );*/
        /*--------------Sandbox credetial End---------------*/

        /*--------------Live credetial start---------------*/
        $gateway->setUsername('info_api1.immo-clic.ca');
        $gateway->setPassword('2SQYW8UGURWSDGGM');
        $gateway->setSignature('AYz7BNjNgcIFwX1-eo77gMUl1HfIAbyeLdnu2-dzqXZH7ziExWLfiJwv');
         /*--------------Live credetial End---------------*/
       
        $params = Session::get( 'params' );
        $response = $gateway->completePurchase( $params )->send();
        $data = $response->getData(); // this is the raw response ob
      
        $payment_id             = Session::get( 'payment_last_id' );    
        $payment                = Payment::find($payment_id);

        $payment->Txn_id        =  isset($data['PAYMENTINFO_0_TRANSACTIONID'])?$data['PAYMENTINFO_0_TRANSACTIONID']:'0';
        $payment->BuildingID    =  0;
        $payment->Paypal_id     =  0;      
        $payment->Paid          =  ($data['ACK']=='Success')?1:($data['ACK']=='Failure')?2:0;
        $payment->Txn_type      =  isset($data['PAYMENTINFO_0_TRANSACTIONTYPE'])?$data['PAYMENTINFO_0_TRANSACTIONTYPE']:'none';
        $payment->Token         =  isset($data['TOKEN'])?$data['TOKEN']:'0';
        $payment->AuthID        =  '0';
        $payment->save();  
        
        //echo "Your payment is ".$data['ACK']." <a href='".url('/')."'>Click here to redirect home</a>";
        return Redirect::to('mon-compte#List');
      } 
    public function get_ipn() { 
          return Redirect::to('/'); 
//        $helper = new Helper; 
//        $email_content = array('receipent_email'=> 'ismael12@mailinator.com','subject'=>'Immo-clic.ca : confirmation d’inscription');
//        $helper->sendMailFrontEnd($email_content,'welcome1', $raw_post_data);
//
    } 
}
