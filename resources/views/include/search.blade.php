<div class="banner-box  parallax">
    <div class="container">
        <h1> {{ Lang::get('website-lang.the_union_of_2_worlds_without_commission') }}</h1>
        <h2> {{ Lang::get('website-lang.sell_buy_save_are_financing_and_more') }}</h2>
        {!! Form::open(array('url' => URL::to($lang.'/recherche'),'method'=>'get'))!!} 
        <div class="search-box" style="display:none;">
            <div class="top-search clear">
                <div class="property-button"> {{ Lang::get('website-lang.find_a_property') }} </div>
                <div class="More-button">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#criteria" aria-expanded="false" aria-controls="criteria">
                        + {{ Lang::get('website-lang.more_criteria') }}
                    </button>
                </div>
            </div> 

            <div class="bottom-search clear">
                <div class="bottom-search-box region-search">
                    <select multiple="multiple" name="region[]" placeholder="{{ Lang::get('website-lang.region') }}" class="SlectBox" id="region">
                    @foreach($regions as $key => $region)
                        @if(!empty($region['Name']))    
                            <option label="{{$region['Name']}}"  value="{{ $region['id'] }}"  @if(isset($region_id) && in_array($region['id'],$region_id)) selected="selected"  @endif>
                                {{ $region['Name'] }}
                            </option> 
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="bottom-search-box citys-search">
                <select multiple="multiple" id="city_region" name="towns[]" placeholder="{{ Lang::get('website-lang.towns') }}" class="SlectBox">
                    @if(!isset($region_id))
                    <option id="selecARegion" disabled="disabled" value="0">{{ Lang::get('website-lang.please_select_a_region') }}</option>
                    @endif
                    @if(isset($region_id) && count($region_id) == 0)
                    <option id="selecARegion" disabled="disabled" value="0">{{ Lang::get('website-lang.please_select_a_region') }}</option>
                    @endif
                    @foreach($cities as $key => $city)
                    @if(isset($city->CityName))
                    <option  value="{{ $city->id }}" @if(isset($Selectedcitys) && in_array($city['id'],$Selectedcitys)) selected="selected"  @endif>
                        {{
                           $city->CityName
                        }}
                    </option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="bottom-search-box">
            <select multiple="multiple" name="pro_subtype[]" placeholder="{{ Lang::get('website-lang.types') }}" class="SlectBox" id="pro_subtype">    
            @foreach($categories as $key => $category)
                <option  value="{{ $category->id }}"  @if(isset($pro_subtype) && in_array($category->id,$pro_subtype)) selected="selected"  @endif>
                    @if($lang=='EN') {{ $category->NameEN }} @else {{ $category->NameFR }} @endif  
                </option> 
            @endforeach      
            </select>
        </div>
    <div class="bottom-search-box">
        <select name="rooms" placeholder="{{ Lang::get('website-lang.rooms') }}" class="SlectBox">
            <option  value="">{{ Lang::get('website-lang.rooms') }}</option>
            <option value="1" @if(isset($room_number) && $room_number==1) {{ 'selected="selected"' }} @endif>1 + {{ Lang::get('website-lang.rooms') }}</option> 
            <option value="2" @if(isset($room_number) && $room_number==2) {{ 'selected="selected"' }} @endif>2 + {{ Lang::get('website-lang.rooms') }}</option> 
            <option value="3" @if(isset($room_number) && $room_number==3) {{ 'selected="selected"' }} @endif>3 + {{ Lang::get('website-lang.rooms') }}</option> 
            <option value="4" @if(isset($room_number) && $room_number==4) {{ 'selected="selected"' }} @endif>4 + {{ Lang::get('website-lang.rooms') }}</option> 
            <option value="5" @if(isset($room_number) && $room_number==5) {{ 'selected="selected"' }} @endif>5 + {{ Lang::get('website-lang.rooms') }}</option> 
        </select>
    </div>
<div class="bottom-search-box ui-slider-box">

    <input type="text" class="price_rang_a" id="amount" name="price_range" readonly style="border:0; font-weight:normal;"/>

    <div id="slider-range"></div>     
