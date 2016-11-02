<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Immoclick\Admin\Http\Requests\PackageRequest;
use Immoclick\Admin\Models\Group;
use Immoclick\Admin\Models\Package;
use Immoclick\Admin\Models\City;
use Immoclick\Admin\Models\Region;
use Immoclick\Admin\Models\BuildingCategory;
use Immoclick\Admin\Models\BuildingType;
use Immoclick\Admin\Models\Building;
use Immoclick\Admin\Models\AddToFavorite;
use Immoclick\Admin\Models\BuildingPrecision;
use Immoclick\Admin\Models\BuildingInclusionExclusion;
use Immoclick\Admin\Models\BuildingInclusion;
use Immoclick\Admin\Models\BuildingExclusion;
use Immoclick\Admin\Models\Transaction;
use App\User;
use Immoclick\Admin\Models\BuildingChoice;
use Immoclick\Admin\Models\BuildingRoom;
use Immoclick\Admin\Models\BuildingRent;
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
/**
 * Class AdminController
 */
class MyAccountController extends Controller {
    /**
     * @var  Repository
     */

    /**
     *  
     *
     * @return \Illuminate\View\View
     */
    public function __construct(Request $request) {
     //   $this->middleware('auth');
        View::share('viewPage', 'package');
        $this->lang     = $request->segment(1);
        $helper         = new Helper;
        if(strlen($this->lang)==2)
        {
            $this->lang = $helper->getLanguage($this->lang); 
        }else{
            $this->lang = $helper->getLanguage(null); 
        }
        View::share('lang', $this->lang);
        View::share('helper', new Helper);
        //$this->middleware('auth'); 
        $online_since   = Building::where('status', 1)->groupBy('Built_in')->get();
        View::share('online_since', $online_since);
        
    }

    /*
     * Dashboard
     * */
    public function index(User $user, Request $request) {    
        
        $user = Auth::user();
        //Redirect user if not logged in
        if(!isset($user))
        {
            return redirect('/');
        }   
       
        $my_profile = User::find(Auth::user()->UserID);       
        $building   = Building::with(['buildingImage', 'user', 'btype', 'package', 'bcategory', 'city'])->where('UserID', Auth::user()->UserID)->orderBy('id', 'DESC')->get();    
        $max_price  = 1500000;
        $min_price  = 0;
        $types      = Building::with(['btype'])->groupBy('TypeID')->get();
        $types      = BuildingType::all();
        $categories = BuildingCategory::orderBy('NameEN','ASC')->get();
        $cities     = Building::with(['city'])->groupBy('CityID')->get();
        $regions    = City::with(['region'])->groupBy('RegionID')->get();
        $rooms      = Building::where('status', 1)->groupBy('Rooms_number')->get();
        $addtofav  = AddToFavorite::where('UserID', Auth::user()->UserID)->groupBy('BuildingID')->get();
        $fav_building = Building::join('t_building_favorite', 't_building.id', '=', 't_building_favorite.BuildingID')->where('t_building_favorite.UserID', Auth::user()->UserID)->groupBy('t_building_favorite.BuildingID')->get();
        $transactions = Transaction::where("UserID", Auth::user()->UserID)->get();
        
        return view('myaccount.index', compact('my_profile','categories','online_since','region_id', 'rooms', 'building', 'max_price', 'min_price', 'types', 'cities', 'regions', 'helper', 'fav_building', 'transactions'));
    }

    /**
    * Method Register House
    * @ building registration
    */
 

