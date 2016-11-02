@extends('layouts.master')
@section('content')  
@include('include.createMarker')
@include('include.search')

@section('title')| {{Lang::get('website-lang.search_title_seo')}}@stop

@section('description'){{Lang::get('website-lang.search_description_seo')}}@stop

@section('fb-description'){{Lang::get('website-lang.search_description_seo')}}@stop

@section('url'){{URL::to($lang.'/recherche')}}@stop

@section('image'){{URL::asset('website/images/default_building.jpg')}}@stop

<!--content start-->
<div class="content-box">
    <div class="container">
        <div class="row"> 
            <!--left start-->
            <div class="col-sm-2">
                @include('include.left-menu')
            </div>
            <!--left end-->

            <!--center start-->
            <div class="col-sm-7 left-col">
                <div class="search-list-box tab-box">
                <input type="hidden" id="is_user_login" value="{{isset(Auth::user()->UserID)?Auth::user()->UserID:''}}">
                	
                    <h4>{{$BuildingCount}} Résultats</h4>
                    
                	<div class="sort-box">
                    	<div class="select-box">
                        	<select id="ddlOrderSearchResult">
                                <option value="NewDESC" @if(isset($order) && $order=="NewDESC") {{ 'selected="selected"' }} @endif>Plus récente en premier</option>	
                                <option value="NewASC" @if(isset($order) && $order=="NewASC") {{ 'selected="selected"' }} @endif>Moins récente en premier</option>	
                            	<option value="PriceASC" @if(isset($order) && $order=="PriceASC") {{ 'selected="selected"' }} @endif>Prix par ordre croissant</option>	
                            	<option value="PriceDESC" @if(isset($order) && $order=="PriceDESC") {{ 'selected="selected"' }} @endif>Prix par ordre décroissant</option>		
                           	</select>                                   
                         </div>
                    </div>
                
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation"  id="detail_view" class="active"><a href="#list" aria-controls="list" role="tab" data-toggle="tab"><i class="fa fa-list"></i> {{ Lang::get('website-lang.House_list') }}</a></li>
                        <li role="presentation" id="mapView" onclick="mapView()"  > <a href="#map" aria-controls="map" role="tab" data-toggle="tab"><i class="fa fa-map-marker"></i> {{ Lang::get('website-lang.map') }}</a></li>
                    </ul>
                    
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="list">
                            @if(count($building)==0) {{Lang::get('website-lang.House_not_found')}}
                            
                            <br />

                            <b>{{Lang::get('website-lang.immo_developing')}}</b>

                             @endif
                            @if($hidden_street_name == "Empty")
                                {{Lang::get('website-lang.bad_request_street_name')}}
                            @else
                                @foreach($building as $key => $result)
                                    @if(!empty($result->Default_Picture))

                                        <div class="search-list clear">
                                            <div class="list-img-box">
                                                <a href="{{URL::to($lang.'/propriete?id='.$result->id) }}">
<!--                                                	<div class="house_label">
                                                    	<span class="sold house_label">
                                                        	vendu!
                                                        </span>
                                                    </div>-->
                                                    <img src="{{ URL::asset('uploads/building/' . $result->id . '/'.$result->Default_Picture)}}" alt="list image"/>
                                                </a>
                                            </div>
                                            <div class="list-content-box">
                                                <div class="list-title-box">
                                                    <h1 class="list-title">
                                                        <a href="{{URL::to($lang.'/propriete?id='.$result->id) }}" class="toplink">{{Helper::GetBuildingType($result->TypeID,$lang)}} {{Lang::get('website-lang.to_sell') }} - {{ number_format($result->Price, 0, ',', ' ') }} $</a>
                                                    </h1>
                                                    <p class="list-address-box"><span><i class="fa fa-map-marker"></i></span> {{ Helper::GetCityName($result->CityID) . ', ' . $result->HouseNumber . ' ' . $result->StreetName . ', ' . strtoupper($result->Postal_code) }} </p>                                                               
                                                    <div class="favourite-box"><a href="javascript:void(0)" onclick="addTofav({{ $result->id }}, this);" ><i class="fa {{(in_array($result->id, $fav_build))?'fa-star':'fa-star-o'}}"></i></a></div>
                                                </div>
                                                <div class="list-description">
                                                    @if($lang=='EN')
                                                    {{ $result->Description_en }}
                                                    @else

                                                    {{ $result->Description_fr }} 

                                                    @endif
                                                    <a class="read-button" href="{{URL::to($lang.'/propriete?id='.$result->id) }}"> {{ Lang::get('website-lang.read_more') }} <i class="fa fa-caret-right"></i></a>

                                                </div> 
                                                <span class="highlight_txt"><i class="fa fa-caret-right"></i>
                                                    <span class="caracterictique" {{ ($result->Total_rooms_number==0)?'style=display:none;':'style=display:inline;'}}>      {{ $result->Total_rooms_number }} {{ Lang::get('website-lang.room') }}, </span>
                                                    <span class="caracterictique" {{ ($result->Rooms_number==0)?'style=display:none;':'style=display:inline;'}}>            {{ $result->Rooms_number }} {{ Lang::get('website-lang.Chambre') }}, </span>
                                                    <span class="caracterictique" {{ ($result->Bathroom_number==0)?'style=display:none;':'style=display:inline;'}}>         {{ $result->Bathroom_number }} {{ Lang::get('website-lang.bathroom') }}, </span>
                                                    <span class="caracterictique" {{ ($result->Living_area_size_feet==0)?'style=display:none;':'style=display:inline;'}}>   {{ Lang::get('website-lang.living_space_area') }}, {{ $result->Living_area_size_feet }} ft<sup>2</sup>, </span>
                                                    <span class="caracterictique" {{ ($result->Parking_outdoor_number==0 && $result->Parking_garage_number==0 )?'style=display:none;':'style=display:inline;'}}>  {{ $result->Parking_outdoor_number + $result->Parking_garage_number }} {{ Lang::get('website-lang.private_outdoor_parking') }}, </span> 
                                                    <span class="caracterictique" {{ ($result->Garage==0)?'style=display:none;':'style=display:inline;'}}> {{ Lang::get('website-lang.Garage') }}, </span> 
                                                    <span class="caracterictique" {{ ($result->Pool==0)?'style=display:none;':'style=display:inline;'}}> {{ Lang::get('website-lang.Pool') }}, </span> 
                                                    <span class="caracterictique" {{ ($result->No_neighbors_behind==0)?'style=display:none;':'style=display:inline;'}}> {{ Lang::get('website-lang.no_neighbors_behind') }}, </span> 
                                                </span>
                                            </div>
                                        </div>
                                @endif
                                @endforeach 
                            @endif
                            {!! $building->render() !!}
                        </div>
                        <div role="tabpanel" class="tab-pane" id="map">
                            <div id="map_wrapper">
                                <div id="map_canvas" class="mapping"></div>
                            </div>
                            <div class="footerMap">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--center end-->

            <!--right end-->
            <div class="col-sm-3">
                @include('include.rigth-side-bar')
            </div>
            <!--right end-->
        </div>    
    </div>
</div>


@stop