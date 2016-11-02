@extends('layouts.master')
    @section('content') 
        @include('include.search') 
        <!--content start-->
        <div class="content-box">
            <div class="container">
                <div id="link" style="position:absolute;z-index: 10;background:white;padding: 10px;display:none;width:250px;"></div>
        		<div class="row">
            		<div class="col-sm-2">
                		@include('include.left-menu')
           			</div>
                    
           			<!--product table start-->
           			<div class="packages col-sm-10">
                		<div class="tbl_scroll">
							<h2>Les forfaits <span>Immo-clic.ca</span></h2>
                            
                            <span class="how-it-works"><a title="Comment ça marche?" href="{{ url($lang.'/comment-ca-marche') }}">Comment ça marche <i class="fa fa-question-circle"></i></a></span>
                            
                            <table class="dimen_tbl">
                            	<thead>
                                	<tr>
                                    	<th colspan="2" class="market">La mise en marché</th>
                                        <th>L'économique</th>
                                        <th>L'avantageux</th>
                                        <th>L'ultime</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<tr class="first-row">
                                    	<td class="package-desc">Renseignements fournis par les courtiers immobiliers volontaires participants</td>
                                    	<td><img src="{{URL::asset('website/images/point-interogation.png')}}" class="interogation" atl="Bulle d'aide" tooltip="Tous nos forfaits sont bien SANS COMMISSION et comprennent les renseignements suivants fournis par les courtiers immobiliers volontaires! Les courtiers immobiliers participant sont bien VOLONTAIRES pour vous rencontrer gratuitement, sans aucune obligation! Vous pourrez choisir à votre convenance, de 1 à 3 courtiers immobiliers volontaires dans notre répertoire."></td>
                                        <td colspan="3">
                                        	<!--<p>Tous nos forfaits sont bien <b>SANS COMMISSION</b> </p> <p><b>et</b></p> <p> comprennent les renseignements suivants fournis par les courtiers immobiliers volontaires! Les courtiers immobiliers participant sont bien VOLONTAIRE pour vous rencontrer gratuitement, sans aucune obligation.</p> -->
                                            <p><b>Cela inclus :</b></p> 
                                            <ul>
                                            	<li>- Une rencontre à domicile pour l’aide à la mise en marché et à l’établissement du prix de vente -</li>
                                                <li>- Des idées pour la mise en valeur de la propriété -</li>
                                                <li>- Une disponibilité téléphonique pour toute la durée de votre forfait -</li>
                                            </ul>                                        
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td class="package-desc">Opinion de valeur marchande de votre propriété sur place</td>
                                    	<td><img src="{{URL::asset('website/images/point-interogation.png')}}" class="interogation" atl="Bulle d'aide" tooltip="Lorsque vous aurez choisi vos courtiers immobiliers volontaires, ceux-ci vous contacteront pour fixer un rendez-vous auquel ils pourront vous donner leur opinion de la valeur marchande de la propriété."></td>                                    	
                                        <td colspan="3"><p>Tous nos forfaits comprennent l’opinion de la valeur marchande de votre propriété faites sur place par les courtiers immobiliers volontaires pour vous aider à établir un prix de vente juste!</p></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="tbl_scroll table-plus"> 
                        	<h2>Vous avez des questions? <span>Appelez nous au 1-844-321-CLIC !</span></h2> 
                            <table class="dimen_tbl">    
                                <tbody>
                                    <tr class="first-row-plus grey-text">
                                    	<td class="package-desc">Photo HDR professionnelle</td>
                                    	<td><img src="{{URL::asset('website/images/point-interogation.png')}}" class="interogation" atl="Bulle d'aide" tooltip="Les photographes professionnels de Photo Optimale vous offre une solution professionnelle et adaptée afin de mettre en valeur chaque pièce de votre propriété. Grâce à la technologie HDR, les contrastes seront optimisés de manière à faire ressortir de façon unique les environnements tant intérieurs qu’extérieurs."></td>                                    	
                                        <td>10</td>
                                        <td>16</td>
                                        <td>24</td>
                                    </tr>
                                    <tr class="grey-text">
                                    	<td class="package-desc">Affichage sur Immo-Clic.ca</td>
                                    	<td><img src="{{URL::asset('website/images/point-interogation.png')}}" class="interogation" atl="Bulle d'aide" tooltip="Votre annonce sera affichée sur Immo-Clic.ca pour la période incluse dans votre forfait et sera donc présente dans les résultats de recherches des acheteurs potentiels."></td>                                    	
                                        <td>4 mois</td>
                                        <td>6 mois</td>
                                        <td>Jusqu’à la vente</td>
                                    </tr>
                                    <tr>
                                    	<td class="package-desc">Affiche « À vendre » personnalisée</td>
                                    	<td><img src="{{URL::asset('website/images/point-interogation.png')}}" class="interogation" atl="Bulle d'aide" tooltip="Votre affiche Immo-Clic.ca vous sera remise par le photographe lors de la prise de photos. Votre affiche Immo-Clic.ca sera personnalisée avec votre numéro de téléphone et grâce à sa forme originale, les acheteurs potentiels qui circuleront dans votre secteur pourront facilement apercevoir que votre propriété est à vendre et ainsi vous contacter!"></td>                                    	
                                        <td><img src="{{URL::asset('website/images/check.png')}}" atl="check"></td>
                                        <td><img src="{{URL::asset('website/images/check.png')}}" atl="check"></td>
                                        <td><img src="{{URL::asset('website/images/check.png')}}" atl="check"></td>
                                    </tr>
                                    <tr class="last-row grey-text">
                                    	<td class="package-desc">Propriété vedette sur <br /> Immo-Clic.ca</td>
                                    	<td><img src="{{URL::asset('website/images/point-interogation.png')}}" class="interogation" atl="Bulle d'aide" tooltip="Votre annonce paraîtra directement sur la page d’accueil pour la période incluse dans votre forfait, en plus de ressortir dans les résultats de recherche des acheteurs potentiels."></td>                                    	
                                        <td><i class="fa fa-minus"></i></td>
                                        <td>1 semaine</td>
                                        <td>2 semaines</td>
                                    </tr>
                                </tbody>
                            </table>
           				</div>
                        
                        <div class="tbl_scroll table-plus">
							<h2>Les plus <span>Immo-clic.ca</span></h2>
                            <table class="dimen_tbl">
                                <tbody>
                                	<tr class="first-row-plus">
                                    	<td class="package-desc">Aide à la rédaction et mise en ligne de votre l’annonce</td>
                                    	<td><img src="{{URL::asset('website/images/point-interogation.png')}}" class="interogation" atl="Bulle d'aide" tooltip="Lorsque vous serez prêt à créer votre annonce, vous n’aurez qu’à nous appeler au 1-844-321-CLIC (2542) et un représentant Immo-Clic.ca saisira avec vous les informations relatives à votre propriété et procèdera à la mise en ligne de votre annonce. Service compris dans les forfaits L’Avantageux et L’Ultime."></td>                                    	
                                        <td><i class="fa fa-minus"></i></td>
                                        <td><img src="{{URL::asset('website/images/check.png')}}" atl="check"></td>
                                        <td><img src="{{URL::asset('website/images/check.png')}}" atl="check"></td>
                                    </tr>
                                    <tr>
                                    	<td class="package-desc">CHOIX entre: <br /> Consultation <br /> Home staging 1h <br /> OU <br /> Certificat-cadeau <br /> du Groupe Adèle inc. de 100$*</td>
                                    	<td>
                                            <img src="{{URL::asset('website/images/point-interogation.png')}}" class="interogation" atl="Bulle d'aide" tooltip="Consultation d’une heure avec une décoratrice professionnelle qui vous conseillera sur la préparation et la mise en place de votre propriété avant la prise de photos. Aucune valeur monétaire.">
                                            <br /><br /><br /><br />
                                            <img src="{{URL::asset('website/images/point-interogation.png')}}" class="interogation" atl="Bulle d'aide" tooltip="Certificat-cadeau de 100 $ applicable sur le dernier service d’entretien régulier lors d’une entente signée pour 8 services d’entretien régulier OU applicable sur un premier service de grand ménage de $500 et plus. Aucune valeur monétaire.">
                                        </td>
                                        <td><i class="fa fa-minus"></i></td>
                                        <td><i class="fa fa-minus"></i></td>
                                        <td><img src="{{URL::asset('website/images/check.png')}}" atl="check"></td>
                                    </tr>
                                    <tr class="last-row">
                                    	<td class="package-desc">Promo web personnalisée et ciblée sur Facebook et Kijiji (valeur de 100$)</td>
                                    	<td><img src="{{URL::asset('website/images/point-interogation.png')}}" class="interogation" atl="Bulle d'aide" tooltip="Publication sponsorisée ciblée (secteurs et profil d'acheteurs potentiels) de votre propriété sur Facebook ainsi qu'une annonce personnalisée sur Kijiji."></td>                                    	
                                        <td><i class="fa fa-minus"></i></td>
                                        <td><i class="fa fa-minus"></i></td>
                                        <td><img src="{{URL::asset('website/images/check.png')}}" atl="check"></td>
                                    </tr>
                                </tbody>
                            </table>
           				</div>
                        
                        <div class="tbl_scroll table-plus">
							<h2>vos outils <span>Immo-clic.ca</span></h2>
                            <table class="dimen_tbl">
                                <tbody>
                                	<tr class="first-row-plus">
                                    	<td class="package-desc">Formulaires légaux</td>
                                    	<td><img src="{{URL::asset('website/images/point-interogation.png')}}" class="interogation" atl="Bulle d'aide" tooltip="Des modèles de formulaires légaux généraux sont mis à votre disposition que vous pourrez utiliser pour procéder à la vente de votre propriété. Vous pourrez les modifier selon votre situation et Immo-Clic.ca vous recommande de consulter un professionnel de votre choix si vous avez des questions lorsque vous aurez à remplir ces documents."></td>                                   	
                                        <td><img src="{{URL::asset('website/images/check.png')}}" alt="check"/></td>
                                        <td><img src="{{URL::asset('website/images/check.png')}}" alt="check"/></td>
                                        <td><img src="{{URL::asset('website/images/check.png')}}" alt="check"/></td>
                                    </tr>
                                    <tr>
                                    	<td class="package-desc">Support technique</td>
                                    	<td><img src="{{URL::asset('website/images/point-interogation.png')}}" class="interogation" atl="Bulle d'aide" tooltip="Si vous avez un problème technique avec votre annonce, vous pouvez contactez notre service à la clientèle du lundi au jeudi de 8h à 20h et du Vendredi au Dimanche de 8h à 17h."></td>                                    	
                                        <td><img src="{{URL::asset('website/images/check.png')}}" alt="check"/></td>
                                        <td><img src="{{URL::asset('website/images/check.png')}}" alt="check"/></td>
                                        <td><img src="{{URL::asset('website/images/check.png')}}" alt="check"/></td>
                                    </tr>
                                    <tr>
                                    	<td class="package-desc">Service à la clientèle <br /> 7 jours sur 7</td>
                                    	<td><img src="{{URL::asset('website/images/point-interogation.png')}}" class="interogation" atl="Bulle d'aide" tooltip="Si vous avez des questions, vous pouvez contactez notre service à la clientèle du lundi au jeudi de 8h à 20h et du Vendredi au Dimanche de 8h à 17h."></td>                                   	
                                        <td><img src="{{URL::asset('website/images/check.png')}}" alt="check"/></td>
                                        <td><img src="{{URL::asset('website/images/check.png')}}" alt="check"/></td>
                                        <td><img src="{{URL::asset('website/images/check.png')}}" alt="check"/></td>
                                    </tr>
                                    <tr>
                                    	<td class="package-desc">Guide et outils en ligne</td>
                                    	<td><img src="{{URL::asset('website/images/point-interogation.png')}}" class="interogation" atl="Bulle d'aide" tooltip="Parcourez Immo-Clic.ca pour trouver de l’information qui pourra vous être utile lors de la vente ou l’achat d’une propriété!"></td>                                   	
                                        <td><img src="{{URL::asset('website/images/check.png')}}" alt="check"/></td>
                                        <td><img src="{{URL::asset('website/images/check.png')}}" alt="check"/></td>
                                        <td><img src="{{URL::asset('website/images/check.png')}}" alt="check"/></td>
                                    </tr>
                                    <tr class="package-price">
                                    	<td class="no-border"></td>
                                    	<td class="no-border"></td>
                                        <td>194,<sup>95$</sup></td>
                                        <td>299,<sup>95$</sup></td>
                                        <td>449,<sup>95$</sup></td>
                                    </tr>
                                 </tbody>
                             </table>
                        </div>
                                   
                        <div class="tbl_scroll table-plus">            
                            <table class="dimen_tbl">    
                            	<thead>
                                	<tr>
                                    	<th colspan="2" class="sector-select">{{Lang::get('website-lang.select_our_sector')}}</th>
                                        <th>L'économique</th>
                                        <th>L'avantageux</th>
                                        <th>L'ultime</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                	    <th colspan="2" class="area-select">
                                            <div class="text_field area-select">
                                                <ul class="selector">
                                                    <li class="dropdown">
                                                      <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         <span id="SelectedSectorNamePackage">
                                                             @if(!isset($_COOKIE['SectorName']))
                                                             {{Lang::get('website-lang.select_our_sector')}}
                                                             @else
                                                             {{ Helper::truncate_by_char($_COOKIE['SectorName'],12)}}
                                                             @endif
                                                         </span>
                                                         <span class="caret"></span>
                                                      </button> 
                                                      <ul class="dropdown-menu area sector-list" li-class="select-this-sector-package" IncludePartenaire="false" aria-labelledby="dLabel">
                                                      </ul>
                                                    </li>
                                                </ul>    
                                                @if(!isset($_COOKIE['SectorName']))
                                                <input id="PackageSector" type="hidden" name="PackageSector" value="" />
                                                @else
                                                <input id="PackageSector" type="hidden" name="PackageSector" value="{{$_COOKIE['SectorID']}}" />
                                                @endif
                                        	</div>
                                        </th>
                                	    <th>                        
                                            {!! Form::open(array('url' => Helper::SecureUrl(url('payment')),'method'=>'get','id'=>'classicForm'))!!}
                                            {!! Form::hidden('packageName','classic',['id'=>'classicPackage'])!!}
                                            {!! Form::hidden('packagePrice','',['id'=>'classicPrice'])!!}
                                            {!! Form::hidden('packageMonth','4',['id'=>'classicPrice'])!!}
                                            {!! Form::hidden('packageID','1',['id'=>'classicID'])!!}
                                            <button type="submit" id="classicBtn" class="btn sidebar_btn" onclick="return validateSector();">{{ Lang::get('website-lang.Choose') }}</button>
                                            {!! Form::close() !!}  
                                        </th>
                                        <th>
                                            {!! Form::open(array('url' => Helper::SecureUrl(url('payment')),'method'=>'get','id'=>'premiumForm'))!!}
                                            {!! Form::hidden('packageName','Premium',['id'=>'premiumPackage'])!!}
                                            {!! Form::hidden('packagePrice','',['id'=>'premiumPrice'])!!}
                                            {!! Form::hidden('packageMonth','6',['id'=>'premiumMOnth'])!!}
                                            {!! Form::hidden('packageID','2',['id'=>'premiumID'])!!}
                                            <button type="submit" id="premiumBtn" class="btn sidebar_btn" onclick="return validateSector();">{{ Lang::get('website-lang.Choose') }}</button>
                                            {!! Form::close() !!}    
                                        </th>
                                        <th>
                                            {!! Form::open(array('url' => Helper::SecureUrl(url('payment')),'method'=>'get','id'=>'prestigeForm'))!!}
                                            {!! Form::hidden('packageName','Prestige',['id'=>'prestigePackage'])!!}
                                            {!! Form::hidden('packagePrice','',['id'=>'prestigePrice'])!!}
                                            {!! Form::hidden('packageMonth','0',['id'=>'prestigeMonth'])!!}
                                            {!! Form::hidden('packageID','3',['id'=>'prestigeID'])!!}
                                            <button type="submit" id="prestigeBtn" class="btn sidebar_btn" onclick="return validateSector();">{{ Lang::get('website-lang.Choose') }}</button>
                                            {!! Form::close() !!}  
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div id="sectorNotDispo" style="display:none;">
                                <br />
                                <span>{{ Lang::get('website-lang.sorry_your_area_is_not_available') }}</span>
                                <br />
                                <a href="{{ str_replace('/mon-compte', '', url($lang.'/contact')) }}"><i class="fa fa-phone"></i> {{ Lang::get('website-lang.write_us')}}</a>
                            </div>
                            
                            <div class="package-questions">
                            	<h4>Si vous avez des questions sur les forfaits Immo-Clic.ca, composer le 1-844-321-CLIC !</h4>
                            </div>
                            
           				</div>
                        
           			</div>
           			<!--product table end-->
            
        </div>    
        </div>
        </div>
        <!--content end--> 
@stop