    public function create(Package $package) {  
        $buld_id=input::get('buildingID');      
        $get_register_building=Building::where('UserID',Auth::user()->UserID)->where('id',$buld_id)->get();     
        
        if(empty($get_register_building[0]))
        {
            return Redirect::to('/');
        }        
        $building       = Building::with(['buildingImage', 'user', 'btype', 'package', 'bcategory', 'city'])->get();
        $max_price  = 1500000;
        $min_price  = 0;
        $types          = Building::with(['btype'])->groupBy('TypeID')->get();
        $types          = BuildingType::all();
        $categories     = BuildingCategory::orderBy('id','ASC')->get();
        $cities         = Building::with(['city'])->groupBy('CityID')->get();
        $regions        = Region::select('id','Name')->orderBy('Name','ASC')->get();
        $city           = City::orderBy('CityName','ASC')->get();
        $rooms          = Building::where('status', 1)->groupBy('Rooms_number')->get();
        $region_id      = [];  
        $lang=$this->lang;
        $precision     = BuildingPrecision::orderBy('id','ASC')->get();
        $inclusion_exclusion=BuildingInclusionExclusion::orderBy('Value_FR','ASC')->get();
        $inclusion=BuildingInclusion::where('BuildingID',$buld_id)->get(); 
        $exclusion=BuildingExclusion::where('BuildingID',$buld_id)->get();
        /**************for form 12******************/
        $building_rent=BuildingRent::select()->where('BuildingID',$buld_id)->orderBy('id','DESC')->get();                
        $i=0;
        if(!empty($building_rent))
        {
            foreach ($building_rent as $key => $build) {     
                $data_building_rent[$i]['id1']=$build->id;          
                $data_building_rent[$i]['Type']=$build->Type;
                $data_building_rent[$i]['price_by_month']=$build->price_by_month;
                if($build->already_rent==0)
                {
                    $data_building_rent[$i]['already_rent']=Lang::get('website-lang.no');
                }
                else
                {
                    $data_building_rent[$i]['already_rent']=Lang::get('website-lang.yes');
                }
                $i++;
            }
        }
        else
        {
            $data_building_rent=array();
        }

        $nbun=BuildingChoice::where('GroupID', 'NBUN')->where('ID', '!=', 'AU')->get(); 
        $gara_val_data =  array();       
        foreach ($nbun as $key => $nbun_val) {
          if($lang=="EN")
            {
                $nbun_val_data[$nbun_val->ID]= $nbun_val->Value_EN;
            }
            else{
                $nbun_val_data[$nbun_val->ID]= $nbun_val->Value_FR;
            }            
        }
        /********************for form 11**********************/
        $gara=BuildingChoice::where('GroupID', 'GARA')->where('ID', '!=', 'AU')->get(); 
        $gara_val_data =  array();       
        foreach ($gara as $key => $gara_val) {
          if($lang=="EN")
            {
                $gara_val_data[$gara_val->ID]= $gara_val->Value_EN;
            }
            else{
                $gara_val_data[$gara_val->ID]= $gara_val->Value_FR;
            }            
        }
        $pisc=BuildingChoice::where('GroupID', 'PISC')->where('ID', '!=', 'AU')->get();
        $pisc_val_data = array();        
        foreach ($pisc as $key => $pisc_val) {
          if($lang=="EN")
            {
                $pisc_val_data[$pisc_val->ID]= $pisc_val->Value_EN;
            }
            else{
                $pisc_val_data[$pisc_val->ID]= $pisc_val->Value_FR;
            }            
        }
        $topo=BuildingChoice::where('GroupID', 'TOPO')->where('ID', '!=', 'AU')->get();  
        $topo_val_data =array();      
        foreach ($topo as $key => $topo_val) {
          if($lang=="EN")
            {
                $topo_val_data[$topo_val->ID]= $topo_val->Value_EN;
            }
            else{
                $topo_val_data[$topo_val->ID]= $topo_val->Value_FR;
            }            
        }
        $syeg=BuildingChoice::where('GroupID', 'SYEG')->where('ID', '!=', 'AU')->get(); 
        $syeg_val_data = array();       
        foreach ($syeg as $key => $syeg_val) {
          if($lang=="EN")
            {
                $syeg_val_data[$syeg_val->ID]= $syeg_val->Value_EN;
            }
            else{
                $syeg_val_data[$syeg_val->ID]= $syeg_val->Value_FR;
            }            
        }
        $prox=BuildingChoice::where('GroupID', 'PROX')->where('ID', '!=', 'AU')->get();
        
        $prox_val_data = array();        
        foreach ($prox as $key => $prox_val) {
          if($lang=="EN")
            {
                $prox_val_data[$prox_val->ID]= $prox_val->Value_EN;
            }
            else{
                $prox_val_data[$prox_val->ID]= $prox_val->Value_FR;
            }            
        }
        
        $pare=BuildingChoice::where('GroupID', 'PARE')->where('ID', '!=', 'AU')->get(); 
        $pare_val_data = array();       
        foreach ($pare as $key => $pare_val) {
          if($lang=="EN")
            {
                $pare_val_data[$pare_val->ID]= $pare_val->Value_EN;
            }
            else{
                $pare_val_data[$pare_val->ID]= $pare_val->Value_FR;
            }            
        }
        $fond=BuildingChoice::where('GroupID', 'FOND')->where('ID', '!=', 'AU')->get(); 
        $fond_val_data = array();
        foreach ($fond as $key => $fond_val) {
          if($lang=="EN")
            {
                $fond_val_data[$fond_val->ID]= $fond_val->Value_EN;
            }
            else{
                $fond_val_data[$fond_val->ID]= $fond_val->Value_FR;
            }            
        }
        $eau=BuildingChoice::where('GroupID', 'EAU')->where('ID', '!=', 'AU')->get(); 
        $eau_val_data = array();
        foreach ($eau as $key => $eau_val) {
          if($lang=="EN")
            {
                $eau_val_data[$eau_val->ID]= $eau_val->Value_EN;
            }
            else{
                $eau_val_data[$eau_val->ID]= $eau_val->Value_FR;
            }            
        }
        /********************end form 11**********************/
        /******************for form 10 **************************/
        $armo_val_data=array();
        $armo=BuildingChoice::where('GroupID', 'ARMO')->where('ID', '!=', 'AU')->get();        
        foreach ($armo as $key => $armo_val) {
          if($lang=="EN")
            {
                $armo_val_data[$armo_val->ID]= $armo_val->Value_EN;
            }
            else{
                $armo_val_data[$armo_val->ID]= $armo_val->Value_FR;
            }            
        }  
       $tfen_val_data=array();
       $TFEN=BuildingChoice::where('GroupID', 'TFEN')->where('ID', '!=', 'AU')->get();        
        foreach ($TFEN as $key => $TFEN_val) {
          if($lang=="EN")
            {
                $tfen_val_data[$TFEN_val->ID]= $TFEN_val->Value_EN;
            }
            else{
                $tfen_val_data[$TFEN_val->ID]= $TFEN_val->Value_FR;
            }            
        }       
        $ss_val_data=array();
        $SS=BuildingChoice::where('GroupID', 'SS')->where('ID', '!=', 'AU')->get();        
        foreach ($SS as $key => $ss_val) {
          if($lang=="EN")
            {
                $ss_val_data[$ss_val->ID]= $ss_val->Value_EN;
            }
            else{
                $ss_val_data[$ss_val->ID]= $ss_val->Value_FR;
            }            
        }
        $toit_val_data=array();
        $toit=BuildingChoice::where('GroupID', 'TOIT')->where('ID', '!=', 'AU')->get();        
        foreach ($toit as $key => $toit_val) {
          if($lang=="EN")
            {
                $toit_val_data[$toit_val->ID]= $toit_val->Value_EN;
            }
            else{
                $toit_val_data[$toit_val->ID]= $toit_val->Value_FR;
            }            
        }
        $equi_val_data=array();
        $equi=BuildingChoice::where('GroupID', 'EQUI')->where('ID', '!=', 'AU')->get();        
        foreach ($equi as $key => $equi_val) {
          if($lang=="EN")
            {
                $equi_val_data[$equi_val->ID]= $equi_val->Value_EN;
            }
            else{
                $equi_val_data[$equi_val->ID]= $equi_val->Value_FR;
            }            
        }
        $chau_val_data=array();
        $chau=BuildingChoice::where('GroupID', 'CHAU')->where('ID', '!=', 'AU')->where('ID', '!=', 'AUCN')->get();        
        foreach ($chau as $key => $chau_val) {
          if($lang=="EN")
            {
                $chau_val_data[$chau_val->ID]= $chau_val->Value_EN;
            }
            else{
                $chau_val_data[$chau_val->ID]= $chau_val->Value_FR;
            }            
        }
        $ener_val_data=array();
        $ener=BuildingChoice::where('GroupID', 'ENER')->where('ID', '!=', 'AU')->get();        
        foreach ($ener as $key => $ener_val) {
          if($lang=="EN")
            {
                $ener_val_data[$ener_val->ID]= $ener_val->Value_EN;
            }
            else{
                $ener_val_data[$ener_val->ID]= $ener_val->Value_FR;
            }            
        }
        $syel_val_data=array();
        $syel=BuildingChoice::where('GroupID', 'SYEL')->where('ID', '!=', 'AU')->get();        
        foreach ($syel as $key => $syel_val) {
          if($lang=="EN")
            {
                $syel_val_data[$syel_val->ID]= $syel_val->Value_EN;
            }
            else{
                $syel_val_data[$syel_val->ID]= $syel_val->Value_FR;
            }            
        }
        /******************end form 10 **************************/
        $building_room=BuildingRoom::where('BuildingID',$buld_id)->get();
        $i=0;        
        foreach ($building_room as $key => $room_val) {
            $building_val[$room_val->id][$i]=$room_val->Name;
            $building_val[$room_val->id][$i+1]=$room_val->Stage;
            $building_val[$room_val->id][$i+2]=$room_val->Floor_type;
            $i=0;
        } 
         
        $choice=BuildingChoice::where('GroupID', 'PIECE_CODE')->where('ID', '!=', 'AU')->orderBy('Value_FR','ASC')->get();
        /*****************for PIECE_CODE form 9************************/
        foreach ($choice as $key => $choice_val) {
          if($lang=="EN")
            {
                $choice_piece[$choice_val->ID]= $choice_val->Value_EN;
            }
            else{
                $choice_piece[$choice_val->ID]= $choice_val->Value_FR;
            }            
        }                
        /*****************end PIECE_CODE************************/
        $etage=BuildingChoice::where('GroupID', 'ETAGE')->where('ID', '!=', 'AU')->get();        
        /*****************for ETAGE************************/
        foreach ($etage as $key => $etage_val) {
          if($lang=="EN")
            {
                $etage_val_piece[$etage_val->ID]= $etage_val->Value_EN;
            }
            else{
                $etage_val_piece[$etage_val->ID]= $etage_val->Value_FR;
            }            
        }                
        /*****************end ETAGE************************/  
        $courve=BuildingChoice::where('GroupID', 'COUVRE_PLANCHER_CODE')->get();        
        /*****************for COUVRE_PLANCHER_CODE************************/       
        foreach ($courve as $key => $courve_val) {
          if($lang=="EN")
            {
                $courve_val_piece[$courve_val->ID]= $courve_val->Value_EN;
            }
            else{
                $courve_val_piece[$courve_val->ID]= $courve_val->Value_FR;
            }            
        }               
                
        /*****************end COUVRE_PLANCHER_CODE************************/   
        /**************for inclusion********************/
        foreach ($inclusion as $key => $inc_val) {
            $inclusive[]=$inc_val->Inclusion;
        }
        /***************end inclusion*********/
        /**************for inclusion********************/
        foreach ($exclusion as $key => $exc_val) {
            $exclusive[]=$exc_val->Exclusion;
        }  

        if(!empty($inclusive))
        {
            sort($inclusive);
        }
        else
        {
            $inclusive=array();
        }
        if(!empty($exclusive))
        {
            sort($exclusive);
        }
        else
        {
            $exclusive=array();
        }        
        /***************end inclusion*********/
        
        /***********for inclusion exclusion****************/
        foreach ($inclusion_exclusion as $key => $value) {           
                if($lang=="EN")
                {
                    $inclusion_ex[$value->ID]=$value->Value_EN;
                }
                else
                {
                    $inclusion_ex[$value->ID]=$value->Value_FR;
                }
              }   
        $inclusion_exclusion=$inclusion_ex;
      /***********end inclusion exclusion****************/ 
        $my_profile = User::find(Auth::user()->UserID);         

        if(!empty($get_register_building[0]->RegionID))
        {
            $id=$get_register_building[0]->RegionID;
            $building_city=City::where('RegionID',$id)->orderBy('CityName','ASC')->get();           
        }
        $building_city=empty($building_city)?array():$building_city;
       /***********estate type************/
       $esatte_type['']="Veuillez choisir...";
       foreach ($types as $key => $value) {
          if($lang=="EN")
          {
            $esatte_type[$value->id]=$value->NameEN;
          }
         else
         {
          $esatte_type[$value->id]=$value->NameFR;
         }
       }

       /***********precision type************/
       $precision_type['0']="Veuillez choisir...";
       foreach ($precision as $key => $value) {
          if($lang=="EN")
          {
            $precision_type[$value->id]=$value->NameEN;
          }
         else
         {
          $precision_type[$value->id]=$value->NameFR;
         }
       }

        /***********Sous-types de propriete************/

       $categories_type['']="Veuillez choisir...";
       foreach ($categories as $key => $value) {
          if($lang=="EN")
          {
            $categories_type[$value->id]=$value->NameEN;
          }
         else
         {
          $categories_type[$value->id]=$value->NameFR;
         }
       }

       
       $map=1;
       return view('myaccount.register-house', compact('categories','online_since','region_id', 'rooms', 'building', 'max_price', 'min_price', 'types', 'cities', 'regions', 'helper','esatte_type','precision_type','categories_type','my_profile','map','get_register_building','building_city','buld_id','inclusion_exclusion','inclusive','exclusive','choice_piece','etage_val_piece','courve_val_piece','armo_val_data','tfen_val_data','ss_val_data','toit_val_data','equi_val_data','chau_val_data','ener_val_data','syel_val_data','building_val','gara_val_data','pisc_val_data','topo_val_data','syeg_val_data','prox_val_data','pare_val_data','fond_val_data','eau_val_data','nbun_val_data','data_building_rent'));

    }
    /*
     * Save Group method
     * */
    public function store(UserRequest $request, User $user) {
                 
    }

