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
            
            <div class="col-sm-7">
                
                <section class="normal-content">
                	<h2 style="text-align:center;">Courtiers volontaires</h2>
                    
                    <div class="centered-img">
                    	<img src="{{URL::asset('website/images/clients-avec-courtier.jpg')}}" alt="Clients avec courtier" />
                    </div>
                    
                    <h3>« Réunir les courtiers immobiliers et les gens du public sur une plateforme où vendre par soi-même ou avec un courtier immobilier est possible dans un esprit de collaboration! »</h3>
                    <p style="text-align:center;">Voilà la base de notre concept de courtier immobilier volontaire!</p>
                    
                    <p>Simplement, un courtier immobilier volontaire participant Immo-Clic.ca, c’est un courtier immobilier détenant un permis de courtier immobilier valide délivré par l'OACIQ (Organisme d’autoréglementation du Courtage Immobilier du Québec) qui a décidé d’offrir volontairement du temps pour aider des vendeurs dans à la mise en marché de leur propriété.</p>
                    
                    <p>Les courtiers immobiliers volontaires participant Immo-Clic.ca sont là pour rehausser la qualité du service à la clientèle en démontrant leur bonne volonté et leur ouverture d’esprit. Ils pourront donner une opinion de la valeur marchande de leur propriété et répondre aux questions des vendeurs s’il y a lieu.</p>
                    
                    <p>Avec les courtiers immobiliers volontaires, Immo-Clic.ca veut cultiver un climat de confiance en l’industrie du courtage immobilier pour permettre à tous et chacun de bénéficier d’informations professionnelles et d’avoir le juste prix pour l’achat ou la vente d’une propriété, que ce soit en faisant affaire ou non avec un courtier immobilier.</p>
                    
                    <p>Pour d’autres détails, consultez notre <a href="{{url('faq')}}">FAQ</a>.</p>
                    
                </section>
                
            </div>
            
            <!--right start-->
            <div class="col-sm-3">
                @include('include.rigth-side-bar')
            </div>
            
            <!--right end-->
        </div>
    </div>
</div>
<!--content end-->
@stop