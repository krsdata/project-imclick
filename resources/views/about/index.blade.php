@extends('layouts.master') 
@section('content') 
@include('include.search')
<!--content start-->
<div class="content-box">
    <div class="container">
        <div id="link" style="position: absolute; z-index: 10; background: white; padding: 10px;
            display: none; width: 220px;">
        </div>
        <div class="row">
            <!--left start-->
            <div class="col-sm-2">
                @include('include.left-menu')
            </div>
            <!--left end-->

            <!--right start-->
            <div class="col-sm-7">
            
            	<section class="normal-content">
            
                    <h2>À propos</h2>
                    
                    <h3>C’est quoi Immo-Clic.ca ?</h3>
    
                    <h4>D’abord, Immo-Clic.ca n’est pas une agence immobilière.</h4> 
                    
                    <p>Immo-Clic.ca c’est une plateforme web publicitaire reliée à l’immobilier pour tout trouver quand vient le temps d’acheter, de vendre ou de faire des travaux sur une propriété. On veut simplifier la vie des gens en leur permettant de sauver du temps et de l’argent.</p>
                    
                    <p>Sur Immo-Clic.ca vous pouvez :</p>
                    
                    <ul>
                        <li>Afficher et vendre une propriété sans intermédiaire</li>                
                        <li>Rechercher des propriétés à vendre par des propriétaires et/ou des courtiers immobiliers</li>                
                        <li>Trouver un courtier immobilier</li>                
                        <li>Trouver un spécialiste hypothécaire</li>             
                        <li>Trouver un professionnel relié à l’immobilier (ex. : Notaires, Arpenteurs-Géomètres, Inspecteurs en bâtiments, Peintre, Rénovateurs, Déménageurs, etc.)</li>               
                    </ul>
                    
                 </section>   
                
                <section class="normal-content">
                
                    <h3>Notre mission !</h3>
                    
                    <h4>Immo-Clic.ca veut permettre à tous ceux qui achètent ou vendent une propriété d’être accompagné convenablement pour passer à travers toutes les étapes d’une transaction immobilière sans problème. </h4>
                    
                    <p>Depuis plusieurs années, le marché de l’immobilier a beaucoup changé et avec la tendance croissante de vendre par soi-même pour économiser la « commission », il y a de plus en plus de gens qui achètent ou qui vendent une propriété, sans courtier immobilier, mais finalement, sans réelle assistance professionnelle.</p> 
                    
                    <p>Il existe plusieurs alternatives sur le marché mais aucune solution ne réussit vraiment à servir le public devant l’écart qui se crée de plus en plus entre les courtiers immobiliers et les gens qui veulent acheter ou vendre sans intermédiaire. On a donc trouver une nouvelle façon de faire qui allait rapprocher le public et les courtiers immobiliers, le but étant finalement de ne pas perdre plus que la commission qu’on veut économiser! C’est là que notre concept de courtier immobilier volontaire prend tout son sens !</p>
                    
                    <p>Vous voulez en savoir plus ?</p>
                    
                    <ul class="no-dots">
                        <li><a href="{{url('faq')}}">FAQ</a></li>
                        <li><a href="{{url('contact')}}">Nous joindre</a></li>
                        <li><a href="http://immo-clic.ca/blogue">Blogue</a></li>
                        <li><a href="https://www.facebook.com/immoclic.ca/">Facebook</a></li>
                    </ul>
                
                </section>
                
            </div>
            <!--right end-->
            
            <div class="col-sm-3">
                @include('include.rigth-side-bar')
            </div>
            
        </div>
    </div>
</div>
<!--content end-->
@stop