    /**
    * update register house
    */
    public function save_house(Request $request, Building $building,User $user)
    {    
        $form_num=Input::get('form_num');
        
        if($form_num==2)
        {
            $Phone=Input::get('Phone');
            $Cell=Input::get('Cell');   
            $user::where('UserID', Auth::user()->UserID)->update(['Phone' => $Phone, 'Cell' => $Cell]);            
        }
        
        $buildingID= Input::get('house_id');
        $building = Building::where("id", $buildingID)->where("UserID", Auth::user()->UserID)->first();
        
        //Cancel action if building is not linked to the current user.
        if(!isset($building))
        {
            return null;
            exit();
        }
        
        if($form_num==8)
        {        
        $house_id= Input::get('house_id');
        $inclusion=Input::get('inclusion');
        /**************for inclusion******************/
        $getdata_to_delete=BuildingInclusion::where('BuildingID',$house_id)->get();
            if(!empty($getdata_to_delete))
            {                
                foreach ($getdata_to_delete as $key => $value) {
                    BuildingInclusion::where('id', $value->id)->delete();                    
                }                
            }    
        $getdata_skip=BuildingInclusion::where('BuildingID',$house_id)->get();            
        if(!empty($getdata_skip))
            {                
                foreach ($getdata_skip as $key => $value) {
                    $existed_data[]=$value->Inclusion;
                }                
            }           
            $existed_data=empty($existed_data)?array():$existed_data;
            if(!empty($inclusion))
            {
            foreach ($inclusion as $key => $inc) {               
               if(!in_array($inc, $existed_data))
               {                    
                    BuildingInclusion::create(['BuildingID' => $house_id,'Inclusion'=>$inc]);               
               }
            }
            }   
            /**************end inclusion******************/   
            $exclusion=Input::get('exclusion');

            /**************for exclusion******************/
            $getdata_to_delete=BuildingExclusion::where('BuildingID',$house_id)->get();
            if(!empty($getdata_to_delete))
            {                
                foreach ($getdata_to_delete as $key => $value) {
                    BuildingExclusion::where('id', $value->id)->delete();                    
                }                
            }    
                $getdata_skip=BuildingExclusion::where('BuildingID',$house_id)->get();            
                if(!empty($getdata_skip))
            {                
                foreach ($getdata_skip as $key => $value) {
                    $existed_data1[]=$value->Exclusion;
                }                
            }      
            
            if(empty($existed_data1))
            {
                $existed_data1=array();
            }      
            if(!empty($exclusion))
            {                 
            foreach ($exclusion as $key => $exc) {               
               if(!in_array($exc, $existed_data1))
               {                    
                    BuildingExclusion::create(['BuildingID' => $house_id,'Exclusion'=>$exc]);               
               }
            }
          }
            /**************end exclusion******************/
        }
        if($form_num==1 or $form_num==3 or $form_num==4 or $form_num==5 or $form_num==6 or $form_num==7 or $form_num==8)
        {
            $house_id=input::get('house_id');
            $input = Input::except('_token','form_num','house_id','inclusion','exclusion');      
            $building::where('UserID', Auth::user()->UserID)->where('id',$house_id)
                ->update($input);
        }
        else if($form_num==9)
        {
            $input = Input::except('_token','form_num');             
            $house_id=Input::get('house_id');            
            $list_plench=Input::get('list_plench');
            $list_plench=explode(',',$list_plench);       
            $name1=Input::get('Name');
            $Stage=Input::get('Stage');
            $Width_X=Input::get('Width_X');
            $Width_Pouce=Input::get('Width_Pouce');
            $Height_Y=Input::get('Height_Y');
            $Height_Pouce=Input::get('Height_Pouce');                
            $building_room =new BuildingRoom();
            $building_room->BuildingID=$house_id;
            $building_room->Name=$name1;
            $building_room->Stage=$Stage;
            $building_room->Width_X=$Width_X;
            $building_room->Width_Pouce=$Width_Pouce;
            $building_room->Height_Y=$Height_Y;
            $building_room->Height_Pouce=$Height_Pouce;
            $building_room->Floor_type=Input::get('courve_val');
            $building_room->save();
            echo json_encode($building_room);
                               
        }
        elseif($form_num==10)
        {
            $indoor_cupboard=Input::get('indoor_cupboard'); 
            if(!empty($indoor_cupboard))           
            {
                $data['indoor_cupboard']=implode(',', $indoor_cupboard);       
            }
            else
            {
              $data['indoor_cupboard']='';
            }
            $data['indoor_cupboard_other']=Input::get('indoor_cupboard_other');

            $indoor_windows_type=Input::get('indoor_windows_type');
            if(!empty($indoor_windows_type))           
            {            
                $data['indoor_windows_type']=implode(',', $indoor_windows_type);
            }
            else{
              $data['indoor_windows_type']='';
            } 
            $data['indoor_windows_type_other']=Input::get('indoor_windows_type_other');

            $indoor_basement=Input::get('indoor_basement');
            if(!empty($indoor_basement))           
            {              
                $data['indoor_basement']=implode(',', $indoor_basement);   
            }
            else{
              $data['indoor_basement']='';
            }
            $data['indoor_basement_other']=Input::get('indoor_basement_other');

            $indoor_roofing=Input::get('indoor_roofing');   
            if(!empty($indoor_roofing))           
            {         
                $data['indoor_roofing']=implode(',', $indoor_roofing);
            }
            else
            {
              $data['indoor_roofing']='';
            }
            $data['indoor_roofing_other']=Input::get('indoor_roofing_other');

            $indoor_equipment_available=Input::get('indoor_equipment_available');            
            if(!empty($indoor_equipment_available))           
            {
               $data['indoor_equipment_available']=implode(',', $indoor_equipment_available);
            }
            else
            {
              $data['indoor_equipment_available']='';
            }
            $data['indoor_equipment_available_other']=Input::get('indoor_equipment_available_other');

            $indoor_heating_system=Input::get('indoor_heating_system');            
            if(!empty($indoor_heating_system))           
            {
                $data['indoor_heating_system']=implode(',', $indoor_heating_system);
            }
            else
            {
              $data['indoor_heating_system']='';
            }
            $data['indoor_heating_system_other']=Input::get('indoor_heating_system_other');

            $indoor_heating_energy=Input::get('indoor_heating_energy');    
            if(!empty($indoor_heating_energy))           
            {        
                $data['indoor_heating_energy']=implode(',', $indoor_heating_energy);
            }
            else
            {
               $data['indoor_heating_energy']='';
            }
            $data['indoor_heating_energy_other']=Input::get('indoor_heating_energy_other'); 

            $indoor_energy_system=Input::get('indoor_energy_system');       
            if(!empty($indoor_energy_system))           
            {     
                $data['indoor_energy_system']=implode(',', $indoor_energy_system);
            }
            else{
              $data['indoor_energy_system']='';
            }  
            $data['indoor_energy_system_other']=Input::get('indoor_energy_system_other');           
            $house_id=Input::get('house_id');
            $building::where('UserID', Auth::user()->UserID)->where('id',$house_id)
                ->update($data);
            
        }
        elseif($form_num==11)
        {
            $outdoor_garage=Input::get('outdoor_garage');     

            if(!empty($outdoor_garage))           
            {   
                $data11['outdoor_garage']=implode(',', $outdoor_garage); 
            }  
            else{
              $data11['outdoor_garage']='';
            }    
            $data11['outdoor_garage_other']=Input::get('outdoor_garage_other');

            $outdoor_pool=Input::get('outdoor_pool');          
            if(!empty($outdoor_pool))           
            {  
                $data11['outdoor_pool']=implode(',', $outdoor_pool);       
            }
            else
            {
              $data11['outdoor_pool']='';
            }
            $data11['outdoor_pool_other']=Input::get('outdoor_pool_other');

            $outdoor_topography=Input::get('outdoor_topography');      
            if(!empty($outdoor_topography))           
            {      
                $data11['outdoor_topography']=implode(',', $outdoor_topography);       
            }
            else
            {
              $data11['outdoor_topography']='';
            }
            $data11['outdoor_topography_other']=Input::get('outdoor_topography_other');

            $outdoor_sewage_system=Input::get('outdoor_sewage_system');
            if(!empty($outdoor_sewage_system))           
            {            
                $data11['outdoor_sewage_system']=implode(',', $outdoor_sewage_system);       
            }
            else
            {
              $data11['outdoor_sewage_system']='';
            }
            $data11['outdoor_sewage_system_other']=Input::get('outdoor_sewage_system_other');

            $outdoor_proximity=Input::get('outdoor_proximity');   
            if(!empty($outdoor_proximity))           
            {         
                $data11['outdoor_proximity']=implode(',', $outdoor_proximity);       
            }
            else
            {
              $data11['outdoor_proximity']='';
            }
            $data11['outdoor_proximity_other']=Input::get('outdoor_proximity_other');

            $outdoor_siding=Input::get('outdoor_siding');  
            if(!empty($outdoor_siding))           
            {           
                $data11['outdoor_siding']=implode(',', $outdoor_siding);       
            }
            else
            {
              $data11['outdoor_siding']='';
            }
            $data11['outdoor_siding_other']=Input::get('outdoor_siding_other');

            $outdoor_foundation=Input::get('outdoor_foundation');  
            if(!empty($outdoor_foundation))           
            {           
                $data11['outdoor_foundation']=implode(',', $outdoor_foundation);       
            }
            else
            {
              $data11['outdoor_foundation']='';
            }
            $data11['outdoor_foundation_other']=Input::get('outdoor_foundation_other');

            $outdoor_water_supply=Input::get('outdoor_water_supply');  
            if(!empty($outdoor_water_supply))           
            {          
                $data11['outdoor_water_supply']=implode(',', $outdoor_water_supply);       
            }
            else
            {
              $data11['outdoor_water_supply']='';
            }
            $data11['outdoor_water_supply_other']=Input::get('outdoor_water_supply_other');
            $house_id=Input::get('house_id');
            $building::where('UserID', Auth::user()->UserID)->where('id',$house_id)
                ->update($data11);
        }
        elseif($form_num==12)
        {            
            $id=Input::get('id');
            $lang=$this->lang;
            if($lang=='EN')
            {
                $field="Value_EN";
            }
            else
            {
                $field="Value_FR";
            }
            $nbun=BuildingChoice::select($field)->where('GroupID', 'NBUN')->where('ID',$id)->get(); 
            if($lang=='EN')
            {
                if(!empty($nbun[0]))
                {
                    $Type=$nbun[0]->Value_EN;
                }
            }
            else
            {
                if(!empty($nbun[0]))
                {
                    $Type=$nbun[0]->Value_FR;
                }
            }                 
            $buildingRent =new BuildingRent();
            $buildingRent->BuildingID=Input::get('house_id');            
            $buildingRent->Type=$Type;
            $buildingRent->price_by_month=Input::get('price_by_month');
            $buildingRent->already_rent=Input::get('already_rent');
            $buildingRent->save();            
            $house_id=Input::get('house_id');
            $building_rent=BuildingRent::select()->where('BuildingID',$house_id)->where('id',$buildingRent->id)->orderBy('id','DESC')->get();            
            $i=0;
            foreach ($building_rent as $key => $build) {     
                $data_building_rent[$i]['id1']=$build->id;          
                $data_building_rent[$i]['Type']=$build->Type;
                $data_building_rent[$i]['price_by_month']=$build->price_by_month;
                if($build->already_rent==0)
                {
                    $data_building_rent[$i]['already_rent']=Lang::get('website-lang.no');
                }
                else
                {
                    $data_building_rent[$i]['already_rent']=Lang::get('website-lang.yes');
                }
                $i++;
            }      
            echo json_encode($data_building_rent);
        }
        elseif($form_num==13)
        {
            $house_id = Input::get('house_id');
            $input = Input::except('_token','form_num','house_id');  
            $rs = $building::where('id', $house_id)->where('UserID', Auth::user()->UserID)->update($input);
            return $rs;
        }
    }
    /*
     * Edit  method
     * */
    public function edit(Package $package,$buld_id) {      
        
    }
     /*
     * Update  method
     * */
    public function update(UserRequest $request, User $user) {   

        $data=Input::all(); 
        $userID =  Auth::user()->UserID;
        $user = User::find($userID); 

        $validator =  Validator::make($data, [
               'FirstName'  => 'required',
               'LastName'  => 'required',
               'Phone' => 'required|numeric|min:8', 
               'Cell' => 'required|numeric|min:8',  
               'Adresse' => 'required',
            ]);
            if($validator->fails())
            {                
                return Redirect::to('mon-compte')->withErrors($validator);
            } 
        $user->fill(Input::all());
        $form_input = Input::all();
        $fileName = 'default-user-image.png'; // default user image
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
            $pictureName = Input::get('Picture');
            $fileName = isset($pictureName)?$pictureName:'default-user-image.png';
        } 
        $user->Picture = $fileName; 
        $user->save();
        
