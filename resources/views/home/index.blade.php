@extends('layouts.master')
@section('content') 
@include('include.search') 

@section('title')| L'immobilier en un seul clic!@stop

@section('description')Immo-clic.ca L'union des 2 mondes, sans commission. Vendez, Achetez, Économisez, Financez et bien plus!@stop

@section('fb-description')Immo-clic.ca L'union des 2 mondes, sans commission. Vendez, Achetez, Économisez, Financez et bien plus!@stop

@section('url'){{URL::to('/')}}@stop

@section('image'){{URL::asset('website/images/facebook-share-logo.jpg')}}@stop
<!--content start-->

<div class="content-box">
    <div class="container">
        <div class="row">
            <!--left start-->
            <div class="col-sm-2 home-menu">
                @include('include.left-menu') 
            </div>
            <!--left end-->
            
            <!--center start-->
            <div class="col-sm-7">
                <!--banner slider start-->
                <div class="banner-slider">
                    
                    <div id="banner-slider" class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="slider-text"><a href="/comment-ca-marche" style="margin-top:130px;margin-left:25px;">{{ Lang::get('website-lang.how_it_works') }}</a></div>
                            <img class="slider-img" src="{{URL::asset('website/images/slider-img.png')}}" alt=""/>                        
                        </div>
                      
                        <div class="item">
                            <div class="slider-text"><a href="/immobilier/financement" target="_blank" style="margin-top:130px;margin-left:25px;">{{ Lang::get('website-lang.know_more') }}</a></div>
                            <img class="slider-img" src="{{URL::asset('website/images/slider_financementhypothecaire.jpg')}}" alt=""/>                        
                        </div>
                    </div>
                    <div class="slider-bottom clear">
                        <div class="blue-box">
                            {{ Lang::get('website-lang.take_advantage_of_our_dealers_discounts') }}
                        </div>
                        <div class="orange-box">
                            {{ Lang::get('website-lang.save') }}
                        </div>
                    </div>
                    
                </div>
                <!--banner slider end-->
                
                <!--featured start-->
                <div class="featured-box">
                    <h2 class="content-title">{{ Lang::get('website-lang.featured_properties') }}</h2><h3 class="content-sub-title">{{ Lang::get('website-lang.houses_Condos_Land_Chalets_Multiplex_for_sale') }} </h3>
                    
                    <div class="clear main-featured-list">
                    @if(count($star_building) > 0)
                        @foreach($star_building as $key => $result)
                        <div class="featured-list">
                            <div class="home-rating"><img src="{{URL::asset('website/images/star.png')}}" alt=""/></div>
                            <a href="{{URL::to($lang.'/propriete?id='.$result->id) }}"><img src="{{ URL::asset('uploads/building/' . $result->id . '/'.$result->Default_Picture)}}" alt=""/></a>
                            <div class="featured-content">
                                <h4 class="featured-title">
                                <span class="orang-text">{{Helper::GetBuildingType($result->TypeID,$lang)}} {{Lang::get('website-lang.to_sell') }}</span> <span class="blue-text">{{ Helper::GetCityName($result->CityID) }}</span> <span class="orang-text">{{ number_format($result->Price, 0, ',', ' ') }} $</span>
                                </h4>
                                @if($lang=='EN')
                                    {{ Helper::truncate($result->Description_en,150) }} 
                                @else
                                    {{ Helper::truncate($result->Description_fr,150) }} 
                                @endif
                            </div>
                            <a href="{{URL::to($lang.'/propriete?id='.$result->id) }}"><button type="button">{{ Lang::get('website-lang.read_more') }}</button></a>
                        </div>
                        @endforeach 
                        @else
                        <div class="featured-list">
                            <div class="home-rating"><img src="{{URL::asset('website/images/star.png')}}" alt=""/></div>
                            <img src="{{URL::asset('website/images/img8.jpg')}}" alt=""/>
                            <div class="featured-content">
                                <h4 class="featured-title">
                                <span class="orang-text">{{ Lang::get('website-lang.semi_detached') }}</span> <span class="blue-text">{{ Lang::get('website-lang.val_des_monts') }}</span> <span class="orang-text">199 900$</span>
                                </h4>
                                    {{ Lang::get('website-lang.building_description') }}
                            </div>
                            <button type="button">{{ Lang::get('website-lang.read_more') }}</button>
                        </div>
                        <div class="featured-list">
                            <div class="home-rating"><img src="{{URL::asset('website/images/star.png')}}" alt=""/></div>
                            <img src="{{URL::asset('website/images/img8.jpg')}}" alt=""/>
                            <div class="featured-content">
                                <h4 class="featured-title">
                                <span class="orang-text">{{ Lang::get('website-lang.semi_detached') }}</span> <span class="blue-text">{{ Lang::get('website-lang.val_des_monts') }}</span> <span class="orang-text">199 900$</span>
                                </h4>
                                    {{ Lang::get('website-lang.building_description') }}
                            </div>
                            <button type="button">{{ Lang::get('website-lang.read_more') }}</button>
                        </div>
                            <div class="featured-list">
                            <div class="home-rating"><img src="{{URL::asset('website/images/star.png')}}" alt=""/></div>
                            <img src="{{URL::asset('website/images/img8.jpg')}}" alt=""/>
                            <div class="featured-content">
                                <h4 class="featured-title">
                                <span class="orang-text">{{ Lang::get('website-lang.semi_detached') }}</span> <span class="blue-text">{{ Lang::get('website-lang.val_des_monts') }}</span> <span class="orang-text">199 900$</span>
                                </h4>
                                    {{ Lang::get('website-lang.building_description') }}
                            </div>
                            <button type="button">{{ Lang::get('website-lang.read_more') }}</button>
                        </div>
                        @endif
                    </div>
                    
                    <div class="all-featured-properties">
                        <a class="btn" onclick="return GetStarHouse();">{{ Lang::get('website-lang.see_all_featured_properties') }}</a>
                    </div>
                    
                </div>         
                <!--featured end-->
                
                <!--property 3 box start-->
                <div class="property-3-box clear">
                    <div class="property-list">
                    <a href="javascript:void(0)" onclick="return GetFreeTourHouse();">
                        <img src="{{URL::asset('website/images/img9.jpg')}}" alt=""/>
                        <div class="property-content">
                            <h4>{{ Lang::get('website-lang.open_houses') }}</h4>
                        </div>
                    </a>
                    </div>
                    <div class="property-list">
                    <a href="javascript:void(0)" onclick="return GetBrandNewHouse();">
                        <img src="{{URL::asset('website/images/img8.jpg')}}" alt=""/>
                        <div class="property-content">
                            <h4>{{ Lang::get('website-lang.new_properties') }}</h4>
                        </div>
                    </a>
                    </div>
                    <div class="property-list">
                    <a href="{{env('phase1')}}/blogue/">
                        <img src="{{URL::asset('website/images/blogue.jpg')}}" alt=""/>
                        <div class="property-content">
							<h4>{{ Lang::get('website-lang.blog') }}</h4>
                        </div>
                    </a>
                    </div>
                </div>
                <!--property 3 box end-->
                          
                <!--Mortgage box-->
                <div class="mortgage-box clear">
                	<h2>{{ Lang::get('website-lang.calculation_of_mortgage_payments') }}</h2>
                	
                    <form>
                    	<div class="mortgage-wrapper">
                            <div class="mortgage-calculation col-sm-6">
                                <label>{{ Lang::get('website-lang.down_payment') }} :</label><input id="downpayment" type="text" name="cash" value="0" /> $
                                <label>{{ Lang::get('website-lang.amount_of_the_loan') }} :</label><input id="loan_amount" type="text" name="loan" value="" /> $
                            </div>
                            
                            <div class="mortgage-calculation col-sm-6">
                                <label>{{ Lang::get('website-lang.interest_rate') }} :</label><input id="interest" type="text" name="interest" value="0" /> %
                                <label>{{ Lang::get('website-lang.amortization') }} :</label>
                                <select name="amortization" id="no_of_year">
                                    <option value="10">10 {{ Lang::get('website-lang.year') }}</option>
                                    <option value="15">15 {{ Lang::get('website-lang.year') }}</option>
                                    <option value="20">20 {{ Lang::get('website-lang.year') }}</option>
                                    <option value="25" selected="selected">25 {{ Lang::get('website-lang.year') }}</option>
                                    <option value="30">30 {{ Lang::get('website-lang.year') }}</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mortgage-total">
                        	<div class="mortgage-btn">                       
                                <input id="emi" type="button" name="calculation" value="{{ Lang::get('website-lang.calculate') }}" onclick="return getEMI();"/>
                                <label>{{ Lang::get('website-lang.monthly') }} :</label><label class="monthly_amt"> 0.00$</label>
                                <span class="emi_error"></span>
                            </div>
                            <div class="mortgage-partner">
                            	
                            </div>
						</div>    
                    </form>
                    
                </div>
                <!--Mortgage box end-->
                                                      
            </div>
            <!--center end-->
            
            <!--right start-->
            <div class="col-sm-3">
                @include('include.rigth-side-bar')
            </div>
            <!--right end-->
        </div>

        <div class="row">
        	<!-- Partners -->
        	<div class="partners-box col-sm-12">
            	
                <h2 class="content-title">Vous aurez sûrement besoin de…</h2>
                           	                             
                {!!Helper::GetCommercantsHtml($CategoryCommercants,"FR","comms-wrapper")!!}                          
            </div>
            <!-- Partners end -->
        </div>    
    </div>
</div>
<!--content end-->
           
@stop