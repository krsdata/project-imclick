<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Immo-clic.ca @yield('title')</title> 
        <meta name="description" content="@yield('description')">
        <meta charset="UTF-8"/>
        <meta name="_token" content="{!! csrf_token() !!}"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <meta property="fb:app_id" content="907491999366379">
        <meta property="og:type" content="article">
        <meta property="og:url" content="@yield('url')">
        <meta property="og:title" content="Immo-clic.ca @yield('title')"/>
        <meta property="og:image" content="@yield('image')"/>
        <meta property="og:image:type" content="image/jpeg" />
        <meta property="og:image:width" content="200" />
		<meta property="og:image:height" content="200" />
        <meta property="og:description" content="@yield('fb-description')">
        <meta property="og:site_name" content="Immo-clic.ca">
        <link rel="shortcut icon" href="{{ URL::asset('website/images/favicon.png') }}">
        <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'/>
        <link href="{{ URL::asset('website/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('website/css/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('website/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ URL::asset('website/css/sumoselect.css') }}"/>
        <link href="{{ URL::asset('website/css/owl.carousel.css')}}" rel="stylesheet" type="text/css" /> 
        <link href="{{URL::asset('website/css/eagle.gallery.css') }}" rel="stylesheet" type="text/css" /> 
        <link href="{{URL::asset('website/css/style.css') }}" rel="stylesheet" type="text/css" />  
        <link href="{{URL::asset('website/css/responsive.css') }}" rel="stylesheet" type="text/css" />  
        <link rel="stylesheet" href="{{ URL::asset('website/css/range.css') }}"/>
        <link rel="stylesheet" href="{{ URL::asset('website/css/common.css') }}"/>
        <script type="text/javascript">
        var url = '{{ url() }}'; 
        var markerMapData='';
        </script>
    
        @if(empty($map))
            <script src="{{ URL::asset('website/js/jquery-1.11.3.min.js') }}"></script>   
        @else
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        @endif
        
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/css/bootstrap-dialog.min.css">

    </head>
    <body>
    
    <!-- Facebook Package -->
    <div id="fb-root"></div>
	<script>

	    window.fbAsyncInit = function () {
	        FB.init({
	            appId: '907491999366379',
	            xfbml: false,
	            version: 'v2.5'
	        });
	    };

	    (function (d, s, id) {
	        var js, fjs = d.getElementsByTagName(s)[0];
	        if (d.getElementById(id)) return;
	        js = d.createElement(s); js.id = id;
	        js.src = "//connect.facebook.net/fr_CA/sdk.js#xfbml=1&version=v2.5&appId=907491999366379";
	        fjs.parentNode.insertBefore(js, fjs);
	    } (document, 'script', 'facebook-jssdk'));
    
    </script>
   
    <div class="mobile-menu">
        <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#mobile-menu" aria-expanded="false" aria-controls="mobile-menu">
            <i class="fa fa-bars"></i> Menu
        </button>
        <div class="collapse" id="mobile-menu" aria-expanded="false" style="height: 0px;">
            <div class="well">
                <ul>
                    <li class="panel_li"><a href="{{ url($lang.'/acheter') }}">Acheter  </a></li>
                    <li class="panel_li"><a href="{{ url($lang.'/vendre') }}">Vendre  </a></li>
                    <li class="panel_li"><a href="{{ url($lang.'/forfaits') }}">Forfaits  </a></li>
                    <li class="panel_li"><a href="{{env('phase1')}}/partenaires/" target="_blank">Partenaires  </a></li>
                    <li class="panel_li"><a href="{{env('phase1')}}/courtiers/" target="_blank">Courtiers  </a></li>
                    <li class="panel_li"><a href="{{env('phase1')}}/financement/" target="_blank">Financement  </a></li>
                    <li class="panel_li"><a href="{{ url($lang.'/courtier-immobilier-volontaire') }}">Courtiers volontaires  </a></li>
                </ul>
            </div>
        </div>
    </div>
    <!--wrapper start-->
    <div class="wrapper">
        <!--header strat-->
        <div class="header">
            <div class="container">
                <!--top header start-->
                <div class="top-header clear">
                    <ul class="navbar-right">
                        <li class="social-icon backgound-none"><a target="_blank" href="https://www.facebook.com/immoclic.ca/?fref=ts"><i class="fa fa-facebook"></i></a> <a target="_blank" href="https://www.youtube.com/channel/UCyjToL7o5ZSiP-l1eH0FRuw"><i class="fa fa-youtube"></i></a></li>
                                      
                            @if(!empty(Auth::user()->UserID))     
                            <li class="dropdown">
                                  <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   <i class="fa fa-user"></i>{{ Lang::get('website-lang.my_account')}}<span class="caret"></span>
                                  </button> 
                                  <ul class="dropdown-menu" aria-labelledby="dLabel">
                                    <li><a href="{{ url($lang .'/mon-compte')}}"><i class="fa fa-user"></i> {{ Lang::get('website-lang.my_account')}}</a></li>
                                    <li><a href="{{ url('logOut')}}"><i class="fa fa-key"></i> {{ Lang::get('website-lang.logout')}}</a></li>
                                  </ul>
                            </li> 

                            @else
                             <li>
                             <a href="javascript:void(0)" id="login_model"><i class="fa fa-key"></i> {{ Lang::get('website-lang.log_in')}}  </a>
                            @endif
                            </li>
                            
                        <li class="dropdown hidden-xs">
                          <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i class="fa fa-compass"></i>
                             @if(!isset($_COOKIE['SectorName']))
                             {{Lang::get('website-lang.select_our_sector')}}
                             @else
                                 {{ Helper::truncate_by_char($_COOKIE['SectorName'],12)}}
                             @endif
                             <span class="caret"></span>
                          </button> 
                          <ul class="dropdown-menu area sector-list" li-class="select-this-sector" aria-labelledby="dLabel">
                          </ul>
                        </li>                                             
                        
                        <li class="dropdown">
                          <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-search icon_i"></i>{{ Lang::get('website-lang.search')}} <span class="caret"></span>
                          </button>
                        
                          <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><input id="txtSearchStreetName" type="text" value="" placeholder="{{ Lang::get('website-lang.street_name')}}..." name=""/><i id="cmdSearchStreetName" class="fa fa-search"></i></li>
                          </ul>
                        </li>
                        <li><a href="{{ str_replace('/mon-compte', '', url($lang.'/contact')) }}"><i class="fa fa-phone"></i> {{ Lang::get('website-lang.contact_us')}}</a></li>
