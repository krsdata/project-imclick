<?php

namespace App\Helpers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Mail;
use Auth;
use Config;
use View;
use Input;
use session;
use Crypt;
use Hash;
use Menu;
use Html;
use Illuminate\Support\Str;
use App\User;
use Phoenix\EloquentMeta\MetaTrait; 
use Illuminate\Support\Facades\Lang;
use Immoclick\Admin\Models\City;
use Immoclick\Admin\Models\Building;
use Immoclick\Admin\Models\BuildingType;
use Immoclick\Admin\Models\BuildingPrecision;
use Immoclick\Admin\Models\BuildingChoice;
use Immoclick\Admin\Models\BuildingInclusion;
use Immoclick\Admin\Models\BuildingExclusion;
use Immoclick\Admin\Models\BuildingInclusionExclusion;
use Immoclick\Admin\Models\BuildingPackage;
use Immoclick\Admin\Models\Commercants;
use Immoclick\Admin\Models\CommercantsCategory;
use Immoclick\Admin\Models\CommercantsVedette;
use Immoclick\Admin\Models\Transaction;
use Aloha\Twilio\Twilio; 
 

class Helper {

    /**
     * function used to check stock in kit
     *
     * @param = null
     */

    public static function SecureUrl($url){
        if (strpos($url, 'localhost') !== false) {
            return $url;
        }
        else{
            return str_replace("http//","https//",$url);
        }
    }
    
    public function generateRandomString() {
        $randomString = mt_rand( 1000000 , 9999999 );
        return $randomString;
    } 
    
    public static function getPassword(){
        $password = "";
        $user = Auth::user();
        if(isset($user)){
            $password = Auth::user()->Password;
        }
        return $password;
    }
    
