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
                	
                    <h2>FAQ</h2>
                    
                    <!-- Start box -->
                    <div class="contant-box">
                    	
                        <!-- Start accordion -->
                        <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
                        
                            <!-- Start panel1 -->
                            <div class="panel panel-default">
                                <div id="headingOne" role="tab" class="panel-heading">
                                    <h4 class="panel-title">
                                        <a aria-controls="agency" aria-expanded="false" href="#agency" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">Est-ce que IMMO-CLIC est une agence immobilière ?<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                    </h4>
                                 </div>
                                 <div aria-labelledby="headingOne" role="tabpanel" class="panel-collapse collapse" id="agency" aria-expanded="false" style="height: 2px;">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12 faq-details">
                                            
                                                <p><b>NON</b></p>
                                                    
                                                <p>Immo-Clic.ca est une plateforme web offrant :</p>
                                                    
                                                <ul class="classic-list">
                                                    <li>des forfaits pour la vente sans intermédiaire de votre propriété</li>
                                                    <li>une sélection de courtiers immobiliers pour ceux qui désirent en trouver un</li>
                                                    <li>une sélection de spécialiste hypothécaire pour financer / renouveler une hypothèque.</li>
                                                    <li>un répertoire de partenaires (notaires, arpenteurs-géomètres, inspecteurs en bâtiments, peintres, etc.) permettant de tout trouver quand vient le temps d’acheter, de vendre ou de faire des travaux sur une propriété.</li>
                                                </ul>
                                                    
                                             </div>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                               <!-- End panel1 --> 
                           		
                               <!-- Start panel2 -->
                                <div class="panel panel-default">
                                    <div id="headingTwo" role="tab" class="panel-heading">
                                        <h4 class="panel-title">
                                            <a aria-controls="voluntary_broker" aria-expanded="false" href="#voluntary_broker" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">Qu’est-ce qu’un courtier immobilier volontaire Immo-Clic.ca ?<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                        </h4>
                                     </div>
                                     <div aria-labelledby="headingTwo" role="tabpanel" class="panel-collapse collapse" id="voluntary_broker" aria-expanded="false" style="height: 2px;">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12 faq-details">
                                                        
                                                    <p>Un courtier immobilier volontaire Immo-Clic.ca, est un courtier immobilier titulaire d’un permis de courtier immobilier valide délivré par l'OACIQ (Organisme d’autoréglementation du Courtage Immobilier du Québec) et qui fait partie du répertoire Immo-Clic.ca.</p>
                                                                                                              
                                                 </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                   <!-- End panel2 --> 
                                   
                                <!-- Start panel3 -->
                                <div class="panel panel-default">
                                    <div id="headingThree" role="tab" class="panel-heading">
                                        <h4 class="panel-title">
                                            <a aria-controls="voluntary_broker_doing" aria-expanded="false" href="#voluntary_broker_doing" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">Que fait un courtier immobilier volontaire Immo-Clic.ca ?<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                        </h4>
                                     </div>
                                     <div aria-labelledby="headingThree" role="tabpanel" class="panel-collapse collapse" id="voluntary_broker_doing" aria-expanded="false" style="height: 2px;">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12 faq-details">
                                                        
                                                    <p>Les courtiers immobiliers volontaires Immo-Clic.ca vous aideront d’abord à la fixation d’un prix de vente juste en se déplaçant directement chez vous pour donner une opinion de la juste valeur marchande de votre propriété. Lors de cette rencontre, ils vous aideront également pour effectuer une mise en marché réussi et efficace. Pendant la durée de votre forfait, les courtiers immobiliers volontaires peuvent également répondre à vos questions relativement à la vente de votre propriété.</p>
                                                                                                              
                                                 </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                   <!-- End panel3 -->
                                   
                                    <!-- Start panel4 -->
                                    <div class="panel panel-default">
                                        <div id="headingFour" role="tab" class="panel-heading">
                                            <h4 class="panel-title">
                                                <a aria-controls="voluntary_broker_help" aria-expanded="false" href="#voluntary_broker_help" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">Comment puis-je bénéficier de l’accompagnement d’un courtier immobilier volontaire Immo-Clic.ca ?<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                            </h4>
                                         </div>
                                         <div aria-labelledby="headingFour" role="tabpanel" class="panel-collapse collapse" id="voluntary_broker_help" aria-expanded="false" style="height: 2px;">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-12 faq-details">
                                                            
                                                        <p>C’est en achetant un des trois forfaits Immo-Clic.ca pour vendre votre propriété sans intermédiaire que vous pourrez sélectionner jusqu’à trois courtiers immobiliers volontaires qui se déplaceront chez vous pour vous aider à la fixation de votre prix de vente et à la mise en vente de votre propriété. Pendant la durée de votre forfait Immo-Clic.ca, vous pourrez également communiquez avec un des courtiers immobiliers volontaires que vous aurez sélectionné pour poser vos questions relativement à la vente de votre propriété.</p>
                                                                                                                  
                                                     </div>
                                                 </div>
                                              </div>
                                           </div>
                                        </div>
                                       <!-- End panel4 -->
                                       
                                    <!-- Start panel5 -->
                                    <div class="panel panel-default">
                                        <div id="headingFive" role="tab" class="panel-heading">
                                            <h4 class="panel-title">
                                                <a aria-controls="voluntary_broker_free_help" aria-expanded="false" href="#voluntary_broker_free_help" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">Dois-je signer un contrat et verser une commission au courtier immobilier volontaire Immo-Clic.ca lors de l’achat d’un forfait Immo-Clic.ca ?<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                            </h4>
                                         </div>
                                         <div aria-labelledby="headingFive" role="tabpanel" class="panel-collapse collapse" id="voluntary_broker_free_help" aria-expanded="false" style="height: 2px;">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-12 faq-details">
                                                            
                                                        <p>NON,  le support des courtiers immobiliers volontaires Immo-Clic.ca est inclus dans votre forfait pour la durée de celui-ci. Vous n’avez aucun contrat à signer avec un courtier immobilier volontaire pour vendre votre propriété avec un forfait Immo-Clic.ca.</p>
                                                                                                                  
                                                     </div>
                                                 </div>
                                              </div>
                                           </div>
                                        </div>
                                       <!-- End panel5 -->
                                       
                                        <!-- Start panel6 -->
                                        <div class="panel panel-default">
                                            <div id="headingSix" role="tab" class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a aria-controls="sign_contract" aria-expanded="false" href="#sign_contract" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">Puis-je signer un contrat de courtage avec un courtier immobilier pour la vente de ma propriété si mon forfait Immo-Clic.ca n’est pas terminé ?<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                                </h4>
                                             </div>
                                             <div aria-labelledby="headingSix" role="tabpanel" class="panel-collapse collapse" id="sign_contract" aria-expanded="false" style="height: 2px;">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-sm-12 faq-details">
                                                                
                                                            <p>OUI bien sûr! Immo-Clic.ca est là pour vous aider dans la vente de votre propriété, que vous vouliez vendre par vous-même ou avec un courtier immobilier. Donc si vous décidez de vendre votre propriété avec un courtier immobilier suite à l’achat d’un forfait Immo-Clic.ca et que vous avez développé une belle complicité avec un de vos courtiers immobiliers volontaires, vous pouvez sans aucun problème signez un contrat de courtage avec celui-ci. Pour encourager la collaboration entre les particuliers et les courtiers immobiliers volontaires, Immo-Clic.ca permet également à ses courtiers immobiliers volontaires d’avoir gratuitement accès aux photos professionnels qui auront été prises dans le cadre de votre forfait Immo-Clic.ca.</p>
                                                                                                                      
                                                         </div>
                                                     </div>
                                                  </div>
                                               </div>
                                            </div>
                                           <!-- End panel6 -->
                                           
                                           
                                        <!-- Start panel7 -->
                                        <div class="panel panel-default">
                                            <div id="headingSeven" role="tab" class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a aria-controls="broker_utility" aria-expanded="false" href="#broker_utility" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">Pourquoi un courtier immobilier agit-il à titre de courtier immobilier volontaire Immo-Clic.ca ?<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                                </h4>
                                             </div>
                                             <div aria-labelledby="headingSeven" role="tabpanel" class="panel-collapse collapse" id="broker_utility" aria-expanded="false" style="height: 2px;">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-sm-12 faq-details">
                                                                
                                                            <p>Pour les courtiers immobiliers volontaires, Immo-Clic.ca représente une belle opportunité de faire valoir leurs qualités en tant que courtier immobilier en aidant les vendeurs à fixer un prix de vente juste et à réaliser une mise en marché efficace. En développant une relation de qualité et de confiance avec les vendeurs, les courtiers immobiliers volontaires promouvoient ainsi un service à la clientèle de qualité et favorise une bonne opinion envers la profession de courtier immobilier. De ce fait, si le vendeur décide finalement de faire affaire avec courtier immobilier pour vendre sa propriété ou pour acheter sa prochaine propriété, le courtier immobilier volontaire qui l’aura accompagné dans son processus de vente sans intermédiaire aura de bonne chance d’être le choix du vendeur! Et si le vendeur n’a pas besoin de recourir au service d’un courtier immobilier mais qu’une personne de son entourage en a besoin d’un, il y aura de bonne chance que celui-ci parle de son courtier immobilier volontaire Immo-Clic.ca!</p>
                                                                                                                      
                                                         </div>
                                                     </div>
                                                  </div>
                                               </div>
                                            </div>
                                           <!-- End panel7 -->                                 
                        </div>
                		<!-- End accordion -->
                	</div>
                	<!-- End box -->
                    
                    <p class="last-text"><b>Si vous avez d’autres questions, n’hésitez pas à nous écrire à <a href="mailto:info@immo-clic.ca">info@immo-clic.ca</a>, il nous fera un grand plaisir de vous répondre!</b></p>
                    
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