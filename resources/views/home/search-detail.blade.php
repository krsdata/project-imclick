@extends('layouts.master')
@section('content')  
@include('include.createMarker')
@include('include.search')
@if(!empty($building[0]))
    @section('title')| {{Helper::GetBuildingType($building[0]->TypeID,$lang)}} {{Lang::get('website-lang.to_sell') }} {{Helper::GetCityName($building[0]->CityID)}} {{ $building[0]->HouseNumber . ' ' . $building[0]->StreetName . ', ' . $building[0]->Postal_code}}@stop
@endif
@if(!empty($building[0]))
    @section('description'){{Helper::GetCityName($building[0]->CityID)}} - {{$building[0]->Description_fr}}@stop
@endif
@if(!empty($building[0]))
    @section('fb-description'){{Helper::GetCityName($building[0]->CityID)}} - {{$building[0]->Description_fr}}@stop
@endif
@if(!empty($building[0]))
    @section('url'){{URL::to($lang.'/propriete?id='.$building[0]->id)}}@stop
@endif
@if(!empty($building[0]))
    @section('image'){{URL::asset('uploads/building/'.$building[0]->id.'/'.$building[0]->Default_Picture)}}@stop
@endif

<div class="content-box">
    <div class="container">
    @if(!empty($building[0]))
        <div class="row"> 
        
            <!--left start-->
            <div class="col-sm-2 right-col">
                @include('include.left-menu')
                
                <div class="side-box saved-text-box">
                    <h2 class="title-addright">{{ Lang::get('website-lang.map')}}</h2>
                    <div class="sidebar_map">
                        <div class="side_left">
                            <i class="fa fa-map-signs fa-4x"></i>
                        </div>
                        <div class="side_right">
                            <a href="javascript:void(0)" onclick="mapView()">{{ Lang::get('website-lang.see_the_map')}}</a>
                        </div>
                    </div>
                </div>
                
            </div>
            <!--left end-->
                
            <!--center start-->
            <div class="col-sm-7"> 
                <div class="tab-box"> 
                    <div class="boxinfo">
                        <div class="graybk"><a href="#" onclick="window.history.back();" class="graylink">{{ Lang::get('website-lang.back_to_search_results') }}</a></div>
                    </div>
                    <h3>{{Helper::GetBuildingType($building[0]->TypeID,$lang)}} 
                    
                    @if($building[0]->status != 3)
                    {{Lang::get('website-lang.to_sell') }} 
                    @else
                    <span style="color:Red;">Vendu</span>
                    @endif
                    
                    {{Helper::GetCityName($building[0]->CityID)}}@if($building[0]->precisionID != 0),@endif <span class="precisions">{{Helper::GetBuildingPrecision($building[0]->precisionID,$lang)}}</span><br /><span class="price">{{ number_format($building[0]->Price, 0, ',', ' ') }} $</span></h3>
    
                    <h4 class="property-infos">#{{sprintf('%08d', $building[0]->id)}} | {{ $building[0]->HouseNumber . ' ' . $building[0]->StreetName . ', ' . $building[0]->Postal_code}}</h4>
                    
                    <!-- Nav tabs -->
                    <ul role="tablist" class="nav nav-tabs">
                        <li class="active" 		id="detail_view" role="presentation"><a data-toggle="tab" role="tab" aria-controls="description" href="#description" aria-expanded="true"><i class="fa fa-list"></i> {{ Lang::get('website-lang.description') }} </a></li>
                        <li role="presentation" id="mapView" onclick="mapView()"  class=""><a data-toggle="tab" role="tab" aria-controls="carte" href="#carte" aria-expanded="false"><i class="fa fa-map-marker"></i> {{ Lang::get('website-lang.map') }}</a></li>
                        <li role="presentation" id="buy" class=""><a data-toggle="tab" role="tab" aria-controls="acheter" href="#acheter" aria-expanded="false">{{ Lang::get('website-lang.buying-guid') }}</a></li>
                    </ul>
                    
                    <div class="fb-share"><div class="fb-share-button" data-href="{{URL::to($lang.'/propriete?id='.$building[0]->id)}}" data-layout="icon_link"></div></div>
                    
                    <!-- Tab panes -->
                    <div class="tab-content">
                    
                        <div id="description" class="tab-pane active" role="tabpanel">
                            
                            <!-- Gallery -->
                            <div class="gallery-box">

                            <?php  
                           
                            
                            $street_name=$building[0]->StreetName;
                            $house_number=$building[0]->HouseNumber;
                            $city_name=$building[0]->City_Name;
                            $postal=$building[0]->Postal_code;
                            $street_name=empty($street_name)?'':$street_name;
                            $house_number=empty($house_number)?'':$house_number;
                            $city_name=empty($city_name)?'':$city_name;
                            $postal=empty($postal)?'':$postal;

                           
                            
                            $latLng = $helper->get_lat_long($street_name.' '.$house_number.' '.$city_name.' '.$postal) ;
                            $inclusions = $helper->GetBuildingInclusions($building[0]->id, $lang);
                            $exclusions = $helper->GetBuildingExclusions($building[0]->id, $lang);
                            
                            $superficie = "?";
                            $parking = "?";
                            $Built_in = "?";
                            
                            if($building[0]->Living_area_size_feet != "" && $building[0]->Living_area_size_feet != 0){ 
                                $superficie = $building[0]->Living_area_size_feet;
                            }
                            
                            if($building[0]->Built_in != "" && $building[0]->Built_in != 0){ 
                                $Built_in = $building[0]->Built_in;
                            }
                            
                            if($building[0]->Parking_outdoor_number + $building[0]->Parking_garage_number != 0)
                            {
                                $parking = $building[0]->Parking_outdoor_number + $building[0]->Parking_garage_number;
                            }

                             ?>

                             <input type="hidden" name="lat" value="{{$latLng['lat']}}">
                             <input type="hidden" name="lat" value="{{$latLng['lng']}}">
                                <div class="eagle-gallery img400">
                                
                                     @if(isset($images[0]) && count($images)>0)   
                                	<div class="arrows-box">
                                        <div class="left-arrow" index="0" style="display:none;" max-index="{{count($images) - 1}}"><i class="fa fa-chevron-left"></i>
                                        </div>
                                        <div class="right-arrow" style="display:none;" index="0" max-index="{{count($images) - 1}}"><i class="fa fa-chevron-right"></i>
                                        </div>
                                    </div>
                                    	<div class="room-desc-box">
                                            <div class="room-desc" style="display:none;">
                                        
                                                @if($lang=='FR') {{ $images[0]->Value_FR }} @else {{ $images[0]->Value_EN }} 
                                                @endif
                                       
                                            </div>
                                        </div>
                                     @endif    
                                    <div class="owl-carousel">
                                    @if(count($images)>0)
                                        @for ($i = 0; $i < count($images); $i++)
                                        @if(!empty($building[0]))
                                            <img class="img_elements" src="{{ URL::asset('uploads/building/'.$building[0]->id.'/'.$images[$i]->File_name)}}" index="{{$i}}" data-medium-img="{{ URL::asset('uploads/building/'.$building[0]->id.'/'.$images[$i]->File_name)}}" data-big-img="{{ URL::asset('uploads/building/'.$building[0]->id.'/'.$images[$i]->File_name)}}" data-title="@if($lang=='FR') {{$images[$i]->Value_FR}} @else {{$images[$i]->Value_EN}} @endif" alt="">
                                            @endif
                                        @endfor
                                    @endif    
                                    </div>
                                </div>

                            </div>
							<!-- Gallery end -->
                            
                            <!-- Property description and broker -->
                            <div class="boxinfo">
                                @if($building[0]->CentrisID == 0)
                                <div class="row"> 
                                    <div class="col-md-7"> 
                                        <div class="headertop clearfix">
                                            <h4>{{ Lang::get('website-lang.property_description') }}</h4>
                                        </div>
                                        <div class="explore_detail">
                                            <p class="infopara">  {{ $lang=='FR'?$building[0]->Description_fr:$building[0]->Description_en }}  </p>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="headertop clearfix">
                                            	<h4>{{ Lang::get('website-lang.contact_the_owner')}}</h4>
                                        </div>
                                        <div class="explore_detail">
                                            <p class="infopara"> <b>{{ Lang::get('website-lang.Phone')}} :</b> {{ Helper::FormatPhoneNumber($building[0]->user['Phone'])	}} </p>
                                            <p class="infopara"> <b>{{ Lang::get('website-lang.Cell')}} :</b> {{ Helper::FormatPhoneNumber($building[0]->user['Cell'])	}}</p>
                                            <p class="infopara"> <b>{{ Lang::get('website-lang.email')}} :</b> {{ $building[0]->user['email']	}}</p>
                                        </div>
                                    </div>
                                </div>            
                                @else
                                <div class="row"> 
                                    <div class="col-md-7"> 
                                        <div class="headertop clearfix">
                                            <h4>{{ Lang::get('website-lang.property_description') }}</h4>
                                        </div>
                                        <div class="explore_detail">
                                            <p class="infopara">  {{ isset($lang)?$building[0]->Description_en:$building[0]->Description_fr }}  </p>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="headertop clearfix">
                                            <h4>{{ Lang::get('website-lang.contact_the_broker')}}</h4>
                                        </div>
                                        <div class="row"> 
                                            <div class="col-xs-6"> 
                                                <p class="space_txt" style="font-size:13px;"><strong>{{ $building[0]->Broker_Full_Name	}}</strong> </p>
                                                <p class="space_txt" style="font-size:13px;"><strong>{{ $building[0]->Broker_Banner	}}</strong> </p>
                                                <p class="space_txt" style="font-size:13px;"><strong>{{ Lang::get('website-lang.Phone')}} : </strong> <br />{{ Helper::FormatPhoneNumber($building[0]->Broker_Phone)	}} </p>
                                                <p id="brokerCell" class="space_txt" style="font-size:13px;" cell="{{$building[0]->Broker_Cell}}"><strong> {{ Lang::get('website-lang.Cell')}} : </strong>{{ Helper::FormatPhoneNumber($building[0]->Broker_Cell)	}}</p>
                                            </div>
                                            <div class="col-xs-6 broker-img"> 
                                                <img src="{{ URL::asset('uploads/courtiers/'.$building[0]->Broker_Photo)}}" alt="Courtier" style="margin-bottom:20px;"/>
                                            </div>
                                            <div class="col-sm-12 broker-link">
                                            	<a href="{{ url($lang.'/recherche?courtier='.str_replace('.jpg','',$building[0]->Broker_Photo)) }}">{{ Lang::get('website-lang.See_my_others_properties')}}</a>
                                                
                                                <!-- <a>Voir le deuxième courtier +</a> -->
                                                
                                            </div> 
                                        </div>
                                        @if($building[0]->Broker_Full_Name2 != "")
                                        <div class="row">
                                            <!-- Second Broker -->
                                            <div class="col-xs-6"> 
                                                <p class="space_txt" style="font-size:13px;"><strong>{{ $building[0]->Broker_Full_Name2	}}</strong> </p>
                                                <p class="space_txt" style="font-size:13px;"><strong>{{ $building[0]->Broker_Banner2	}}</strong> </p>
                                                <p class="space_txt" style="font-size:13px;"><strong>{{ Lang::get('website-lang.Phone')}} : </strong> <br />{{ Helper::FormatPhoneNumber($building[0]->Broker_Phone2)	}} </p>
                                                <p id="P1" class="space_txt" style="font-size:13px;" cell="{{$building[0]->Broker_Cell2}}"><strong> {{ Lang::get('website-lang.Cell')}} : </strong>{{ Helper::FormatPhoneNumber($building[0]->Broker_Cell2)	}}</p>
                                            </div>
                                            <div class="col-xs-6 broker-img"> 
                                                <img src="{{ URL::asset('uploads/courtiers/'.$building[0]->Broker_Photo2)}}" alt="Courtier" style="margin-bottom:20px;"/>
                                            </div>
                                            <div class="col-sm-12 broker-link">
                                            	<a href="{{ url($lang.'/recherche?courtier='.str_replace('.jpg','',$building[0]->Broker_Photo2)) }}">{{ Lang::get('website-lang.See_my_others_properties')}}</a>
                                            </div> 
                                        </div>           
                                        @endif
                                    </div>
                                </div>             
                                @endif
                            </div>
							<!-- End property description and broker -->
                            
                            <!-- Start main feature -->
                           	<div class="boxinfo property-feature"> 
                            	<ul class="property-feature-list">
                                	<li><div class="property-feature-box"><img src="{{URL::asset('website/images/icon-pieces.png')}}" alt="Icône total de pièces"/><span class="feature-text">{{ $building[0]->Total_rooms_number }} Pièces</span></div></li>
                                    <li><div class="property-feature-box"><img src="{{URL::asset('website/images/icon-chambres.png')}}" alt="Icône nombre de chambre"/><span class="feature-text">{{ $building[0]->Rooms_number }} Chambres</span></div></li>
                                    <li><div class="property-feature-box"><img src="{{URL::asset('website/images/icon-salle-de-bain.png')}}" alt="Icône nombre de salles de bains"/><span class="feature-text">{{ $building[0]->Bathroom_number }} Salles de bain</span></div></li>
                                    <li><div class="property-feature-box"><img src="{{URL::asset('website/images/icon-stationnements.png')}}" alt="Icône nombre de stationnements"/><span class="feature-text">{{ $parking }} Stationnements</span></div></li>
                                    <li><div class="property-feature-box"><img src="{{URL::asset('website/images/icon-superficie.png')}}" alt="Icône superficie du terrain"/><span class="feature-text">{{$superficie}} pi²</span></div></li>
                                    <li><div class="property-feature-box"><img src="{{URL::asset('website/images/icon-annee-construction.png')}}" alt="Icône année de construction"/><span class="feature-text">Construction {{$Built_in}}</span></div></li>
                                </ul>
                            </div>
                            <!-- End main feature -->
                            
                            <!-- Start accordion box -->
                            <div class="contant-box">
                            
                                <!-- Start accordion -->
                                <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
                                    
                                    <!-- Start property indoors -->
                                    <div class="panel panel-default">
                                        <div id="headingOne" role="tab" class="panel-heading">
                                            <h4 class="panel-title">
                                                <a aria-controls="property-indoor" aria-expanded="false" href="#property-indoor" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/icon-interieur.png')}}" atl="Icône Bâtiment et intéreir de la propriété">BÂTIMENT ET INTÉRIEUR DE LA PROPRIÉTÉ<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span></a>
                                            </h4>
                                         </div>
                                         <div aria-labelledby="headingOne" role="tabpanel" class="panel-collapse collapse" id="property-indoor" aria-expanded="false" style="height: 2px;">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                	                    <ul>
                                    	                    <li>
                                                                <p {{($building[0]->indoor_cupboard == "")?'style=display:none;':''}}><strong>                  {{ Lang::get('website-lang.indoor_cupboard')}} :</strong>                    {{ Helper::GetBuildingCharacteristics($building[0]->indoor_cupboard,"ARMO",$lang)}}</p>
                                                                <p {{($building[0]->indoor_cupboard_other == "")?'style=display:none;':''}}><strong>            {{ Lang::get('website-lang.indoor_cupboard_other')}} :</strong>              {{$building[0]->indoor_cupboard_other}}</p>
                                                                <p {{($building[0]->indoor_heating_energy == "")?'style=display:none;':''}}><strong>            {{ Lang::get('website-lang.indoor_heating_energy')}} :</strong>              {{ Helper::GetBuildingCharacteristics($building[0]->indoor_heating_energy,"ENER",$lang)}}</p>
                                                                <p {{($building[0]->indoor_heating_energy_other == "")?'style=display:none;':''}}><strong>      {{ Lang::get('website-lang.indoor_heating_energy_other')}} :</strong>        {{$building[0]->indoor_heating_energy_other}}</p>
                                            
                                                                <p {{($building[0]->indoor_energy_system == "")?'style=display:none;':''}}><strong>             {{ Lang::get('website-lang.indoor_energy_system')}} :</strong>               {{ Helper::GetBuildingCharacteristics($building[0]->indoor_energy_system,"SYEL",$lang)}}</p>
                                                                <p {{($building[0]->indoor_energy_system_other == "")?'style=display:none;':''}}><strong>       {{ Lang::get('website-lang.indoor_energy_system_other')}} :</strong>         {{$building[0]->indoor_energy_system_other}}</p>

                                                                <p {{($building[0]->indoor_basement == "")?'style=display:none;':''}}><strong>                  {{ Lang::get('website-lang.indoor_basement')}} :</strong>                    {{ Helper::GetBuildingCharacteristics($building[0]->indoor_basement,"SS",$lang)}}</p>
                                                                <p {{($building[0]->indoor_basement_other == "")?'style=display:none;':''}}><strong>            {{ Lang::get('website-lang.indoor_basement_other')}} :</strong>              {{$building[0]->indoor_basement_other}}</p>
                                                                <p {{($building[0]->indoor_heating_system == "")?'style=display:none;':''}}><strong>            {{ Lang::get('website-lang.indoor_heating_system')}} :</strong>              {{ Helper::GetBuildingCharacteristics($building[0]->indoor_heating_system,"CHAU",$lang)}}</p>
                                                                <p {{($building[0]->indoor_heating_system_other == "")?'style=display:none;':''}}><strong>      {{ Lang::get('website-lang.indoor_heating_system_other')}} :</strong>        {{$building[0]->indoor_heating_system_other}}</p>
                                            
                                                                <p {{($building[0]->indoor_windows == "")?'style=display:none;':''}}><strong>                   {{ Lang::get('website-lang.indoor_windows')}} :</strong>                     {{ Helper::GetBuildingCharacteristics($building[0]->indoor_windows,"FENE",$lang)}}</p>
                                                                <p {{($building[0]->indoor_windows_other == "")?'style=display:none;':''}}><strong>             {{ Lang::get('website-lang.indoor_windows_other')}} :</strong>               {{$building[0]->indoor_windows_other}}</p>
                                                                <p {{($building[0]->indoor_windows_type == "")?'style=display:none;':''}}><strong>              {{ Lang::get('website-lang.indoor_windows_type')}} :</strong>                {{ Helper::GetBuildingCharacteristics($building[0]->indoor_windows_type,"TFEN",$lang)}}</p>
                                                                <p {{($building[0]->indoor_windows_type_other == "")?'style=display:none;':''}}><strong>        {{ Lang::get('website-lang.indoor_windows_type_other')}} :</strong>          {{$building[0]->indoor_windows_type_other}}</p>
                                            
                                                                <p {{($building[0]->indoor_roofing == "")?'style=display:none;':''}}><strong>                   {{ Lang::get('website-lang.indoor_roofing')}} :</strong>                     {{ Helper::GetBuildingCharacteristics($building[0]->indoor_roofing,"TOIT",$lang)}}</p>
                                                                <p {{($building[0]->indoor_roofing_other == "")?'style=display:none;':''}}><strong>             {{ Lang::get('website-lang.indoor_roofing_other')}} :</strong>               {{$building[0]->indoor_roofing_other}}</p>
                                                                <p {{($building[0]->indoor_equipment_available == "")?'style=display:none;':''}}><strong>       {{ Lang::get('website-lang.indoor_equipment_available')}} :</strong>         {{ Helper::GetBuildingCharacteristics($building[0]->indoor_equipment_available,"EQUI",$lang)}}</p>
                                                                <p {{($building[0]->indoor_equipment_available_other == "")?'style=display:none;':''}}><strong> {{ Lang::get('website-lang.indoor_equipment_available_other')}} :</strong>   {{$building[0]->indoor_equipment_available_other}}</p>
                                                            </li>
                                                        </ul>    
                                                    </div>
                                                 </div>
                                             </div>
                                          </div>
                                       </div>
                                       <!-- End property indoors -->
                                       
                                       <!-- Start property outdoors -->
                                       <div class="panel panel-default">
                                           <div id="headingTwo" role="tab" class="panel-heading">
                                               <h4 class="panel-title">
                                                    <a aria-controls="property-outdoor" aria-expanded="false" href="#property-outdoor" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/icon-exterieur.png')}}" atl="Icône Terrain et extérieur de la propriété">TERRAIN ET EXTÉRIEUR DE LA PROPRIÉTÉ<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span></a>
                                               </h4>
                                            </div>
                                            <div aria-labelledby="headingTwo" role="tabpanel" class="panel-collapse collapse" id="property-outdoor" aria-expanded="false" style="height: 2px;">
                                               <div class="panel-body">
                                                   <div class="row">
                                                       <div class="col-sm-12">
                                	                        <ul>
                                    	                        <li>
                                                                    <p {{($building[0]->Garage==0)?'style=display:none;':''}}><strong>{{ Lang::get('website-lang.Garage')}} :</strong> {{ ($building[0]->Garage==1)?Lang::get('website-lang.yes'):Lang::get('website-lang.no') }}	</p>
                                                                    <p {{($building[0]->Pool==0)?'style=display:none;':''}}><strong>{{ Lang::get('website-lang.Pool')}} :</strong>{{ ($building[0]->Pool==1)?Lang::get('website-lang.yes'):Lang::get('website-lang.no') }}		</p>
                                                                    <p {{($building[0]->No_neighbors_behind==0)?'style=display:none;':''}}><strong>{{ Lang::get('website-lang.no_neighbors_behind')}} :</strong> {{ ($building[0]->No_neighbors_behind==1)?Lang::get('website-lang.yes'):Lang::get('website-lang.no') }} </p>
                                                                    <p {{($building[0]->Parking_outdoor_number==0)?'style=display:none;':''}}><strong>{{ Lang::get('website-lang.Parking_outdoor_number')}} : </strong> {{ $building[0]->Parking_outdoor_number 	}}</p>
                                                                    <p {{($building[0]->Parking_garage_number==0)?'style=display:none;':''}}><strong>{{ Lang::get('website-lang.Parking_garage_number')}} : </strong> {{ $building[0]->Parking_garage_number 	}}</p>

                                                                    <p {{($building[0]->outdoor_driveway == "")?'style=display:none;':''}}><strong>                 {{ Lang::get('website-lang.outdoor_driveway')}} :</strong>                    {{ Helper::GetBuildingCharacteristics($building[0]->outdoor_driveway,"ALLE",$lang)}}</p>
                                                                    <p {{($building[0]->outdoor_driveway_other == "")?'style=display:none;':''}}><strong>           {{ Lang::get('website-lang.outdoor_driveway_other')}} :</strong>              {{$building[0]->outdoor_driveway_other}}</p>
                                                                    <p {{($building[0]->outdoor_water_supply == "")?'style=display:none;':''}}><strong>             {{ Lang::get('website-lang.outdoor_water_supply')}} :</strong>                {{ Helper::GetBuildingCharacteristics($building[0]->outdoor_water_supply,"EAU",$lang)}}</p>
                                                                    <p {{($building[0]->outdoor_water_supply_other == "")?'style=display:none;':''}}><strong>       {{ Lang::get('website-lang.outdoor_water_supply_other')}} :</strong>          {{$building[0]->outdoor_water_supply_other}}</p>

                                                                    <p {{($building[0]->outdoor_siding == "")?'style=display:none;':''}}><strong>                   {{ Lang::get('website-lang.outdoor_siding')}} :</strong>                      {{ Helper::GetBuildingCharacteristics($building[0]->outdoor_siding,"PARE",$lang)}}</p>
                                                                    <p {{($building[0]->outdoor_siding_other == "")?'style=display:none;':''}}><strong>             {{ Lang::get('website-lang.outdoor_siding_other')}} :</strong>                {{$building[0]->outdoor_siding_other}}</p>
                                                                    <p {{($building[0]->outdoor_sewage_system == "")?'style=display:none;':''}}><strong>            {{ Lang::get('website-lang.outdoor_sewage_system')}} :</strong>               {{ Helper::GetBuildingCharacteristics($building[0]->outdoor_sewage_system,"SYEG",$lang)}}</p>
                                                                    <p {{($building[0]->outdoor_sewage_system_other == "")?'style=display:none;':''}}><strong>      {{ Lang::get('website-lang.outdoor_sewage_system_other')}} :</strong>         {{$building[0]->outdoor_sewage_system_other}}</p>

                                                                    <p {{($building[0]->outdoor_landscaping == "")?'style=display:none;':''}}><strong>              {{ Lang::get('website-lang.outdoor_landscaping')}} :</strong>                 {{ Helper::GetBuildingCharacteristics($building[0]->outdoor_landscaping,"AMEN",$lang)}}</p>
                                                                    <p {{($building[0]->outdoor_landscaping_other == "")?'style=display:none;':''}}><strong>        {{ Lang::get('website-lang.outdoor_landscaping_other')}} :</strong>           {{$building[0]->outdoor_landscaping_other}}</p>
                                                                    <p {{($building[0]->outdoor_foundation == "")?'style=display:none;':''}}><strong>               {{ Lang::get('website-lang.outdoor_foundation')}} :</strong>                  {{ Helper::GetBuildingCharacteristics($building[0]->outdoor_foundation,"FOND",$lang)}}</p>
                                                                    <p {{($building[0]->outdoor_foundation_other == "")?'style=display:none;':''}}><strong>         {{ Lang::get('website-lang.outdoor_foundation_other')}} :</strong>            {{$building[0]->outdoor_foundation_other}}</p>

                                                                    <p {{($building[0]->outdoor_topography == "")?'style=display:none;':''}}><strong>               {{ Lang::get('website-lang.outdoor_topography')}} :</strong>                  {{ Helper::GetBuildingCharacteristics($building[0]->outdoor_topography,"TOPO",$lang)}}</p>
                                                                    <p {{($building[0]->outdoor_topography_other == "")?'style=display:none;':''}}><strong>         {{ Lang::get('website-lang.outdoor_topography_other')}} :</strong>            {{$building[0]->outdoor_topography_other}}</p>
                                                                    <p {{($building[0]->outdoor_garage == "")?'style=display:none;':''}}><strong>                   {{ Lang::get('website-lang.outdoor_garage')}} :</strong>                      {{ Helper::GetBuildingCharacteristics($building[0]->outdoor_garage,"GARA",$lang)}}</p>
                                                                    <p {{($building[0]->outdoor_garage_other == "")?'style=display:none;':''}}><strong>             {{ Lang::get('website-lang.outdoor_garage_other')}} :</strong>                {{$building[0]->outdoor_garage_other}}</p>

                                                                    <p {{($building[0]->outdoor_pool == "")?'style=display:none;':''}}><strong>                     {{ Lang::get('website-lang.outdoor_pool')}} :</strong>                        {{ Helper::GetBuildingCharacteristics($building[0]->outdoor_pool,"PISC",$lang)}}</p>
                                                                    <p {{($building[0]->outdoor_pool_other == "")?'style=display:none;':''}}><strong>               {{ Lang::get('website-lang.outdoor_pool_other')}} :</strong>                  {{$building[0]->outdoor_pool_other}}</p>
                                                                    <p {{($building[0]->outdoor_proximity == "")?'style=display:none;':''}}><strong>                {{ Lang::get('website-lang.outdoor_proximity')}} :</strong>                   {{ Helper::GetBuildingCharacteristics($building[0]->outdoor_proximity,"PROX",$lang)}}</p>
                                                                    <p {{($building[0]->outdoor_proximity_other == "")?'style=display:none;':''}}><strong>          {{ Lang::get('website-lang.outdoor_proximity_other')}} :</strong>             {{$building[0]->outdoor_proximity_other}}</p>
                                                                </li>
                                                            </ul>    
                                                       </div>
                                                    </div>
                                                </div>
                                             </div>
                                          </div>
                                          <!-- End property outdoors -->
                                         
                                          <!-- Start dimensions -->
                                          <div class="panel panel-default">
                                             <div id="headingThree" role="tab" class="panel-heading">
                                                  <h4 class="panel-title">
                                                    <a aria-controls="dimensions" aria-expanded="false" href="#dimensions" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/icon-dimensions.png')}}" atl="Icône Dimensions">DIMENSIONS<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span></a>
                                                  </h4>
                                               </div>
                                               <div aria-labelledby="headingThree" role="tabpanel" class="panel-collapse collapse" id="dimensions" aria-expanded="false" style="height: 2px;">
                                                  <div class="panel-body">
                                                      <div class="row">
                                                          <div class="col-sm-12">
                                                            <p {{($building[0]->Living_area_size_feet==0)?'style=display:none;':''}}><strong>{{ Lang::get('website-lang.living_area')}}  :</strong> {{ $building[0]->Living_area_size_feet }} pi² ({{ $building[0]->Living_area_size_meter }} m²)</p>
                                                            <p {{($building[0]->Property_size_feet==0)?'style=display:none;':''}}><strong>{{ Lang::get('website-lang.Property_size_feet')}} :</strong> {{ $building[0]->Property_size_feet }}  pi² ({{ $building[0]->Property_size_meter }} m²)</p>
                                                            <p {{($building[0]->Size_land_area==0)?'style=display:none;':''}}><strong>{{ Lang::get('website-lang.dimensions_of_the_ground')}} :</strong> {{ $building[0]->Size_land_area }} pi² ({{Helper::ConvertFeetToMeter($building[0]->Size_land_area)}} m²)			</p>
                                                          </div>
                                                       </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- End dimensions -->
                                             
                                             <!-- Start room details -->
                                             @if(count($building_rooms) != 0)
                                             <div class="panel panel-default">
                                                <div id="headingFour" role="tab" class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a aria-controls="room-details" aria-expanded="false" href="#room-details" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/icon-details-pieces.png')}}" atl="Icône Détails des pièces">DÉTAILS DES PIÈCES<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span></a>
                                                    </h4>
                                                 </div>
                                                 <div aria-labelledby="headingFour" role="tabpanel" class="panel-collapse collapse" id="room-details" aria-expanded="false" style="height: 2px;">
                                                     <div class="panel-body">
                                                         <div class="row">
                                                             <div class="col-sm-12">
                                                                <div class="boxinfo">
                                                                    <div class="explore_detail">
                                                                        <div class="tbl_scroll">
                                                                            <table class="dimen_tbl">
                                                                                <tbody> 
                                            	                                    <tr>
                                                                                        <th>{{ Lang::get('website-lang.piece') }}</th>
                                                                                        <th>{{ Lang::get('website-lang.level') }}</th>
                                                                                        <th>{{ Lang::get('website-lang.dimensions') }}</th>
                                                                                        <th>{{ Lang::get('website-lang.floor') }}</th>
                                                                                    </tr> 
                                                                                        @for ($i = 0; $i < count($building_rooms); $i++)
                                                                                            <tr>
                                                                                                <td><p>@if($lang=='FR') {{ $building_rooms[$i]->Room_Name_FR }} @else {{ $building_rooms[$i]->Room_Name_EN }} @endif</p></td>
                                                                                                <td><p>@if($lang=='FR') {{ $building_rooms[$i]->Room_Stage_FR }} @else {{ $building_rooms[$i]->Room_Stage_EN }} @endif</p></td>
                                                                                                <td><p>@if($building_rooms[$i]->Dimension != "") {{ $building_rooms[$i]->Dimension }} @else {{ $building_rooms[$i]->Width_X }}p x {{ $building_rooms[$i]->Height_Y }}p @endif</p></td>
                                                                                                <td><p>@if($lang=='FR') {{ $building_rooms[$i]->Floor_Name_FR }} @else {{ $building_rooms[$i]->Floor_Name_EN }} @endif</p></td>
                                                                                            </tr> 
                                                                                        @endfor

                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             @endif 
                                             <!-- End room details -->
                                             
                                             <!-- Start incomes area -->
                                            @if(count($rents) != 0)
                                             <div class="panel panel-default">
                                                <div id="headingFive" role="tab" class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a aria-controls="incomes-area" aria-expanded="false" href="#incomes-area" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/icon-espace-revenus.png')}}" atl="Icône Espaces à revenus">ESPACES À REVENUS<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span></a>
                                                    </h4>
                                                 </div>
                                                 <div aria-labelledby="headingFive" role="tabpanel" class="panel-collapse collapse" id="incomes-area" aria-expanded="false" style="height: 2px;">
                                                     <div class="panel-body">
                                                         <div class="row">
                                                             <div class="col-sm-12">
                                                                <div class="explore_detail">
                                                                    <div class="tbl_scroll">
                                                                        <table class="dimen_tbl">
                                                                            <tbody> 
                                            	                                <tr>
                                                                                    <th>{{ Lang::get('website-lang.type') }}</th>
                                                                                    <th>{{ Lang::get('website-lang.price') }}</th>
                                                                                    <th>{{ Lang::get('website-lang.already_rent') }}</th>
                                                                                </tr> 
                                                                                @for ($i = 0; $i < count($rents); $i++)
                                                                                    <tr>
                                                                                        <td><p>@if($lang=='FR') {{ $rents[$i]->Value_FR }} @else {{ $rents[$i]->Value_EN }} @endif</p></td>
                                                                                        <td><p>{{ $rents[$i]->price_by_month }}</p></td>
                                                                                        <td><p>@if($rents[$i]->already_rent == 0) {{ Lang::get('website-lang.no') }} @else {{ Lang::get('website-lang.yes') }} @endif</p></td>
                                                                                    </tr> 
                                                                                @endfor
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                            @endif
                                             <!-- End incomes area -->
                                             
                                             <!-- Start inclusion exclusion -->
                                             <div class="panel panel-default">
                                                <div id="headingSix" role="tab" class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a aria-controls="inclusion-exclusion" aria-expanded="false" href="#inclusion-exclusion" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/icon-inclusions-exclusions.png')}}" atl="Icône inclusions et exclusions">INCLUSIONS ET EXCLUSIONS<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span></a>
                                                    </h4>
                                                 </div>
                                                 <div aria-labelledby="headingSix" role="tabpanel" class="panel-collapse collapse" id="inclusion-exclusion" aria-expanded="false" style="height: 2px;">
                                                     <div class="panel-body">
                                                         <div class="row">
                                                             <div class="col-sm-12">
                                                                <div class="exp_left">
                                	                                <ul>
                                    	                                <li>
                                                                            <h3><strong>{{ Lang::get('website-lang.inclusions')}}</strong></h3>
                                                                            <p {{($building[0]->Inclusion_autre == "")?'style=display:none;':''}}>{{ $building[0]->Inclusion_autre}}</p>
                                                                            <p>{{$inclusions}}</p>
                                                                        </li>
                                                                    </ul>                                   
                                                                </div>
                                                                <div class="exp_left">
                                	                                <ul>
                                    	                                <li>
                                                                            <h3><strong>{{ Lang::get('website-lang.exclusions')}}</strong></h3>
                                                                            <p {{($building[0]->Exclusion_autre == "")?'style=display:none;':''}}>{{ $building[0]->Exclusion_autre}}</p>
                                                                            <p>{{$exclusions}}</p>
                                                                        </li>
                                                                    </ul>                               
                                                                </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             <!-- End inclusion exclusion -->
                                             
                                             <!-- Start costs -->
                                             <div class="panel panel-default">
                                                <div id="headingSeven" role="tab" class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a aria-controls="costs" aria-expanded="false" href="#costs" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/icon-couts.png')}}" atl="Icône Coûts mensuels et annuels">COÛTS MENSUELS ET ANNUELS<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span></a>
                                                    </h4>
                                                 </div>
                                                 <div aria-labelledby="headingSeven" role="tabpanel" class="panel-collapse collapse" id="costs" aria-expanded="false" style="height: 2px;">
                                                     <div class="panel-body">
                                                         <div class="row">
                                                             <div class="col-sm-12">
                                                                <div class="explore_detail">
                                                                    <div class="tbl_scroll">
                                                                        <table class="dimen_tbl">
                                                                            <tbody>
                                                                            <tr>
                                                                                <th><p>{{ Lang::get('website-lang.Expenses_summary')}}</p></th>
                                                                                <th><p>{{ Lang::get('website-lang.Monthly')}}</p></th>
                                                                                <th><p>{{ Lang::get('website-lang.Annual')}}</p></th>
                                                                            </tr>
                                                                            <tr {{($building[0]->Municipal_taxes_by_year<=1)?'style=display:none;':''}}>
                                                                                <td><p>{{ Lang::get('website-lang.Municipal_taxes')}}</p></td>
                                                                                <td><p>{{ number_format($building[0]->Municipal_taxes_by_month, 0, ',', ' ') }}$</p></td>
                                                                                <td><p>{{ number_format($building[0]->Municipal_taxes_by_year, 0, ',', ' ') }}$</p></td>
                                                                            </tr>
                                                                            <tr {{($building[0]->School_taxes_by_year<=1)?'style=display:none;':''}}>
                                                                                <td><p>{{ Lang::get('website-lang.School_taxes')}}</p></td>
                                                                                <td><p>{{ number_format($building[0]->School_taxes_by_month, 0, ',', ' ') }}$</p></td>
                                                                                <td><p>{{ number_format($building[0]->School_taxes_by_year, 0, ',', ' ') }}$</p></td>
                                                                            </tr>
                                                                            <tr {{($building[0]->Electricity_by_month<=1)?'style=display:none;':''}}>
                                                                                <td><p>{{ Lang::get('website-lang.Electricity')}}</p></td>
                                                                                <td><p>{{ number_format($building[0]->Electricity_by_month, 0, ',', ' ') }}$</p></td>
                                                                                <td><p>{{ number_format($building[0]->Electricity_by_year, 0, ',', ' ') }}$</p></td>
                                                                            </tr>
                                                                            <tr {{($building[0]->Insurance_by_month==0)?'style=display:none;':''}}>
                                                                                <td><p>{{ Lang::get('website-lang.Insurance')}}</p></td>
                                                                                <td><p>{{ number_format($building[0]->Insurance_by_month, 0, ',', ' ') }}$</p></td>
                                                                                <td><p>{{ number_format($building[0]->Insurance_by_year, 0, ',', ' ') }}$</p></td>
                                                                            </tr>
                                                                            <tr {{($building[0]->Heating_by_month==0)?'style=display:none;':''}}>
                                                                                <td><p>{{ Lang::get('website-lang.Heating')}}</p></td>
                                                                                <td><p>{{ number_format($building[0]->Heating_by_month, 0, ',', ' ') }}$</p></td>
                                                                                <td><p>{{ number_format($building[0]->Heating_by_year, 0, ',', ' ') }}$</p></td>
                                                                            </tr>
                                                                            <tr {{($building[0]->Maintenance_fees_by_month==0)?'style=display:none;':''}}>
                                                                                <td><p>{{ Lang::get('website-lang.Maintenance_fees')}}</p></td>
                                                                                <td><p>{{ number_format($building[0]->Maintenance_fees_by_month, 0, ',', ' ') }}$</p></td>
                                                                                <td><p>{{ number_format($building[0]->Maintenance_fees_by_year, 0, ',', ' ') }}$</p></td>
                                                                            </tr>
                                                                            <tr {{($building[0]->Copropriete_taxes_by_month==0)?'style=display:none;':''}}>
                                                                                <td><p>Frais de copropriété</p></td>
                                                                                <td><p>{{ number_format($building[0]->Copropriete_taxes_by_month, 0, ',', ' ') }}$</p></td>
                                                                                <td><p>{{ number_format($building[0]->Copropriete_taxes_by_year, 0, ',', ' ') }}$</p></td>
                                                                            </tr>
                                                                            <tr {{($building[0]->Other_taxes_by_month==0)?'style=display:none;':''}}>
                                                                                <td><p>{{ Lang::get('website-lang.Other_taxes')}}</p></td>
                                                                                <td><p>{{ number_format($building[0]->Other_taxes_by_month, 0, ',', ' ') }}$</p></td>
                                                                                <td><p>{{ number_format($building[0]->Other_taxes_by_year, 0, ',', ' ') }}$</p></td>
                                                                            </tr>
                                                                            <tr class="total">
                                                                                <td><p>{{ Lang::get('website-lang.total_known_costs')}}</p></td>
                                                                                <td><p>{{ number_format($building[0]->Municipal_taxes_by_month + $building[0]->School_taxes_by_month + $building[0]->Electricity_by_month + $building[0]->Insurance_by_month + $building[0]->Heating_by_month + $building[0]->Maintenance_fees_by_month + $building[0]->Copropriete_taxes_by_month + $building[0]->Other_taxes_by_month, 2, ',', ' ') }} $</p></td>
                                                                                <td><p>{{ number_format($building[0]->Municipal_taxes_by_year + $building[0]->School_taxes_by_year + $building[0]->Electricity_by_year + $building[0]->Insurance_by_year + $building[0]->Heating_by_year + $building[0]->Maintenance_fees_by_year + $building[0]->Copropriete_taxes_by_year + $building[0]->Other_taxes_by_year, 0, ',', ' ') }} $</p></td>
                                                                            </tr>  
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             <!-- End costs -->
                                             
                                             <!-- Start evaluations -->
                                             @if($building[0]->Evaluation_year != "")
                                             <div class="panel panel-default">
                                                <div id="headingEight" role="tab" class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a aria-controls="evaluations" aria-expanded="false" href="#evaluations" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/icon-evaluation.png')}}" atl="Icône Évaluations">ÉVALUATIONS  {{ $building[0]->Evaluation_year }}<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span></a>
                                                    </h4>
                                                 </div>
                                                 <div aria-labelledby="headingEight" role="tabpanel" class="panel-collapse collapse" id="evaluations" aria-expanded="false" style="height: 2px;">
                                                     <div class="panel-body">
                                                          <div class="row">
                                                              <div class="col-sm-12">
                                                                <p {{($building[0]->Evaluation_ground==0)?'style=display:none;':''}}><strong>Terrain :</strong> {{ $building[0]->Evaluation_ground }} $</p>
                                                                <p {{($building[0]->Evaluation_building==0)?'style=display:none;':''}}><strong>Propriété :</strong> {{ $building[0]->Evaluation_building }} $</p>
                                                                <p {{($building[0]->Evaluation_total==0)?'style=display:none;':''}}><strong>Total :</strong> {{ $building[0]->Evaluation_total }} $</p>
                                                              </div>
                                                           </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             @endif
                                             <!-- End evaluations -->
                                             
                                             <!-- Start mortage -->
                                             <div class="panel panel-default">
                                                <div id="headingNine" role="tab" class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a aria-controls="mortgage" aria-expanded="false" href="#mortgage" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/icon-versements-hypothecaires.png')}}" atl="Icône versements hypothécaires">VERSEMENTS HYPOTHÉCAIRES<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span></a>
                                                    </h4>
                                                 </div>
                                                 <div aria-labelledby="headingNine" role="tabpanel" class="panel-collapse collapse" id="mortgage" aria-expanded="false" style="height: 2px;">
                                                     <div class="panel-body">
                                                         <div class="row">
                                                             <div class="col-sm-12">
                                                                <div class="explore_detail">
                                                                    <div class="form_part">
                                                                        <ul class="field_list form_scnd">
                                                                            <li>
                                                                                <label class="field_name">{{ Lang::get('website-lang.down_payment') }} :</label>
                                                                                <div class="text_field">
                                                                                    <input type="text" class="boxone" value="0" name="downpayment" id="downpayment"/>
                                                                                    <span class="sign">$</span>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <label class="field_name">{{ Lang::get('website-lang.amount_of_the_loan') }} :</label>
                                                                                <div class="text_field">
                                                                                    <input type="text" class="boxone" value="{{$building[0]->Price}}" name="loan_amount" id="loan_amount"/>
                                                                                    <span class="sign">$</span>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <label class="field_name">{{ Lang::get('website-lang.interest_rate') }} :</label>
                                                                                <div class="text_field">
                                                                                    <input type="text" class="boxone" value="0" name="interest" id="interest"/>
                                                                                    <span class="sign">%</span>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <label class="field_name">{{ Lang::get('website-lang.amortization') }} :</label>
                                                                                <div class="text_field payments-select">

                                                                                <div class="select-box" style="width:100%">
                                                                                    <select id="no_of_year" placeholder="No of year" name="no_of_year" >
                                                                                        <option value="5">5 {{ Lang::get('website-lang.year') }}</option>
                                                                                        <option value="10">10 {{ Lang::get('website-lang.year') }}</option>
                                                                                        <option value="15">15 {{ Lang::get('website-lang.year') }}</option>
                                                                                        <option value="20">20 {{ Lang::get('website-lang.year') }}</option> 
                                                                                        <option value="25" selected="selected">25 {{ Lang::get('website-lang.year') }}</option>
                                                                                    </select>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <label class="field_name">{{ Lang::get('website-lang.monthly') }} :</label>
                                                                                <div class="text_field">
                                                                                    <p><span   id="monthly_amt" class="monthly_amt">0.00</span>$</p>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                        <span id="emi_error" class="emi_error"></span>
                                                                        <button type="button" class="sidebar_btn emi" id="emi"   onclick="getEMI()">{{ Lang::get('website-lang.calculate') }}</button>
                                                                    </div>
                                                                </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             <!-- End mortgage -->                         
                                </div>   
                                <!-- End accordion -->
                            
                            </div>
                            <!-- End accordion box -->
                            
                            <div class="boxinfo">
                                <p class="gray-infos">Toutes les informations contenues dans cette fiche de propriété à vendre sont fournies par le propriétaire et/ou le courtier immobilier représentant. Immo-Clic ne peut garantir l'exactitude de ces informations et il est de la responsabilité de l’utilisateur de vérifier lesdites informations de façon indépendante.</p>
                            </div>
                            
                            <div class="boxinfo">
                                <div class="graybk"><a href="#" onclick="window.history.back();" class="graylink">{{ Lang::get('website-lang.back_to_search_results') }}</a></div>
                            </div>
                            
                        </div>
						<!-- End description tab -->
                        
                        <!-- Map tab -->
                        <div id="carte" class="tab-pane" role="tabpanel">
                       	 	<div id="map_wrapper">
					    		<div id="map_canvas" class="mapping"></div>
							</div>
                            <div class="boxinfo">
                                <div class="graybk"><a href="javascript:history.back()" class="graylink">{{ Lang::get('website-lang.back_to_search_results') }}</a></div>
                            </div>
                        </div>
						<!-- End map tab -->
                        
                        <!-- Buying guid tab -->
                        <div id="acheter" class="tab-pane" role="tabpanel">
                            <div class="achieve_box">
                                <p>Pour plus d'informations au sujet de l'achat d'une propriété</p>
								<a href="{{ url($lang.'/acheter') }}" class="btn" >Cliquez ici</a>
                            </div>
                            <div class="boxinfo">
                                <div class="graybk"><a href="javascript:history.back()" class="graylink">{{ Lang::get('website-lang.back_to_search_results') }}</a></div>
                            </div>
                        </div>
                        <!-- End buying guid tab -->
                        
                    </div>
                </div>
            </div>
            <!--center end-->
            
            <!--right start-->
            <div class="col-sm-3">                   
                @include('include.rigth-side-bar') 
            </div>
            <!--right end-->
            
            </div>

        </div>   
        @else
        {{ Lang::get('website-lang.record_not_found') }}
        @endif 
    </div>
</div>
 
@stop
