@if(!helper::PageisAdmin(Route::currentRouteName()))
 <!--bottom content start--> 
        <div class="bottom-content-box">
            <div class="container">
                <div class="bottom-inner-content">
                    <h2>{{ Lang::get('website-lang.immo_clic_offer') }}</h2>
                    <ul>
                    	<li><img src="{{URL::asset('website/images/check.png')}}" atl="check" /> {{ Lang::get('website-lang.help_sell') }}</li>
                        <li><img src="{{URL::asset('website/images/check.png')}}" atl="check" /> {{ Lang::get('website-lang.phone_assistance') }}</li>
                        <li><img src="{{URL::asset('website/images/check.png')}}" atl="check" /> {{ Lang::get('website-lang.price_fixation_help') }}</li>
                        <li><img src="{{URL::asset('website/images/check.png')}}" atl="check" /> {{ Lang::get('website-lang.rearrangement_help') }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!--bottom content end-->
        
        <!--footer start-->
        <div class="footer">
            <!--top footer start-->
            <div class="top-footer">
                <div class="container">  
                    <ul class="clear">
                        <li class="panel_li"><a href="{{ url($lang.'/acheter') }}">{{ Lang::get('website-lang.buy') }}      </a></li>
                        <li class="panel_li"><a href="{{ url($lang.'/vendre') }}">{{ Lang::get('website-lang.sale') }}     </a></li>
                        <li class="panel_li"><a href="{{ url($lang.'/forfaits') }}">{{ Lang::get('website-lang.packages')}} </a></li>
                        <li class="panel_li"><a href="{{env('phase1')}}/partenaires/" target="_blank">{{ Lang::get('website-lang.traders') }}  </a></li>
                        <li class="panel_li"><a href="{{env('phase1')}}/courtier/" target="_blank">{{ Lang::get('website-lang.brokers') }}  </a></li>
                        <li class="panel_li"><a href="{{env('phase1')}}/financement/" target="_blank">{{ Lang::get('website-lang.funding') }}  </a></li>
                        <li class="panel_li"><a href="{{ url($lang.'/courtier-immobilier-volontaire') }}">{{ Lang::get('website-lang.voluntary_brokers') }}  </a></li>
                    </ul>
                </div>
            </div>
            <!--top footer end-->
            <!--center footer start-->
            <div class="center-footer">
                <div class="container clear">
                    
                    <div class="col-sm-3">
                        <h3 class="footer-title">Facebook</h3>
                        <div class="footer-content">
                            <div class="fb-page" data-href="https://www.facebook.com/immoclic.ca" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/immoclic.ca"><a href="https://www.facebook.com/immoclic.ca">Immo-Clic.ca</a></blockquote></div></div>
                        </div>
                    </div>
                    <div class="col-sm-3 ">
                        <h3 class="footer-title">{{ Lang::get('website-lang.my_account') }}</h3>
                        <div class="footer-content">                               
                            {{--*/ $id = empty(Auth::user()->UserID)?'':Auth::user()->UserID /*--}}                         
                            @if(!empty($id))     
                            <ul>
                                <li><a href="{{url($lang .'/mon-compte')}}">{{ Lang::get('website-lang.my_account')}}</a></li>
                                <li><a href="{{url($lang .'/politique-de-confidentialite')}}">{{ Lang::get('website-lang.privacy_policy') }}</a></li>
                                <li><a href="{{url($lang .'/condition-dutilisation')}}">{{ Lang::get('website-lang.terms_and_conditions') }}</a></li>
                                <li><a href="{{url('logOut')}}">{{ Lang::get('website-lang.logout')}}</a></li>
                            </ul>
                            @else
                            <ul>
                                <li><a href="{{url($lang .'/politique-de-confidentialite')}}">{{ Lang::get('website-lang.privacy_policy') }}</a></li>
                                <li><a href="{{url($lang .'/condition-dutilisation')}}">{{ Lang::get('website-lang.terms_and_conditions') }}</a></li>
                                <li><a href="javascript:void(0)" data-toggle="modal" data-target="#login-modal">{{ Lang::get('website-lang.log_in')}}  </a></li>
                            </ul>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3 ">
                        <h3 class="footer-title">{{ Lang::get('website-lang.blog') }}</h3>
                        <div class="footer-content">
                        	<ul>
                            	<li><a href="{{env('phase1')}}/sorganiser-pour-demenager-par-ou-commencer/">S’ORGANISER POUR DÉMÉNAGER : PAR OÙ COMMENCER?</a></li>
                                <li><a href="{{env('phase1')}}/le-home-staging-au-service-de-votre-propriete/">LE HOME STAGING AU SERVICE DE VOTRE PROPRIÉTÉ!</a></li>
                                <li><a href="{{env('phase1')}}/un-courtier-immobilier-en-2015/">UN COURTIER IMMOBILIER EN 2015</a></li>
                                <li><a href="{{env('phase1')}}/quel-sont-les-couts-a-prevoir-lors-de-lachat-dune-propriete/">QUEL SONT LES COÛTS À PRÉVOIR LORS DE L’ACHAT D’UNE PROPRIÉTÉ ?</a></li>
                                <li><a href="{{env('phase1')}}/linspection-preachat-un-bon-investissement/">L’INSPECTION PRÉACHAT, UN BON INVESTISSEMENT</a></li>                             
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 ">
                        <h3 class="footer-title">{{ Lang::get('website-lang.about') }}</h3>
                        <div class="footer-content">
                            <p>{{ Lang::get('website-lang.about_immo_clic') }}</p>
                            <div><a href="{{url($lang .'/a-propos-de-nous')}}"><button type="button">{{ Lang::get('website-lang.read_more') }}</button></a></div>
                        </div>
                    </div>
                    
                </div>
            </div>
            @endif
            <!--center footer end-->
            <!--bottom footer start-->
            <div class="bottom-footer">
                <div class="container">
                   <a title="Immo-Clic.ca" href="/">Immo-Clic.ca</a> &copy; {{ date("Y") }}. Tous droits réservés - Réalisation par <a target="_blank" title="Agence Captiv" href="//agencecaptiv.com/"> Agence Captiv</a>
                </div>
            </div>
            <!--bottom footer end-->
        </div>
        <!--footer end-->
    </div>
    
    <div style="display:none;" class="comms-box">
        
    </div>
    <div class="modal" id="area-sector" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none; padding-right: 17px;">
      <div class="modal-dialog" id="document_modal" role="document">
        <div class="modal-content">
          {!! Form::open(array('url' => URL::to($lang.'/SetSector'),'method'=>'post','id'=>'SetSectorForm','class'=>'form-horizontal'))!!}  
          <button type="button" class="modal-close-button" data-dismiss="modal" aria-label="Close" onclick="return CancelSectorChoose();">×</button>      
            <div class="modal-body">
              <div class="area-tab">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="Area">
                        <div class="main-field-box">
                            <div class="field-box">
                                <label for="Courriel">{{Lang::get('website-lang.select_our_sector')}}</label> 
                                <div class="mobile-area-selector">
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
                                    <p>Immo-Clic.ca est en développement! Si vous ne trouvez pas votre secteur, choisissez "Autres" pour naviguer sur la plateforme et contactez-nous pour nous faire part de votre intérêt afin que nous développions votre secteur!</p>
                                </div>
                            	</div>
                            <div class="field-box">
                                <input id="sectorName" type="hidden" name="sectorName" value="" />
                                <input id="choose_area" type="hidden" name="choose_area" value="" />
                                <input id="current_path" type="hidden" name="current_path" value="@if(isset($current_path)){{$current_path}}@endif" />
                                <button style="display:none;" type="submit" id="loginBtn" class="login-button">{{ Lang::get('website-lang.Choose') }}</button>
                            </div>
                        </div>
                    </div>  
           	    </div> 
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
    
    
    
    {{--*/ $range = 1 /*--}} 
    @if(empty($price1))
    {{--*/ $price1 = $min_price /*--}}
    @endif
    @if(empty($price2))    
    {{--*/ $price2 = $max_price /*--}}
    @elseif($price2==Lang::get('website-lang.unlimited')) 
        {{--*/ $range = 2 /*--}}           
        {{--*/ $price2 = $max_price /*--}}
    @endif  

    {{--*/ $range /*--}}  
    <!--wrapper end-->
    @include('include.login-signup')

    <input type="hidden" id="map_icon" value="{{ URL::asset('website/images/map_icon/icone_affiche.png') }}">
    
    <script src="https://maps.google.com/maps/api/js?sensor=false"></script>  
    <script src="{{ URL::asset('website/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('website/js/eagle.gallery.min.js') }}"></script>
    <script src="{{ URL::asset('website/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript">
        var select="{{ Lang::get('website-lang.Selected') }}"    
    </script>

    <script src="{{ URL::asset('website/js/jquery.sumoselect.js') }} "></script>
    <script src="{{ URL::asset('website/js/jquery-ui.js') }}"></script> 
    <script src="{{ URL::asset('website/js/jquery.ui.touch-punch.min.js') }}"></script> 

    @if(isset($getLatLng)) <script type="text/javascript" src="{{ URL::asset('website/js/map.js')}} "></script> @endif 
    <script src="{{ URL::asset('website/js/custom.js')}}"></script>
    <script src="{{ URL::asset('website/js/jquery.blockUI.min.js')}}"></script>
    <script src="{{ URL::asset('website/js/parallax.js')}}"></script>
    <script src="{{ URL::asset('website/js/smoothscroll.js')}}"></script>  
    <script src="{{ URL::asset('website/js/jquery.cookie.js')}}"></script>  
    <script src="{{ URL::asset('website/js/step-form.js')}}"></script> 
    <script src="{{ URL::asset('website/js/step-form_func.js')}}"></script> 
    <script src="{{ URL::asset('website/js/help.js')}}"></script>  
    <script src="{{ URL::asset('website/js/contact.js')}}"></script> 
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.js"></script>
     
    @if(!empty($map))
    <script src="{{ URL::asset('website/js/newmap.js')}}"></script> 
    @endif
    <script type="text/javascript"> 
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    // $(document).ready(function() {  
    //     $.blockUI({
    //         message: '<div class="loader"><div class="main-loader ball-clip-rotate-multiple"><div class="inner-loader"><div></div><div></div></div></div></div>'
    //          }); 
    //     });  
        //   document.addEventListener('DOMContentLoaded', function() {
        //     setTimeout($.unblockUI, 1000); 
        // }, false);  
    var map_lat_lng  = ''; 
    $(document).ready(function() {
        $("#testimonials-slider").owlCarousel({ 
          navigation : true, // Show next and prev buttons
          slideSpeed : 300,
          paginationSpeed : 400,
          singleItem:true 
      });

        $('.eagle-gallery').eagleGallery({
         openGalleryStyle:'transform',
         bottomControlLine:true,
         AutoPlay:true   
    }); 
     
      $("#banner-slider").owlCarousel({
        navigation : false, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true,
        autoPlay:true,
        pagination:true 
      }); 
    });
    window.asd = $('.SlectBox').SumoSelect({ csvDispCount: 3 });
       //Parallax effect for bacjgroundimage
    jQuery(window).bind('load', function() {
        parallaxInit();
    });
    function parallaxInit() {

        jQuery('.parallax').each(function() {

            jQuery(this).parallax("0",0);
        });
    } 
    </script>

    <script type="text/javascript">
    var unlimites_lang="{{Lang::get('website-lang.unlimited')}}";
    $('#mina').html("$" + $("#slider" ).slider( "values", 0 ) );
    $('#maxa').html( "$" + $("#slider" ).slider( "values", 1 ) );
    var min_price={{ $min_price }};
    var max_price = {{ $max_price }};
    var price2={{$price2}};

    $( "#slider-range" ).slider({
                range: true,
                step: 5000,
                min: {{ $min_price }},
                max: {{ $max_price }},
    values: [ {{$price1}}, {{$price2}}],
       start: function( event, ui ) {},     
         create: function( event, ui ) {
  
    },  
    slide: function( event, ui ) {
    if(ui.value == max_price){
 
      $("#amount" ).val( "$" + ui.values[ 0 ] + " - " +  unlimites_lang );
       }else{
        $("#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );  
       }
    },  
    change: function( event, ui ) {
        if(ui.value == max_price){
            $( "#amount" ).val( "$" + ui.values[ 0 ] + " - " +  unlimites_lang );
        }
    }
    }); 
    // $("#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - " +  "Unlimited");
    // if($("#slider-range" ).slider( "values", 1 ) == max_price){
    //     $( "#amount" ).val( "$" + ui.values[ 0 ] + " - " +  "Unlimited" );
    // }
    var range={{$range}};   
    if(range==2)
    {        
        $("#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - " +  unlimites_lang);
    }
    else
    {
        $("#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - " +  unlimites_lang);
        if($("#slider-range" ).slider( "values", 1 ) == max_price){
            //$( "#amount" ).val( "$" + ui.values[ 0 ] + " - " +  "Unlimited" );
            $("#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 1 ) + " - " +  unlimites_lang);
        }

        $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
                 " - $" + $( "#slider-range" ).slider( "values", 1 ) );
    }
    
    </script>

  </body>
</html>