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
                
                <section class="normal-content section-separator">
                
                	<h2>Acheter</h2>
                
                	<h3>Vous avez pris la décision d’acquérir une propriété mais ne savez pas par où commencer ?</h3>
                    
                    <p><b>Si vous le souhaitez, un courtier immobilier participant Immo-Clic.ca peut vous accompagner dans votre démarche d’achat de propriété. Voyez les avantages de faire affaire avec un courtier immobilier en lisant l’article « <a href="/immobilier/blogue/un-courtier-immobilier-en-2015/">Un courtier immobilier en 2015</a> » sur notre blogue!</b></p>
                    
                    <p>Pour trouver un courtier qui saura vous guider et vous accompagner, inscrivez-vous dans la page Courtier !</p>
                    
                    <a class="btn" href="/immobilier/courtier">Acheter avec un courtier</a>
                
                </section>
                
                <section class="normal-content">
                
                 	<!-- Start box -->
                    <div class="contant-box">
                    
                        <!-- Start accordion -->
                        <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
                    
                            <!-- Start panel1 -->
                            <div class="panel panel-default">
                                <div id="headingOne" role="tab" class="panel-heading">
                                    <h4 class="panel-title">
                                        <a aria-controls="buying-budget" aria-expanded="false" href="#buying-budget" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/check-accordion.png')}}" atl="check">Estimation de votre budget d’achat et pré-approbation bancaire<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                    </h4>
                                 </div>
                                 <div aria-labelledby="headingOne" role="tabpanel" class="panel-collapse collapse" id="buying-budget" aria-expanded="false" style="height: 2px;">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                            
												<p>Avant de commencer vos recherches, la première chose à faire est de connaître votre capacité financière pour l’achat d’une propriété afin de bien diriger vos recherches. </p>
                                                
                                                <p>Vous pouvez obtenir une pré-approbation bancaire d’un spécialiste hypothécaire participant Immo-Clic.ca en vous inscrivant dans la section Financement</p>
                                                <a class="btn" href="/immobilier/financement">Financement</a>
                                                    
                                             </div>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                               <!-- End panel1 --> 
                               
                            <!-- Start panel1 -->
                            <div class="panel panel-default">
                                <div id="headingTwo" role="tab" class="panel-heading">
                                    <h4 class="panel-title">
                                        <a aria-controls="needs-evaluation" aria-expanded="false" href="#needs-evaluation" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/check-accordion.png')}}" atl="check">Évaluation de vos besoins et définitions de vos critères de recherche<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                    </h4>
                                 </div>
                                 <div aria-labelledby="headingTwo" role="tabpanel" class="panel-collapse collapse" id="needs-evaluation" aria-expanded="false" style="height: 2px;">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                            
												<p>Voici une liste de points à considérer lors de l’achat d’une propriété afin de gagner du temps en visitant des propriétés qui vous conviennent vraiment!(<i>Vous pourrez évidemment identifier d’autres critères selon votre situation, mais ceux-ci représente une base de départ!</i>)</p>
                                                 
                                                 <div class="stretch">
                                                 	
                                                    <ul>
                                                    	<li><b>L’emplacement</b>
                                                        	<ul>
                                                            	<li>Banlieue, ville ou campagne</li>
                                                                <li>Quartier, voisinage, services à proximité, circulation, bruit, etc.</li>
                                                        	</ul>
                                                        </li>
                                                        <li><b>Type et taille de propriété</b>
                                                        	<ul>
                                                            	<li>Condo, jumelé, unifamiliale, inter-génération </li>
                                                                <li>Avec ou sans garage</li>
                                                                <li>Nombre d’étage</li>
                                                                <li>Aires ouvertes</li>
                                                                <li>Propriété neuve, usagé, avec rénovations</li>
                                                            </ul>
                                                        </li>
                                                        <li><b>Type de terrain</b>
                                                        	<ul>
                                                            	<li>Grandeur</li>
                                                                <li>Intimité, Proximité des voisins</li>
                                                                <li>Piscine, cabanon, etc.</li>
                                                            </ul>
                                                        </li>
                                                        <li><b>Nombre de chambre</b></li>
                                                        <li><b>Besoins particulier (salle de lavage, bureau, cinéma maison, rangement supplémentaire, etc.)</b></li>
                                                    </ul>
                                                    
                                                 </div>
                                                    
                                             </div>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                               <!-- End panel1 -->
                               
                                <!-- Start panel1 -->
                                <div class="panel panel-default">
                                    <div id="headingThree" role="tab" class="panel-heading">
                                        <h4 class="panel-title">
                                            <a aria-controls="calculation" aria-expanded="false" href="#calculation" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/check-accordion.png')}}" atl="check">Calcule des coûts reliés à l’achat d’une propriété<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                        </h4>
                                     </div>
                                     <div aria-labelledby="headingThree" role="tabpanel" class="panel-collapse collapse" id="calculation" aria-expanded="false" style="height: 2px;">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                
                                                    <p>L’achat d’une propriété engendre beaucoup de frais afférents au coût direct de la propriété. Pour ne pas avoir de mauvaise surprise au cours du processus, il est important de prévoir ces coûts au début ! Consultez l’article « <a href="/immobilier/blogue/quel-sont-les-couts-a-prevoir-lors-de-lachat-dune-propriete/">Quels sont les coûts à prévoir lors de l’achat d’une propriété?</a> » sur notre blogue pour vous guider à travers vos calculs! D’autres coûts seront peut-être à considérer selon votre situation.</p>
                                                        
                                                 </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                   <!-- End panel1 -->
                                   
                               	<!-- Start panel1 -->
                                <div class="panel panel-default">
                                    <div id="headingFour" role="tab" class="panel-heading">
                                        <h4 class="panel-title">
                                            <a aria-controls="searching-visiting" aria-expanded="false" href="#searching-visiting" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/check-accordion.png')}}" atl="check">Recherche et visites de propriétés<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                        </h4>
                                     </div>
                                     <div aria-labelledby="headingFour" role="tabpanel" class="panel-collapse collapse" id="searching-visiting" aria-expanded="false" style="height: 2px;">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                
                                                    <p>Ciblez bien les secteurs qui vous conviennent, l’intervalle de prix visé, le ou les types de propriétés et les caractéristiques que vous souhaitez. Vous serez ainsi plus efficace dans vos recherches en vous concentrant sur des propriétés qui répondent vraiment à vos critères.</p>
                                                    
                                                    <p>Lisez bien les fiches descriptives des propriétés pour vous assurer que cela vous convient. S’il y a des informations que vous aimeriez connaître et qui ne se retrouve pas sur la fiche de la propriété, n’hésitez pas à contactez le propriétaire pour lui poser vos questions avant de demander une visite.</p>
                                                    
                                                    <p>Lorsqu’une propriété semble répondre à vos critères, vous pouvez aller passer devant la propriété et dans le secteur environnant pour valider si cela vous convient toujours.</p>
                                                    
                                                    <p>L’étape suivante consistera à prendre rendez-vous pour faire une visite de la propriété. Vous pouvez préparer une liste de question ou de points à valider sur place lors de la visite.</p>
                                                    
                                                    <p>Lors de votre visite, évaluer le potentiel de la propriété en faisant abstraction de la décoration, des meubles ou de la couleur des murs! Ce sont des aspects que vous pouvez facilement changer ou qui ne sont simplement pas inclus dans la vente, alors ils ne devraient pas influer votre jugement! Concentrez-vous sur la grandeur des pièces, la fenestration, les rénovations à faire, les matériaux de plancher et des armoires, la disposition des pièces, le voisinage et le terrain!</p>
                                                        
                                                 </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                   <!-- End panel1 --> 
                                   
                            <!-- Start panel1 -->
                            <div class="panel panel-default">
                                <div id="headingFive" role="tab" class="panel-heading">
                                    <h4 class="panel-title">
                                        <a aria-controls="buying-offer" aria-expanded="false" href="#buying-offer" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/check-accordion.png')}}" atl="check">L’offre d’achat<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                    </h4>
                                 </div>
                                 <div aria-labelledby="headingFive" role="tabpanel" class="panel-collapse collapse" id="buying-offer" aria-expanded="false" style="height: 2px;">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                            
                                                <p>Une propriété vous a plus et convient à une majorité de vos critères ? La prochaine étape, si vous désirez acheter cette propriété, sera de préparer et de présenter une offre d’achat au vendeur.</p>
                                                
                                                <p>Vous devrez rédiger une promesse d’achat et y établir certains points dont ceux-ci :</p>
                                                
                                                <div class="stretch">
                                                	
                                                    <ul>
                                                    	<li>Le prix que vous désirez offrir
                                                        	<ul>
                                                            	<li>Évitez le mythe de l’évaluation municipale! La valeur marchande d’une propriété se fixe avec le prix des propriétés vendues et non avec l’évaluation municipale. Faites une recherche des propriétés comparables vendues dans le même secteur et notez les rénovations majeures que vous jugez qu’il y a à faire sur la propriété, s’il y a lieu. Vous pourrez ainsi justifier le prix de votre offre d’achat.</li>
                                                            </ul>
                                                        </li>
                                                        <li>La date de l’acte de vente et de prise de possession de la propriété</li>
                                                        <li>Les éléments de la propriété que vous voulez inclure dans votre offre (exemples : Rideaux et tringles)</li>
                                                        <li>Les éléments de la propriété que vous voulez exclure de l’offre (exemples : électroménagers et meubles)</li>
                                                        <li>Si vous allez réaliser une inspection pré-achat
                                                        	<ul>
                                                            	<li>Il est fortement recommandé de faire une inspection pré-achat sur la propriété que vous convoitez. Vous pouvez en savoir plus avec l’article « <a href="/immobilier/blogue/linspection-preachat-un-bon-investissement">L’inspection pré-achat, un bon investissement</a> » de notre blogue!</li>
                                                            </ul>
                                                        </li>
                                                        <li>Le délai pour fournir votre preuve de prêt hypothécaire (habituellement entre 7 et 10 jours pour laisser le temps à votre institution financière de vous fournir votre lettre d’autorisation de prêt)</li>
                                                        <li>Si votre offre est conditionnelle ou non à la vente d’une autre propriété</li>
                                                        <li>Si vous exiger que le vendeur remplisse et vous remette le formulaire « Déclaration du vendeur »</li>
                                                        <li>Le délai que vous laissez au vendeur pour répondre à votre offre (Habituellement le délai est de 1 jour à 3 jours)</li>
                                                    </ul>
                                                    
                                                </div>
                                                
                                                <p>Une fois rédigée, vous devrez présenter votre offre d’achat au vendeur. Les négociations commencent! Le vendeur aura le choix d’accepter, de refuser ou de vous présenter une contre-proposition. Si les négociations aboutissent à une entente entre vous et le vendeur, c’est à ce moment que les délais prévus dans l’offre d’achat commencent. </p>
                                                
                                             </div>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                               <!-- End panel1 -->
                               
                                <!-- Start panel1 -->
                                <div class="panel panel-default">
                                    <div id="headingSix" role="tab" class="panel-heading">
                                        <h4 class="panel-title">
                                            <a aria-controls="making-conditions" aria-expanded="false" href="#making-conditions" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/check-accordion.png')}}" atl="check">La réalisation des conditions<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                        </h4>
                                     </div>
                                     <div aria-labelledby="headingSix" role="tabpanel" class="panel-collapse collapse" id="making-conditions" aria-expanded="false" style="height: 2px;">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                
													<div class="stretch">
                                                    	<ul>
                                                        	<li>Il vous faudra envoyer la promesse d’achat (et les contre-propositions ou autre avis reliés à la promesse d’achat, s’il y a lieu), la déclaration du vendeur et la fiche descriptive de la propriété à votre institution financière pour l’obtention de votre prêt hypothécaire. Vous pourrez valider les documents requis avec votre institution financière.</li>
                                                            <li>Réaliser l’inspection pré-achat, s’il y a lieu.</li>
                                                            <li>Réaliser la vente de votre propriété, s’il y a lieu.</li>
                                                            <li>Réaliser toutes autres conditions qui aura été convenue dans la promesse d’achat.</li>
                                                        </ul>
                                                        
                                                        <p>Lorsque les conditions sont toutes réalisées et que les délaissont terminés, l’offre devient finale et par le fait même un contrat irrévocable entre vous et le vendeur de la propriété.!</p>
                                                        
                                                        
                                                    </div>
                                                    
                                                 </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                   <!-- End panel1 -->
                                   
                                <!-- Start panel1 -->
                                <div class="panel panel-default">
                                    <div id="headingSeven" role="tab" class="panel-heading">
                                        <h4 class="panel-title">
                                            <a aria-controls="notary" aria-expanded="false" href="#notary" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/check-accordion.png')}}" atl="check">Passage chez le notaire, réception des clés et le déménagement !<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                        </h4>
                                     </div>
                                     <div aria-labelledby="headingSeven" role="tabpanel" class="panel-collapse collapse" id="notary" aria-expanded="false" style="height: 2px;">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                
                                                    <p>Quand toutes les conditions d’une offre d’achat sont remplies et que la date fixée entre les parties pour l’échange des clés est déterminée, il restera à passer devant le notaire à cette date pour officialiser la transaction immobilière. </p>
                                                    
                                                    <p>C’est normalement l’acheteur de la propriété qui a le choix du notaire. Vous pouvez trouver un notaire participant Immo-Clic.ca dans notre section Partenaires! (Lien vers la page de notaires)</p>
                                                    
                                                    <p>Un fois votre notaire choisi, il faudra lui fournir les documents relatifs à l’achat de la propriété, en voici une liste de base qui peut varier selon votre situation :</p>
                                                    
													<div class="stretch">
                                                    	
                                                        <p><b>Documents à fournir par l’acheteur :</b></p>
                                                        
                                                        <ul>
                                                        	<li>L’offre d’achat et ses contre-propositions, s’il y a lieu</li>
                                                            <li>La déclaration du vendeur, s’il y a lieu</li>
                                                            <li>L’approbation de prêt hypothécaire</li>
                                                        </ul>
                                                        
                                                        <p><b>Documents à fournir par le vendeur :</b></p>
                                                        
                                                        <ul>
                                                        	<li>Le certificat de localisation de la propriété </li>
                                                            <li>L’acte de vente et l’acte hypothécaire de la propriété</li>
                                                            <li>Les dernières factures de taxes municipales et scolaires</li>
                                                        </ul>
                                                        
                                                    </div>
                                                    
                                                    <p>Il faudra finalement procéder au passage chez le notaire et c’est lui qui vous expliquera le déroulement et les documents à signer. </p>
                                                    
                                                    <p>L’acheteur doit passer devant le notaire en premier lieu pour signer l’acte hypothécaire. Ensuite, minimum 48 heures après la signature de l’acte hypothécaire, ce sera le rendez-vous pour la signature de l’acte de vente. C’est à ce rendez-vous que le notaire vous expliquera le fonctionnement pour la répartition des taxes foncières entre l’acheteur et le vendeur. Vous y recevrez également les clés du vendeur et serez donc officiellement propriétaire de votre nouvelle demeure ! Vous pourrez ensuite déménager!</p>
                                                        
                                                 </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                   <!-- End panel1 -->                                              
                               
                        </div>
                        <!-- End accordion -->
                	</div>
                    <!-- End box -->
                
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