<!--                        <li class="dropdown">
                          <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             @if($lang=='FR') FR @else EN @endif <span class="caret"></span>
                          </button> 
                          <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="{{Helper::GetLanguagePath('FR', $lang)}}" id="fr">FR</a></li>
                            <li><a href="{{Helper::GetLanguagePath('EN', $lang)}}" id="en">EN</a></li>
                          </ul>
                        </li> -->               
                    </ul>
                    
                </div>
                <!--top header end-->
                <!--bottom header start-->
                <div class="bottom-header clear">
                    <div class="navbar-left"><a href="@if($lang=='FR') {{ url('/FR') }} @else {{ url('/EN') }} @endif"><img src="@if($lang=='FR') {{ URL::asset('website/images/logo.png') }} @else {{ URL::asset('website/images/logo-en.png') }} @endif" alt=""/></a></div>
                    @if(!helper::PageisAdmin(Route::currentRouteName()))
                        <div class="navbar-right"><a target="_blank" href="/immobilier/financement" ><img src="{{URL::asset('website/images/header-banner.gif') }}" alt=""/></a></div>
                    @else
                        <div class="header-right"><a href="{{ url('/') }}">{{ Lang::get('website-lang.back_home')}}</a></div>
                    @endif                
                </div>
                <!--bottom header end-->
                
                <div class="mobile-area-selector visible-xs">
                	<ul class="selector">
                        <li class="dropdown">
                              <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fa fa-compass"></i>
                                 @if(!isset($_COOKIE['SectorName']))
                                 {{Lang::get('website-lang.select_our_sector')}}
                                 @else
                                 {{ Helper::truncate_by_char($_COOKIE['SectorName'],12)}}
                                 @endif
                                 <span class="caret"></span>
                              </button> 
                              <ul class="dropdown-menu area sector-list" li-class="select-this-sector" aria-labelledby="dLabel">
                              </ul>
                            </li>
                	</ul>     
                </div>
            
            </div>
        </div>  
        <!--header end-->
        
        <!--banner start-->