    public static function RandomString()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 10; $i++) {
            $randstring = $characters[rand(0, strlen($characters))];
        }
        return $randstring;
    }
    
    public static function getUserLanguage(){
        $password = "";
        $user = Auth::user();
        if(isset($user)){
            $password = Auth::user()->Language;
        }else{
            $password = "FR";
        }
        return $password;
    }

    public static function shuffle_assoc($list) { 
        if (!is_array($list)) return $list; 

        $keys = array_keys($list); 
        shuffle($keys); 
        $random = array(); 
        foreach ($keys as $key) { 
            $random[$key] = $list[$key]; 
        }
        return $random; 
    } 

    /*
    * Get Lat lng form address     
    *
    */

    public  function  get_lat_long($address='') {
      
        $jsondata = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) .'&sensor=false'); 
        $obj = json_decode($jsondata,true); 

        if(isset($obj['results'][0])){
                return ($obj['results'][0]['geometry']['location']);
        }
      
        return array('lat'=>'43.7000','lng'=>'79.4000');
    }


    public static function calculate_tax($price='')
    {
        if($price<=50000)
        {
            $tax = ($price*(0.5))/100;
        }

    }
    
    public static function truncate($string,$length=100,$append="&hellip;") {
        $string = trim($string);

        if(strlen($string) > $length) {
            $string = wordwrap($string, $length);
            $string = explode("\n", $string, 2);
            $string = $string[0] . $append;
        }

        return $string;
    }
    
    public static function truncate_by_char($string,$length=100,$append="&hellip;") {

        $string = strlen($string) > $length ? substr($string,0,$length)."..." : $string;
        
        return $string;
    }
    
    public static function FormatPhoneNumber($number){
        return preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $number). "\n";
    }
    
    public static function GetCityName($CityID){
        return City::where('id',$CityID)->pluck('CityName');
    }
    
    public static function GetReviewTitle($Rate){
        switch ($Rate) {
            case 5:
                return Lang::get('website-lang.excellent');
                break;
            case 4:
                return Lang::get('website-lang.super');
                break;
            case 3:
                return Lang::get('website-lang.good');
                break;
            case 2:
                return Lang::get('website-lang.not_bad');
                break;
            case 1:
                return Lang::get('website-lang.normal');
                break;
            default:
                return Lang::get('website-lang.excellent');
                break;
        }
    }
    
    public static function GetBrokerOrSpecialisteName($TransactionType){
        if($TransactionType == 1){
            return "courtier immobilier";
        }
        else{
            return "sp&eacute;cialiste";
        }
    }
    
    public static function PageisAdmin($currentRouteName){
        $AdminRoutes = array(
            'mon-compte',
            'register-house.create',
            'transactions',
            'createtransaction',
            'courtiers',
            'choisir-mon-courtier',
            'courtier-choisi',
            'voir-mon-courtier',
            'images'
        );

        if(in_array($currentRouteName, $AdminRoutes)){
            return true;
        }
        return false;
    }
    
    public static function HideIfNotAMember(){
        $user = Auth::user();
        
        if(isset($user)){
            if($user->GroupID != 3)
            {
                return 'display:none;';
            }else{
                return "";
            }
        }
        return "";
    }
    
    public static function DisabledIfNotEmpty($value){
        if(!empty($value)){
            return "disabled";
        }
        return "";
    }
    
    public static function GetStreetType($StreetType){
        
        switch ($StreetType) {
            case 1:
                return Lang::get('website-lang.street');
                break;
            case 2:
                return Lang::get('website-lang.boulevard');
                break;
            case 3:
                return Lang::get('website-lang.avenue');
                break;
            case 4:
                return Lang::get('website-lang.rang');
                break;
            case 5:
                return Lang::get('website-lang.road');
                break;
            case 6:
                return Lang::get('website-lang.trail');
                break;
            default:
                return Lang::get('website-lang.street');
                break;
        }
    }
    
    public static function ConvertFeetToMeter($feet)
    {
        $result = round($feet * 0.3048, 2);
        return $result;
    }
    
    public static function GetBuildingType($TypeID, $lang){
        if($lang == 'FR') {
            $type = BuildingType::where('id',$TypeID)->pluck('NameFR');
        }else{
            $type = BuildingType::where('id',$TypeID)->pluck('NameEN');
        }
        return $type;
    }
    
    public static function GetCommercantVedette()
    {
        $SectorID = 2;
        if(isset($_COOKIE['SectorID']))
        {
            if($_COOKIE['SectorID'] != "" && $_COOKIE['SectorID'] != "0"){
                $SectorID = $_COOKIE['SectorID'];
            }
        } 
        
        $Commercant = CommercantsVedette::join('t_commercants', 't_commercants.id', '=', 't_commercants_vedette.CommercantID')->where('SectorID', $SectorID)->get()->first();   
        
        return $Commercant;
    }
    
    public static function GetSectorID(){
        $SectorID = 2;
        if(isset($_COOKIE['SectorID']))
        {
            if($_COOKIE['SectorID'] != "" && $_COOKIE['SectorID'] != "0"){
                $SectorID = $_COOKIE['SectorID'];
            }
        } 
        return $SectorID;
    }
    
    public static function GetCategoryCommercants($Length){
        
        $CommercantsCategory = CommercantsCategory::join('t_commercants', 't_commercants.CategoryID', '=', 't_commercants_category.id')->where('t_commercants.CityID','=',Helper::GetSectorID())->groupBy('t_commercants_category.id')->orderBy('t_commercants_category.id')->get();
        
        $Commerces = array();
        
        for ($i = 0; $i < count($CommercantsCategory); $i++)
        {
            $Commercant = new CommercantsCat();
            $Commercant->ID = $CommercantsCategory[$i]->CategoryID;
            $Commercant->Class = $CommercantsCategory[$i]->Class;
            $Commercant->NameEN = $CommercantsCategory[$i]->NameEN;
            $Commercant->NameFR = $CommercantsCategory[$i]->NameFR;
            $Commercant->Img = $CommercantsCategory[$i]->img;
            
            switch ($Commercant->Class) {
                case "financement":
                    $Catfinancement = $Commercant;
                    break;
                //case "assurance-habitation":
                //    $CatAssHabitation = $Commercant;
                //    break;
                //case "assurances-hypo":
                //    $CatAssHypo = $Commercant;
                //    break;
                default:
                    array_push($Commerces,$Commercant);
                
            }
        }
        
        shuffle($Commerces);
        array_unshift($Commerces, $Catfinancement/*, $CatAssHabitation, $CatAssHypo*/);
        
        if($Length > 0){
            return array_splice($Commerces,0,$Length);
        }
        
        return $Commerces;
    }
    
    public static function GetCommercantsHtml($ListCommercants,$Language,$Class){
        
        $Html = '<div class="comms-grid">';
        
        for ($i = 0; $i < count($ListCommercants); $i++){
            $Text = $ListCommercants[$i]->NameFR;
            if($Language != "FR")
            {
                $Text = $ListCommercants[$i]->NameEN;
            }
            
            if($ListCommercants[$i]->Class == 'financement')
            {
                $PageName = "http://immo-clic.ca/immobilier/financement/";
                if($Language == "EN")
                {
                    $PageName = "http://immo-clic.ca/immobilier/en/financement/";
                }
                
                $Html .= '<div class="' . $Class . '" category="' . $Text . '">
                        <span class="cube" img="' . $ListCommercants[$i]->Img . '"  onclick="return window.open(\'' . $PageName . '\', \'_blank\');">
                            <div class="rotation ' . $ListCommercants[$i]->Class . '">
                                <div class="active">
                                    <span>' . $Text . '</span>
                                </div>
                            </div>
                        </span>
                    </div>';
            }
            else
            {
                $Html .= '<div class="' . $Class . '" category="' . $Text . '">
                        <span class="cube" img="' . $ListCommercants[$i]->Img . '" onclick="return ShowCommercantsByCategory(' . $ListCommercants[$i]->ID . ',' . Helper::GetSectorID() . ',\''. $Language .'\');">
                            <div class="rotation ' . $ListCommercants[$i]->Class . '">
                                <div class="active">
                                    <span>' . $Text . '</span>
                                </div>
                            </div>
                        </span>
                    </div>';
            }
        }
        
        $Html .='</div>';
        
        return $Html;
    }
    
    public static function GetBuildingCharacteristics($characteristics, $groupID, $lang){
        $result = "";
        $ids = explode(",", $characteristics);
        
        for ($i = 0; $i < count($ids); $i++)
        {
            if($lang == 'FR') {
                $result .= " " . BuildingChoice::where('GroupID', $groupID)->where('ID', $ids[$i])->pluck('Value_FR') . ",";
            }else{
                $result .= " " . BuildingChoice::where('GroupID', $groupID)->where('ID', $ids[$i])->pluck('Value_EN') . ",";
            }
        }
        
        return rtrim($result, ",");
    }
    
    public static function ValidateUserHaveAccesToMap($buildingID){
        $result = "";
        $building = Building::where('id', $buildingID)->get()->first();
        
        if($building->CityID == 0){
            return "Vous devez choisir la ville.";
        }
        
        if($building->RegionID == 0){
            return "Vous devez choisir la région.";
        }
        
        if($building->StreetType == ""){
            return "Vous devez choisir le type d'artère.";
        }
        
        if($building->StreetName == ""){
            return "Vous devez choisir le nom de l'artère.";
        }
        
        if($building->HouseNumber == ""){
            return "Vous devez choisir le # de résidence.";
        }
        
        if($building->Postal_code == ""){
            return "Vous devez choisir le code postal.";
        }
    }
    
    public static function ValidateRequiredBuildingFields($buildingID){
        $result = "";
        $building = Building::where('id', $buildingID)->get()->first();
        
        if($building->CategoryID == 0){
            return "Vous devez choisir un type de propriété.";
        }
        
        if($building->TypeID == 0){
            return "Vous devez choisir le sous-types de propriété.";
        }
        
        if($building->Price == 0){
            return "Vous devez choisir le prix.";
        }
        
        if($building->Description_fr == ""){
            return "Vous devez choisir une description.";
        }
        
        if($building->Rooms_number == 0){
            return "Vous devez choisir le nombre de chambre.";
        }
        
        if($building->Bathroom_number == 0){
            return "Vous devez choisir le nombre de salle(s) de bain.";
        }
        
        if($building->CityID == 0){
            return "Vous devez choisir la ville.";
        }
        
        if($building->RegionID == 0){
            return "Vous devez choisir la région.";
        }
        
        if($building->StreetType == ""){
            return "Vous devez choisir le type d'artère.";
        }
        
        if($building->StreetName == ""){
            return "Vous devez choisir le nom de l'artère.";
        }
        
        if($building->HouseNumber == ""){
            return "Vous devez choisir le # de résidence.";
        }
        
        if($building->Postal_code == ""){
            return "Vous devez choisir le code postal.";
        }
    }
    
    public static function GetForfaitName($id, $lang){
        $result = "";
        
        if($lang == 'FR') {
            $result = BuildingPackage::where('id', $id)->pluck('NameFR');
        }else{
            $result = BuildingPackage::where('id', $id)->pluck('NameEN');
        }
        
        return $result;
    }
    
    public static function GetRoomName($id, $lang){
        $result = "";
        
        if($lang == 'FR') {
            $result .= " " . BuildingChoice::where('GroupID', 'PIECE_CODE')->where('ID', $id)->pluck('Value_FR');
        }else{
            $result .= " " . BuildingChoice::where('GroupID', 'PIECE_CODE')->where('ID', $id)->pluck('Value_EN');
        }
        
        return Helper::truncate_by_char($result,15);
    }
    
    public static function GetRoomFloorName($id, $lang){
        $result = "";
        
        if($lang == 'FR') {
            $result .= " " . BuildingChoice::where('GroupID', 'COUVRE_PLANCHER_CODE')->where('ID', $id)->pluck('Value_FR');
        }else{
            $result .= " " . BuildingChoice::where('GroupID', 'COUVRE_PLANCHER_CODE')->where('ID', $id)->pluck('Value_EN');
        }
        
        return Helper::truncate_by_char($result,8);
    }
    
    public static function GetRoomLevelName($id, $lang){
        $result = "";
        
        if($lang == 'FR') {
            $result .= " " . BuildingChoice::where('GroupID', 'ETAGE')->where('ID', $id)->pluck('Value_FR');
        }else{
            $result .= " " . BuildingChoice::where('GroupID', 'ETAGE')->where('ID', $id)->pluck('Value_EN');
        }
        
        return $result;
    }
    
    public static function GetBuildingInclusions($BuildingID, $lang){
        $result = "";
        
        $inclusions = BuildingInclusion::where('BuildingID', $BuildingID)->get();
        
        for ($i = 0; $i < count($inclusions); $i++)
        {
            if($lang == 'FR') {
                $result .= " " . BuildingInclusionExclusion::where('ID', $inclusions[$i]->Inclusion)->pluck('Value_FR') . ",";
            }else{
                $result .= " " . BuildingInclusionExclusion::where('ID', $inclusions[$i]->Inclusion)->pluck('Value_EN') . ",";
            }
        }
        
        return rtrim($result, ",");
    }
    
    public static function GetBuildingExclusions($BuildingID, $lang){
        $result = "";
        
        $exclusions = BuildingExclusion::where('BuildingID', $BuildingID)->get();
        
        for ($i = 0; $i < count($exclusions); $i++)
        {
            if($lang == 'FR') {
                $result .= " " . BuildingInclusionExclusion::where('ID', $exclusions[$i]->Exclusion)->pluck('Value_FR') . ",";
            }else{
                $result .= " " . BuildingInclusionExclusion::where('ID', $exclusions[$i]->Exclusion)->pluck('Value_EN') . ",";
            }
        }
        
        return rtrim($result, ",");
    }
    
    public static function GetLanguagePath($lang, $currentlanguage)
    {
        $path = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";;
        
        $path = str_replace("/" . $currentlanguage . "/","/" . $lang. "/",$path);
        
        if(strpos($path, $lang) == false)
        {
            $path = url($lang);
        }
        
        return $path;
    }
    
    public static function GetBuildingPrecision($PrecisionID, $lang){
        if($lang == 'FR') {
            $type = BuildingPrecision::where('id',$PrecisionID)->pluck('NameFR');
        }else{
            $type = BuildingPrecision::where('id',$PrecisionID)->pluck('NameEN');
        }
        return $type;
    }
    
    /**
     * 
     * @param type $address
     * @return type
     * @author kundan roy
     * Method Retrive all lat lng
     *  
     */
    public  function  get_all_lat_long($address='') {
        if(isset($_COOKIE['UserLanguage']))
        {
            $lang= $_COOKIE['UserLanguage'];
        }else{
            $lang= "FR";
        }
        
        $html='';
       
       // die;
       // echo "<pre>";
       // print_r($address);
       // die;
      //dd($address);
        $obj= []; 
        foreach ($address as $key => $result)
        {    
            $address =  $result['HouseNumber'].' '.$result['StreetName'].' '.$result['City_Name'].' '.$result['Postal_code'];                    
//            echo $result['id']." ".$result['Latitude']." ". $result['Longitude'];
            if(!empty($_REQUEST['id']))
            {
                $icon = ($result['id'] == $_REQUEST['id'])?asset('website/images/map_icon/icone_affiche.png'):asset('website/images/map_icon/icone_affiche_other.png');    
            }
            else
            {
                $icon = asset('website/images/map_icon/icone_affiche.png');    
            }
            
            
            if(empty($result['Latitude']) or empty($result['Longitude']))
            {        
                $jsondata = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) .'&sensor=false'); 
                $obj[] = json_decode($jsondata,TRUE); 
                $add[] = $address;
             }
             else
             { 

                $html.="<div class='col-sm-6 house-map-img'><a target='_blank' href='".url($lang.'/propriete?id='.$result->id)."' ><img src='".asset('uploads/building/' . $result->id . '/'.$result->Default_Picture)."'></a></div>";
                $html.="<div class='col-sm-6 map-infos'>";
				$html.="<h4>". number_format($result->Price, 0, ',', ' ') ."$</h4>";
				$html.="<a target='_blank' href='".url($lang.'/propriete?id='.$result->id) . "' class='toplink'>".Helper::GetBuildingType($result->TypeID,$lang)." ". Lang::get('website-lang.to_sell')."</a>";
				$html.="<p>".Helper::GetCityName($result->CityID);
				$html.="<br>";
				$html.=$result->HouseNumber . ' ' . $result->StreetName . ', ';
				$html.="<br>";
				$html.=strtoupper($result->Postal_code);
				$html.="</p>";
				$html.="</div>";
				$html.="<div class='col-sm-12 map-desc'>";
				if($lang=='EN')
				$html.= Helper::truncate($result->Description_en, 145);
				else
				$html.= Helper::truncate($result->Description_fr, 145); 
				$html.="<a class='read-button' target='_blank' href='".url($lang.'/propriete?id='.$result->id)."'> ".Lang::get('website-lang.read_more')." <i class=.fa fa-caret-right'></i></a>";
				$html.="</div>"; 
                $latlong[]=array('lat'=>$result['Latitude'],'lng'=>$result['Longitude'],'address'=>$address,'html'=>$html,'icon'=>$icon);
                $html="";
             }
            
        }         
        if(!empty($obj))
        {
            foreach ($obj as $key => $result)
            {   
                $html="";
                if(!empty($result['results'][0]))
                {
                    if(!empty($_REQUEST['id']))
                    {
                        $icon = ($result['id'] == $_REQUEST['id'])?asset('website/images/map_icon/icone_affiche.png'):asset('website/images/map_icon/icone_affiche_other.png');    
                    }
                    else
                    {
                        $icon = asset('website/images/map_icon/icone_affiche.png');    
                    }
                    $html.="<img src='".asset('uploads/building/' . $result->id . '/'.$result->Default_Picture)."' width='100px' height='100px'>";
                    $html.="<br>";
                    $html.="<a href='".'/propriete?id='.$result->id."' class='toplink'>".Helper::GetBuildingType($result->TypeID,$lang)." ". Lang::get('website-lang.to_sell')."-". number_format($result->Price, 0, ',', ' ') ."$</a>";
                    if($lang=='EN')
                    $html.="<br>".$result->Description_en;
                    else
                    $html.="<br>".$result->Description_fr;
                    $arr[] = array('lat'=>$result['results'][0]['geometry']['location']['lat'],'lng'=>$result['results'][0]['geometry']['location']['lng'],'address'=>$add[$key],'html'=>$html,'icon'=>$icon);                      
                }
            }
        }         
        if(empty($arr))
        {
            $arr=array();
        }
        if(empty($latlong))
        {
            $latlong=array();
        }     
        
        $arr=array_merge($arr,$latlong);        
        return json_encode($arr); 
    }
    /**
     *  Mail 
     */
    public static function sendMailFrontEnd($email_content, $template, $template_content){        
        //print_r($email_content['content']);die;    
           
        return  Mail::send('emails.'.$template, array('content' => $template_content), function($message) use($email_content)
          {
              $name= "Immoclic";
           // $message->from(Config::get('app.from_email'), Config::get('app.from_name'));
            $message->from('message@immo-clic.ca','Immoclic');  
            $message->to($email_content['receipent_email'])->subject($email_content['subject']);
            //$message->cc('info@immo-clic.ca', $name = null);
          });
 
    }

    public static function sendIPNMail($email_content, $template, $template_content){        
        //print_r($email_content['content']);die; 
        return  Mail::send($template, array('paypalResponse' => $template_content), function($message) use($email_content)
          {
              $name= "Immoclic";
           // $message->from(Config::get('app.from_email'), Config::get('app.from_name'));
            $message->from('message@immo-clic.ca','Immoclic');  
            $message->to($email_content['receipent_email'])->subject($email_content['subject']);
            //$message->cc('info@immo-clic.ca', $name = null);
          }); 
    }
    
    public static function CheckIfBrokerIsAlreadySelectedForBuilding($transactionID){
        
        $selectedbroker = Transaction::where('id',$transactionID)->pluck('CourtierID');
        
        if($selectedbroker == null){
            return true;
        }else{
            return false;
        }
    }
    
    public function getLanguage($lang =null)
    {  
        $cookie_val = isset($_COOKIE['UserLanguage'])?$_COOKIE['UserLanguage']:'FR';
        $language='';
        if($lang!=null && ($cookie_val=='' || $cookie_val!='')){
            $cookie_value = $lang; 
            setcookie('UserLanguage', $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1  
           $language = $lang;
        }
        else{
            if ($lang==null) {

                if(($cookie_val=='EN' || $cookie_val=='FR')){  
                    $language = $cookie_val;
                }else{

                    $lang = 'FR'; 
                    $cookie_name  = 'UserLanguage'; 
                    setcookie($cookie_name, $lang, time() + (86400 * 30), "/"); // 86400 = 1
                    $language =  $lang;
                } 
            }
        }    
       // print_r($_COOKIE);
        return  $language;
    }

    public function paypalConfig()
    {

        $gateway = Omnipay::create('PayPal_Pro');
        $gateway->setUsername( 'kundan.r-facilitator-2_api1.cisinlabs.com' );
        $gateway->setPassword( 'MSQS653H9A4QS7FB' );
        $gateway->setSignature( 'ABr3Vod5oMAm7SisuCYQGg59mo7fAexp9AJrWOgeSGOQrSWc4RLWIDfr' );
        $gateway->setTestMode( true );

        //$gateway = Omnipay::create('PayPal_Pro');
        //$gateway->setUsername('info_api1.immo-clic.ca');
        //$gateway->setPassword('2SQYW8UGURWSDGGM');
        //$gateway->setSignature('AYz7BNjNgcIFwX1-eo77gMUl1HfIAbyeLdnu2-dzqXZH7ziExWLfiJwv');
        //$gateway->setTestMode( true );

        return $gateway;
    } 
    // SEND SMS 
    public static function immoclic_create_sms($phone,$message)
    {   
        $twilio = new Twilio("AC00a8ac33e2cab49db6023230a520a630", "7c611afd4f4fba94e2ce675d39c569b9", "581-701-4278"); 
        $sms_sent = $twilio->message($phone, $message); 
        if($sms_sent)
        {
            return true;
        }else{
            return false;
        }
        
    } 

    // Create Call 
    public static function immoclic_create_call($phone,$voice_message)
    {   
        $twilio = new Twilio("AC00a8ac33e2cab49db6023230a520a630", "7c611afd4f4fba94e2ce675d39c569b9", "581-701-4278"); 
 
        $make_call = $twilio->call($phone, function ($message) {
            $message->say('hello');
            $message->play('https://api.twilio.com/cowbell.mp3', ['loop' => 5]);
        }); 
        if($make_call)
        {
            return true;
        }else{
            return false;
        } 
    }   

    public static function formatCellForTwilio($CellNumer){
        $toRemove = array("(", ")", "-", " ");
        $CellNumer = "+1" . str_replace($toRemove, "", $CellNumer);
        return $CellNumer;
    }
}

class CommercantsCat
{
    public $ID = 0;
    public $NameFR = "";
    public $NameEN = "";
    public $Class = "";
    public $Img = "";
    public $CityID = 0;
}
