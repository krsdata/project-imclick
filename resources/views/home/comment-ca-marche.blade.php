@extends('layouts.master')
@section('content') 
@include('include.search') 
       
<!--content start-->
<div class="content-box">
    <div class="container">
        <div class="row"> 
        	
            <!--left start-->
       		<div class="col-sm-2">
          		@include('include.left-menu')
      		</div>
            <!--left end-->
            
            <div class="col-sm-7 how-it-works">
            	
                <section class="normal-content">
                	
                    <h2 style="text-align:center;">Comment ça marche?</h2> 
                   
                    <div class="row">
                    
                        <div class="left-content col-md-6">
                        
                        	<img src="{{URL::asset('website/images/icon-choix-forfait.png')}}" alt="Choisir forfait" />
                        
                        </div>
                        
                        <div class="right-content col-md-6">
                            
                            <h3><span class="number">1. </span>Choisissez votre forfait et Inscrivez-vous</h3>
                            
                            <p>Parcourez nos 3 forfaits et choisissez celui qui vous convient selon votre budget et vos besoins!</p>
                            
                            <a class="btn" href="{{ url($lang.'/forfaits') }}">VOIR NOS FORFAITS</a>
                        
                        </div>
                    
                    </div>
                    
                </section>
                
                <hr />
                
                <section class="normal-content">
                	
                    <div class="row">
                    
                    	<div class="right-content col-md-6">
                    
                            <h3><span class="number">2. </span>Sélectionnez vos courtiers immobiliers volontaires participants</h3>
                            
                            <p>Selon votre préférence, choisissez de 1 à 3 courtiers volontaires qui se déplaceront chez vous pour vous donner leur opinion de la valeur marchande de votre propriété et vous aider dans l’établissement de votre prix de vente. Les courtiers volontaires choisis pourront également vous renseigner si vous avez des questions pendant la durée de votre forfait !
        </p>
                            <a class="btn" href="{{ url($lang.'/courtier-immobilier-volontaire') }}">DÉTAILS SUR LES COURTIERS VOLONTAIRES</a>
                    	
                        </div>
                        
                        <div class="left-cntent col-md-6">
                        	
                            <img src="{{URL::asset('website/images/icon-choix-courtier.png')}}" alt="Choisir forfait" />
                            
                        </div>
                        
                    </div>
                    
                </section>
                
                <hr />
                
                <section class="normal-content">
                	
                    <div class="row">
                    
                    	<div class="left-content col-md-6">
                        
                        	<img src="{{URL::asset('website/images/icon-photo.png')}}" alt="Choisir forfait" />
                        
                        </div>
                    	
                        <div class="right-content col-md-6">
                    
                            <h3><span class="number">3. </span>Mise en valeur et Prise de photos professionnelles HDR</h3>
                            
                            <p>Notre photographe vous contactera pour prendre rendez-vous et effectuer la prise de photo de votre propriété!</p>
                            
                            <p>Avant son passage, faites le grand ménage, épurez votre décor et redonner un coup d’éclat à votre propriété!</p>
                		
                        </div>
                        
                    </div>
                    
                </section>
                
                <hr />
                
                <section class="normal-content">
                
                	<div class="row">
                    
                        <div class="right-content col-md-6">
                        
                            <h3><span class="number">4. </span>Rédaction de votre annonce et mise en ligne</h3>
                            
                            <p>Tracez un portrait le plus complet possible de votre propriété pour bien informer les acheteurs potentiels!</p>
                            
                            <p>En accédant à votre compte Immo-Clic.ca, nos formulaires vous permettront de créer votre annonce de façon simple et efficace.</p>
                        
                        </div>
                        
                        <div class="left-content col-md-6">
                        
                        	<img src="{{URL::asset('website/images/icon-redaction.png')}}" alt="Choisir forfait" />
                        
                        </div>
                        
                    </div>
                    
                </section>
                
                <hr />
                
                <section class="normal-content">
                	
                    <div class="row">
                    	
                        <div class="left-content col-md-6">
                        	<img src="{{URL::asset('website/images/pancarte.png')}}" alt="Choisir forfait" />
                        </div>
                        
                        <div class="right-content col-md-6">
                        
                            <h3><span class="number">5. </span>Plantez votre pancarte!</h3>
                            
                            <p>Votre pancarte personnalisée Immo-Clic.ca vous sera remise par notre photographe lors de la prise de photo!</p>
                    	
                        </div>
                        
                    </div>
                    
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