</div>
<div class="bottom-search-box"><button type="submit" class="search-button"> {{ Lang::get('website-lang.search') }}     <i class="fa fa-angle-right my_angle"></i></button></div>
</div>
<!--criteria start-->
<div class="collapse" id="criteria">
    <div class="well">

        <div class="row">
            <div class="col-md-4">
                <div class="row criteria-box">
                    <div class="col-xs-12">
                        <select multiple="multiple" name="types[]" placeholder="{{ Lang::get('website-lang.property_subtype') }}" class="SlectBox">
                            @foreach($types as $key => $type)
                                <option  value="{{ $type->id }}" @if(isset($type_id) && in_array($type->id,$type_id)) selected="selected"  @endif>{{  ($lang=='EN')?$type->NameEN:$type->NameFR }}</option> 
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row criteria-box">
                    <div class="col-xs-12">
                        <select multiple="multiple"  name="characteristics[]" placeholder="{{ Lang::get('website-lang.characteristics') }}" class="SlectBox" id="characteristics">
     
                            <option value="Garage" @if(isset($characteristics) && in_array("Garage",$characteristics)) selected="selected"  @endif>{{ Lang::get('website-lang.Garage') }}</option>
                            <option value="Pool" @if(isset($characteristics) && in_array("Pool",$characteristics)) selected="selected"  @endif>{{ Lang::get('website-lang.Pool') }}</option>
                            <option value="Parking_outdoor_number" @if(isset($characteristics) && in_array("Parking_outdoor_number",$characteristics)) selected="selected"  @endif>{{ Lang::get('website-lang.parking_outdoor') }}</option>
                            <option value="Parking_garage_number" @if(isset($characteristics) && in_array("Parking_garage_number",$characteristics)) selected="selected"  @endif>{{ Lang::get('website-lang.parking_garage') }}</option> 
                            <option value="No_neighbors_behind" @if(isset($characteristics) && in_array("No_neighbors_behind",$characteristics)) selected="selected"  @endif>{{ Lang::get('website-lang.no_neighbors_behind') }}</option>          
                                     
                        </select>
                    </div>
                </div>

                <div class="row criteria-box">
                    <div class="col-xs-12">
                        <div class="left-box">
                            <select  name="land_area" placeholder="{{ Lang::get('website-lang.land_area') }}" class="SlectBox" id="land_area">
                                <option value=""></option>
                                <option value="0-1000" @if(isset($land_area) && $land_area=="0-1000") {{ 'selected="selected"' }} @endif>0 {{ Lang::get('website-lang.to') }} 1000</option>
                                <option value="1000-5000" @if(isset($land_area) && $land_area=="1000-5000") {{ 'selected="selected"' }} @endif>1000-5000</option>
                                <option value="5000-999999" @if(isset($land_area) && $land_area=="5000-999999") {{ 'selected="selected"' }} @endif>5000+</option> 
                            </select>
                        </div>
                        <div class="right-box mp-box">
                            <ul>
                                <li><input type="radio" @if(!isset($unit) || $unit != "meter") checked="checked" @endif name="unit" id="Radio1" value="feet"><label>pi<sup>2</sup></label></li>
                                <li><input type="radio" @if(isset($unit) && $unit == "meter") checked="checked" @endif name="unit" id="" value="meter"><label>m<sup>2</sup></label></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="row criteria-box">
                    <div class="col-xs-12">
                        <select  name="bathrooms" placeholder="{{ Lang::get('website-lang.bathrooms') }}" class="SlectBox" id="bathrooms">
                            <option value="">{{ Lang::get('website-lang.bathrooms') }}</option>
                            <option value="1" @if(isset($bathrooms) && $bathrooms==1) {{ 'selected="selected"' }} @endif>1 {{ Lang::get('website-lang.and_more') }}</option>
                            <option value="2" @if(isset($bathrooms) && $bathrooms==2) {{ 'selected="selected"' }} @endif>2 {{ Lang::get('website-lang.and_more') }}</option>
                            <option value="3" @if(isset($bathrooms) && $bathrooms==3) {{ 'selected="selected"' }} @endif>3 {{ Lang::get('website-lang.and_more') }}</option>
                            <option value="4" @if(isset($bathrooms) && $bathrooms==4) {{ 'selected="selected"' }} @endif>4 {{ Lang::get('website-lang.and_more') }}</option>
                        </select>
                    </div>
                </div>

                <div class="row criteria-box">
                    <div class="col-xs-12">
                        <select name="online_since" placeholder="{{ Lang::get('website-lang.online_since') }}" class="SlectBox" id="online_since">
                            <option value="">{{ Lang::get('website-lang.online_since') }}</option>
                            <option value="1" @if(isset($onlineSince) && $onlineSince==1) {{ 'selected="selected"' }} @endif>{{ Lang::get('website-lang.today') }} </option>
                            <option value="7" @if(isset($onlineSince) && $onlineSince==7) {{ 'selected="selected"' }} @endif>7 {{ Lang::get('website-lang.days') }} </option>
                            <option value="15" @if(isset($onlineSince) && $onlineSince==15) {{ 'selected="selected"' }} @endif>15 {{ Lang::get('website-lang.days') }} </option>
                            <option value="30" @if(isset($onlineSince) && $onlineSince==30) {{ 'selected="selected"' }} @endif>30 {{ Lang::get('website-lang.days') }} </option>
                        </select>
                    </div>
                </div>

                <div class="row criteria-box">
                    <div class="col-xs-12">
                        <select name="etat_du_batiment" placeholder="{{ Lang::get('website-lang.etat_du_batiment') }}" class="SlectBox" id="etat_du_batiment">
                            <option value="">{{ Lang::get('website-lang.etat_du_batiment') }}</option>
                            <option value="new" @if(isset($etat_du_batiment) && $etat_du_batiment=="new") {{ 'selected="selected"' }} @endif>{{ Lang::get('website-lang.new') }} </option>
                            <option value="less_5" @if(isset($etat_du_batiment) && $etat_du_batiment=="less_5") {{ 'selected="selected"' }} @endif>{{ Lang::get('website-lang.less_than_five_years') }} </option>
                            <option value="less_10" @if(isset($etat_du_batiment) && $etat_du_batiment=="less_10") {{ 'selected="selected"' }} @endif>{{ Lang::get('website-lang.less_than_ten_years') }} </option>
                            <option value="more_10" @if(isset($etat_du_batiment) && $etat_du_batiment=="more_10") {{ 'selected="selected"' }} @endif>{{ Lang::get('website-lang.more_than_ten_years') }} </option>
                            <option value="100" @if(isset($etat_du_batiment) && $etat_du_batiment=="100") {{ 'selected="selected"' }} @endif>{{ Lang::get('website-lang.centenary') }} </option>
                        </select>
                    </div>
                </div>

            </div>
            
            
            <div class="col-md-4">
            
                <div class="row criteria-box Properties-li">
                    <div class="col-xs-12 criteria-title">{{ Lang::get('website-lang.properties') }}  :</div>
                    <div class="col-xs-12 property-choices">
                        <ul>
                            <li><input type="checkbox" name="chk_prop_free_tour" id="ChkFreeTour" value="Free_tour" @if(isset($Free_tour) && $Free_tour==1) {{ 'checked="checked"' }} @endif /><label>{{ Lang::get('website-lang.free_visits') }}</label></li>
                            <li><input type="checkbox" name="chk_prop_star" id="ChkStar"  value="Star" @if(isset($Star) && $Star==1) {{ 'checked="checked"' }} @endif /><label>{{ Lang::get('website-lang.stars_homes') }}</label></li>
                        </ul>
                    </div>
                </div>
                
                <div class="row criteria-box">
                    <div class="col-xs-12 street-name">
                        <input type="text" id="txtStreetName" name="street_name" value="@if(isset($street_name)){{$street_name}}@endif" placeholder="{{ Lang::get('website-lang.search_by_street_name') }}" />
                        <button class="sidebar_btn" type="submit">{{ Lang::get('website-lang.search') }}</button>
                        <input type="hidden" id="hiddenStreetName" name="hidden_street_name" value="" />
                    </div>
                </div>   
                <select id="ddlOrderSearch" style="display:none;" name="order">
                    <option value="NewDESC" @if(isset($order) && $order=="NewDESC") {{ 'selected="selected"' }} @endif>Plus récente en premier</option>	
                    <option value="NewASC" @if(isset($order) && $order=="NewASC") {{ 'selected="selected"' }} @endif>Moins récente en premier</option>	
                    <option value="PriceASC" @if(isset($order) && $order=="PriceASC") {{ 'selected="selected"' }} @endif>Prix par ordre croissant</option>	
                    <option value="PriceDESC" @if(isset($order) && $order=="PriceDESC") {{ 'selected="selected"' }} @endif>Prix par ordre décroissant</option>		
                </select>            
            
            </div>
            
            
            <div class="col-md-12 well-text">
                <span><a href="{{ url('/')}}">{{ Lang::get('website-lang.reset') }}</a></span>                
            </div>
        </div>

    </div>
</div>
{!! Form::close() !!}
<!--criteria end-->
</div>
</div>
</div>
<!--banner end-->