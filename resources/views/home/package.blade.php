@extends('layouts.master')
    @section('content') 
        @include('include.search') 
        <!--content start-->
        <div class="content-box">
            <div class="container">
        <div class="row">
            
           <!--product table start-->
           <div class="product-table-box clear col-xs-12">
           
                <div class="property-type-box">
                    <ul>
                        <li class="title number-row"><span class="title-inner">Select your property type:</span></li>
                        <!--<li class="number-row">1 Get Your Home Ready to Sell</li>-->
                        <li>Pancarte à vendre personnalisée ******</li>
                        <li>Consultation Home staging**</li>
                        <li>Grand ménage (3h)***</li>
                        <li>Propriété vedette********</li>
                        <li>Formulaires*******</li>
                        <li>Rabais membre****</li>
                        <li>Support technique*****</li>
                        <li></li>
                        <li class="button-box"></li>
                    </ul>
                </div>
                <div class="classic-box">
                    <ul>
                        <li class="title"><span class="title-inner"><span><sup>$</sup>199,95</span> Classic</span></li>
                        <!--<li></li>-->
                        <li><i class="fa fa-check"></i></li>
                        <li>-</li>
                        <li>-</li>
                        <li>-</li>
                        <li><i class="fa fa-check"></i></li>
                        <li><i class="fa fa-check"></i></li>
                        <li><i class="fa fa-check"></i></li>
                        <li>4 month</li>
                        <li class="button-box"><button type="button">Choose</button></li>
                    </ul>
                </div>
                <div class="premium-box">
                    <ul>
                        <li class="title"><span class="title-inner"><span><sup>$</sup>249,95</span> Premium</span></li>
                        <!--<li></li>-->
                        <li><i class="fa fa-check"></i></li>
                        <li>-</li>
                        <li>-</li>
                        <li>-</li>
                        <li><i class="fa fa-check"></i></li>
                        <li><i class="fa fa-check"></i></li>
                        <li><i class="fa fa-check"></i></li>
                        <li>6 month</li>
                        <li class="button-box"><button type="button">Choose</button></li>
                    </ul>
                </div>
                <div class="prestige-box">
                    <ul>
                        <li class="title"><span class="title-inner"><span><sup>$</sup>399,95</span> Prestige</span></li>
                        <!--<li></li>-->
                        <li><i class="fa fa-check"></i></li>
                        <li><i class="fa fa-check"></i></li>
                        <li><i class="fa fa-check"></i></li>
                        <li>2 semaines</li>
                        <li><i class="fa fa-check"></i></li>
                        <li><i class="fa fa-check"></i></li>
                        <li><i class="fa fa-check"></i></li>
                        <li>Until sold</li>
                        <li class="button-box"><button type="button">Choose</button></li>
                    </ul>
                </div>
           
           </div>
           <!--product table end-->
          
            
           <!--content footer start-->
           <div class="col-xs-12 content-footer">
           <div class="row">
           
                <div class="col-sm-9">
                    <div class="headertop clearfix">
                        <h4>Notre engagement</h4>
                    </div>
                    <div class="explore_detail">
                        <p class="infopara">Notre équipe travaille avec coeur et passion pour offrir aux propriétaires l'expérience de vente la plus satisfaisante possible. Tout cela, sans commission ! C'est sûrement pour cela qu'autant de Québécois nous aiment. </p>
                    </div>
                </div>
                
                <div class="col-sm-3">
                    <div class="headertop clearfix">
                        <h4>Sondage CAA-Québec</h4>
                    </div>            
                    
                    <div class="clear brand-box">
                        <div class="brand-left"><img alt="" src="{{ URL::asset('website/images/caa-logo-fr.jpg') }}"></div>
                        <div class="brand-right">
                            <h1>Quand on aime, on le crie haut et fort!</h1>
                            <a class="headlink" href="#">Voir les coûts</a>
                        </div>
                    </div>
                    
                </div>
                
           
           </div>
           </div>
           <!--content footer end-->
            
            
        </div>    
        </div>
        </div>
        <!--content end--> 
@stop