        Return Redirect::to(route('mon-compte'))->with('flash_alert_notice_success', '');
    }
    
    /*
     * Close building method
     * */
    public function closeBuilding(Request $request,User $user)
    {
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
        
        $data = Building::find($buildingID);
        $data->status = 3;
        $data->save();
        
        Return Redirect::to(route('mon-compte'));
    }
    
    /*
     * change  password method
     * */
    public function changePassword(Request $request,User $user)
    {

        if ($request->ajax()) {
            $data =  Input::all();                    
            $validator =  Validator::make($data, [
               'old_password'  => 'required|min:6',
               'new_password'  => 'required|min:6|same:confirm_password',
               'confirm_password' => 'required|min:6',               
            ]);
            if($validator->fails())
            {
                $errors = $validator->messages();  
                echo json_encode($errors);
                exit();
            } 
            else
            {
            
                $password = Input::get('old_password');
                if(Hash::check( $password,Auth::user()->password ))
                {
                    $rs =User::where('UserID',Auth::user()->UserID)->update(['password'=>bcrypt(Input::get('new_password'))]);
                    if($rs)
                    {
                        return json_encode(['response'=>'200']); // success
                    }else{
                        return json_encode(['response'=>'300']); // fail
                    }
                }
                else
                {
                    $error['error']="Old Password is not matched.";
                    return json_encode($error);
                }
            } 
        }
    }
     /*
     * destroy  method
     * */
    public function destroy(User $User) {
        
    }
     /*
     * Show  method
     * */
    public function show(User $User) {
        
    }

    /*******get city against of region********/
    public function get_city()
    {
      $id=Input::get('id');
      $city=City::where('RegionID',$id)->get();
      if(!empty($city))
      {
        $i=0;
        foreach ($city as $key => $value) {
          $data[$i]['key']=$value->id;
          $data[$i]['value']=$value->CityName;
          $i++;
        }                
        return json_encode($data);
      }
      return json_encode(array());
    }
    /*
     * Remove faviriot building
     * */
    public function rem_fav(Request $request)
    {
        if ($request->ajax()) {            
            $id=Input::get('id');
            $re=AddToFavorite::where('BuildingID',$id)->where('UserID',Auth::user()->UserID)->delete();
            if($re)
            {
                return json_encode($id);
            }
        }
    }
    /*
     * Remove building _room_id
     * */
    public function del_build_room(Request $request)
    {
        if ($request->ajax()) {            
            $id=Input::get('house_id');
            $re=BuildingRoom::where('id',$id)->delete();
            if($re)
            {
                return json_encode($id);
            }
        }
    }

    public function delete_list(Request $request){
        if ($request->ajax()) {            
            $id=Input::get('id');
            $re=BuildingRent::where('id',$id)->delete();
            if($re)
            {
                return json_encode($id);
            }
        }
    }
    
    public function activatebuilding(Request $request) {

        if ($request->ajax()) {

            $buld_id = Input::get('id');
            $building=Building::where('UserID',Auth::user()->UserID)->where('id',$buld_id)->get()->first();     
            
            if(empty($building))
            {
                echo 'access denied';
                exit();
            } 
            
            $currentDate = date("Y-m-d");
            
            if($building->PackageID == 3)
            {
                \DB::table('t_building')->where('id', $buld_id)->where('UserID', Auth::user()->UserID)->update(['status' => 2, 'Start_Date' => $currentDate]);
            }
            else if($building->PackageID == 2)
            {
                $End_date = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "+6 month" ) );
                \DB::table('t_building')->where('id', $buld_id)->where('UserID', Auth::user()->UserID)->update(['status' => 2, 'Start_Date' => $currentDate, 'End_Date' => $End_date]); 
            }
            else if($building->PackageID == 1)
            {
                $End_date = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "+4 month" ) );
                \DB::table('t_building')->where('id', $buld_id)->where('UserID', Auth::user()->UserID)->update(['status' => 2, 'Start_Date' => $currentDate, 'End_Date' => $End_date]);
            }
            echo 'Votre annonce est maintenant en ligne!';
        } 
        else {
            echo 'access denied';
            exit();
        }
    }
}
