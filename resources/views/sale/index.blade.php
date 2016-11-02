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
                    
                    <h2>Vous avez décidé de vendre votre propriété ? Par où commencer ?</h2>
                    
                    <p><b>Le choix que vous avez à faire est de vendre sans intermédiaire ou par l’entremise d’un courtier immobilier.</b></p>
                    
                    <ul>
                    	<li>Évaluer d’abord vos dispositions et le temps que vous avez à consacrer à la vente de votre propriété.</li>
                        <li>Vous pouvez ensuite vous informer auprès de différents courtiers immobiliers participants Immo-Clic.ca afin de connaître les services qu’ils offrent et la rémunération qu’ils proposent.</li>
                    </ul>
                    
                    <div class="stretch">
                    	
                        <p>Pour faire un choix éclairé, sachez que vous pouvez négocier la commission d’un courtier mais aussi questionner les services offerts par les courtiers immobiliers! </p>
                        
                    	<div class="stretch">
                        	
                            <p>Vous pouvez entre autre demander au courtier :</p>
                            
                            <ul>
                            	<li>S’il est toujours présent lors des visites de votre propriété ?</li>
                                <li>S’il est présent lors de l’inspection de votre propriété et lors du passage chez le notaire ?</li>
                                <li>S’il utilise des moyens publicitaires distinctifs pour favoriser la vente de votre propriété ?</li>
                                <li>S’il vous fera un compte-rendu et un suivi après chaque visite de votre propriété ?</li>
                                <li>S’il organisera des visites libres pour mousser la vente de votre propriété ?</li>
                            </ul>
                            
                            <p>Et surtout, voyez si vous vous sentez à l’aise et en confiance avec le courtier! Un courtier doit être là pour faire équipe avec vous dans la vente de votre propriété !</p>
                            
                        </div>
                    
                    </div>
                    
                    <p>Pour vendre votre propriété avec un courtier immobilier participant Immo-Clic.ca, inscrivez-vous dans notre section Courtiers !</p>
                    
                    <a class="btn" href="{{env('phase1')}}/courtier">Vendre avec un courtier</a>
                    
                </section>
                
                <section class="normal-content">
                
                	<p>Si vous choisissez de vendre votre propriété sans intermédiaire, les forfaits Immo-Clic.ca sont là pour vous !</p>
                	
                    <a class="btn" href="{{url($lang .'/forfaits')}}">Découvrez nos forfaits</a>
                    
                    <!-- Start box -->
                    <div class="contant-box">
                    
                        <!-- Start accordion -->
                        <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
                    
                            <!-- Start panel1 -->
                            <div class="panel panel-default">
                                <div id="headingOne" role="tab" class="panel-heading">
                                    <h4 class="panel-title">
                                        <a aria-controls="packages" aria-expanded="false" href="#packages" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/check-accordion.png')}}" atl="check">LES FORFAITS IMMO-CLIC.CA!<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                    </h4>
                                 </div>
                                 <div aria-labelledby="headingOne" role="tabpanel" class="panel-collapse collapse" id="packages" aria-expanded="false" style="height: 2px;">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                            
												<p>Avec tous les forfaits Immo-Clic.ca, vous pourrez sélectionnez selon votre convenance, jusqu’à 3 courtiers immobiliers volontaires qui se déplaceront chez vous pour vous donner leur opinion de la valeur marchande de votre propriété et ainsi vous aider dans l’établissement d’un prix de vente juste.</p>
                                                
                                                <p>Les courtiers immobiliers volontaires participants Immo-Clic.ca que vous aurez sélectionnés pourront également vous renseignez si vous avez des questions pendant la durée de votre forfait.</p>
                                                    
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
                                        <a aria-controls="value" aria-expanded="false" href="#value" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="http://immo-clic2/website/images/check-accordion.png" atl="check">MISE EN VALEUR DE VOTRE PROPRIÉTÉ<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                    </h4>
                                 </div>
                                 <div aria-labelledby="headingTwo" role="tabpanel" class="panel-collapse collapse" id="value" aria-expanded="false" style="height: 2px;">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                            
												<p>Ensuite il faudra mettre en valeur votre propriété pour la prise de photo HDR effectuée par notre photographe professionnel. Pour vous aider vous pouvez lire sur notre blogue l’article « <a href="/immobilier/blogue/le-home-staging-au-service-de-votre-propriete/">Le Home Staging au service de votre propriété!</a> »</p>
                                                    
                                             </div>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                               <!-- End panel1 -->
                                                              
                                <!-- Start panel1 -->
                                <div class="panel panel-default">
                                    <div id="headingNine" role="tab" class="panel-heading">
                                        <h4 class="panel-title">
                                            <a aria-controls="inspection" aria-expanded="false" href="#inspection" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/check-accordion.png')}}" atl="check">INSPECTION PRÉ-VENTE<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                        </h4>
                                     </div>
                                     <div aria-labelledby="headingNine" role="tabpanel" class="panel-collapse collapse" id="inspection" aria-expanded="false" style="height: 2px;">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                
                                                    <p>Vous pouvez envisager de faire effectuer une inspection pré-vente sur votre propriété par un inspecteur en bâtiment qui vous remettra un rapport en conséquence que vous pourrez montrer à des acheteurs potentiels. Cela peut permettre de déceler des problèmes qui peuvent être régler avant les visites d’acheteurs potentiels, qui autrement auraient pu inquiéter certains acheteurs. On évite ainsi des tentatives de négociations sur des problèmes qui peuvent facilement être régler.  L’inspection pré-vente peut aussi faciliter vente et servir de justification au montant que vous demandez pour votre propriété.</p>
                                                    
                                                    <p>Si vous désirez vous prévaloir d’un rapport d’inspection pré-vente, découvrez notre sélection d’inspecteurs en bâtiment qualifié dans la section <a href="/immobilier/partenaires">partenaires</a> !</p>
                                                        
                                                 </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                   <!-- End panel1 -->
                                   
                                <!-- Start panel1 -->
                                <div class="panel panel-default">
                                    <div id="headingTen" role="tab" class="panel-heading">
                                        <h4 class="panel-title">
                                            <a aria-controls="location-certificate" aria-expanded="false" href="#location-certificate" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/check-accordion.png')}}" atl="check">CERTIFICAT DE LOCALISATION À JOUR<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                        </h4>
                                     </div>
                                     <div aria-labelledby="headingTen" role="tabpanel" class="panel-collapse collapse" id="location-certificate" aria-expanded="false" style="height: 2px;">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                
                                                    <p>Normalement, lors du passage au notaire pour la vente d’une propriété, vous devez avoir en main un certificat de localisation à jouret reflétant les lieux actuels. Donc s’il y a eu des changements comme l’ajout d’une clôture ou d’un cabanon par exemple, il faudra vous procurer un nouveau certificat de localisation auprès d’un arpenteur-géomètre. Vous pouvez trouver un arpenteur-géomètre qualifié et économiser sur le coût de votre certificat de localisation dans notre section partenaires ! (lien direct dans la page des arpenteurs-géomètres)</p>
                                                        
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
                                            <a aria-controls="writting" aria-expanded="false" href="#writting" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/check-accordion.png')}}" atl="check">RÉDACTION DE VOTRE ANNONCE<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                        </h4>
                                     </div>
                                     <div aria-labelledby="headingThree" role="tabpanel" class="panel-collapse collapse" id="writting" aria-expanded="false" style="height: 2px;">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                
                                                    <p>L’étape suivante consiste à rédiger votre annonce et à la mettre en ligne! Nos formulaires vous permettront aisément de tracer un portait fiable de votre propriété. À cette étape vous pouvez également remplir une « déclaration du vendeur » que vous conserverez pour mettre à la disposition d’un acheteur qui aurait fait une offre d’achat. Ce document sera à votre disposition via votre compte Immo-Clic.ca.</p>
                                                        
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
                                            <a aria-controls="visiting-request" aria-expanded="false" href="#visiting-request" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/check-accordion.png')}}" atl="check">LES DEMANDES DE VISITES<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                        </h4>
                                     </div>
                                     <div aria-labelledby="headingFour" role="tabpanel" class="panel-collapse collapse" id="visiting-request" aria-expanded="false" style="height: 2px;">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                
                                                    <p>Une fois votre annonce en ligne, vous pourrez recevoir des demandes de visites! </p>
                                                    
                                                    <p>Pour éviter de perdre votre temps et celui d’acheteurs potentiels, il faut savoir filtrer les demandes et surtout ne pas faire une croix sur les acheteurs représentés par un courtier immobilier! Discutez bien des particularités de votre propriété et de ce que recherchent les acheteurs potentiels ou avec le courtier immobilier des acheteurs potentiels afin de vous assurer que votre propriété peut vraiment leur convenir. Si un courtier immobilier vous demande une visite pour votre propriété, assurez-vous également qu’il se présente en compagnie de ses clients lors de ladite visite!</p>
                                                        
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
                                        <a aria-controls="visiting" aria-expanded="false" href="#visiting" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/check-accordion.png')}}" atl="check">LES VISITES<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                    </h4>
                                 </div>
                                 <div aria-labelledby="headingFive" role="tabpanel" class="panel-collapse collapse" id="visiting" aria-expanded="false" style="height: 2px;">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                            
                                                <p>Au moment de faire visiter votre propriété, faite le grand ménage et si possible, remettez votre propriété dans l’état où elle était lors de la prise de photo! L’opinion des acheteurs se fait rapidement en entrant dans la propriété!</p>
                                                
                                                <p>Préparez-vous à répondre le plus clairement possible aux questions des acheteurs.</p>
                                                    
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
                                            <a aria-controls="buying-offer" aria-expanded="false" href="#buying-offer" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/check-accordion.png')}}" atl="check">L’OFFRE D’ACHAT ET LES NÉGOCIATIONS<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                        </h4>
                                     </div>
                                     <div aria-labelledby="headingSix" role="tabpanel" class="panel-collapse collapse" id="buying-offer" aria-expanded="false" style="height: 2px;">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                
                                                    <p>Au final, le but est de recevoir une offre d’achat pour votre propriété !</p>
                                                    
                                                    <p>Lorsqu’un acheteur potentiel vous présente une offre d’achat, prenez bien le temps de regarder toutes les données et toutes les conditions (exemples : le prix, la prise de possession, les conditions à réaliser, les inclusions et exclusion, etc.)</p>
                                                    
                                                    <p>Vous devrez ensuite répondre à l’offre d’achat en acceptant, en refusant ou en faisant une contre-proposition pour modifier les termes qui ne vous conviennent pas! À la suite d’une contre-proposition, l’acheteur devrai lui aussi y répondre et ainsi de suite.</p>
                                                    
                                                    <p>Si vous avez des questions à ces divers moments, vous pourrez vous renseigner auprès de votre courtier immobilier volontaire participant Immo-Clic.ca!</p>
                                                        
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
                                            <a aria-controls="buying-offer-conditions" aria-expanded="false" href="#buying-offer-conditions" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/check-accordion.png')}}" atl="check">LES CONDITIONS D’UNE OFFRE D’ACHAT<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                        </h4>
                                     </div>
                                     <div aria-labelledby="headingSeven" role="tabpanel" class="panel-collapse collapse" id="buying-offer-conditions" aria-expanded="false" style="height: 2px;">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                
                                                    <p>Si une offre d’achat se conclue en une entente officielle entre vous et un acheteur, il faudra s’assurer que toutes les conditions présentes dans l’offre d’achat se réaliseront dans les délais prescrit de l’offre d’achat (Si ce n’est pas le cas, l’offre d’achat deviendra nulle)</p>
                                                    
                                                    <p>Par exemple:</p>
                                                    
													<div class="stretch">
                                                    	
                                                        <ul>
                                                        	<li>L’inspection</li>
                                                            <li>Le certificat de localisation à jour</li>
                                                            <li>L’obtention de la preuve de financement de l’acheteur</li>
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
                                        <div id="headingEight" role="tab" class="panel-heading">
                                            <h4 class="panel-title">
                                                <a aria-controls="notary" aria-expanded="false" href="#notary" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed"><img src="{{URL::asset('website/images/check-accordion.png')}}" atl="check">LE NOTAIRE ET LE DÉMÉNAGEMENT!<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                            </h4>
                                         </div>
                                         <div aria-labelledby="headingEight" role="tabpanel" class="panel-collapse collapse" id="notary" aria-expanded="false" style="height: 2px;">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                    
                                                        <p>Quand toutes les conditions d’une offre d’achat sont remplies et que la date fixée entre les parties pour l’échange des clés est déterminée, il faudra passer devant le notaire à cette date pour officialiser la transaction immobilière.</p>
                                                        
                                                        <p>C’est normalement l’acheteur de la propriété qui a le choix du notaire. Informez-vous auprès de l’acheteur pour avoir les coordonnées du notaire choisi ainsi vous pourrez communiquez avec celui-ci si vous avez des questions.</p>
                                                        
                                                        <p>Votre courtier immobilier volontaire participant pourra aussi vous renseignez sur le processus si vous le contactez!</p>
                                                        
                                                        <p>Il faudra finalement déménager et procéder au passage chez le notaire. Celui-ci vous expliquera le déroulement et les documents à signer et vous devrez remettre les clés à l’acheteur! Votre maison sera officiellement vendue à ce moment !</p>
                                                            
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