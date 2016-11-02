@extends('layouts.master')
    @section('content') 
        @include('include.header-menu') 
        <!--content start-->   
    <div class="content-box">     
        <div class="container">
            <div class="row"> 
                <div class="resgister-form"> 
                    <div class="stepwizard">
                        <div class="stepwizard-row setup-panel">
                            <ul class="nav nav-tabs clear">
                                <li role="presentation"><div class="stepwizard-step"><a href="#step-1" type="button" class="steps-register-house btn-circle btn-default btn-primary">MON ANNONCE</a></div></li>
                                <li role="presentation"><div class="stepwizard-step"><a href="#step-2" type="button" class="steps-register-house btn-default btn-circle">POUR ME CONTACTER</a></div></li>
                                <li role="presentation"><div class="stepwizard-step"><a href="#step-3" type="button" class="steps-register-house btn-default btn-circle">LOCALISATION</a></div></li>
                                <li role="presentation"><div class="stepwizard-step"><a href="#step-4" type="button" id="tab-carte" class="steps-register-house btn-default btn-circle @if(Helper::ValidateUserHaveAccesToMap($get_register_building[0]->id) != "") disabled @endif" @if(Helper::ValidateUserHaveAccesToMap($get_register_building[0]->id) != "") onclick="return AccesDeniedForMapTab(event);"@else onclick="return LoadMap()" @endif>CARTE</a></div></li>
                                <li role="presentation"><div class="stepwizard-step"><a href="#step-5" type="button" class="steps-register-house btn-default btn-circle">DIMENSION</a></div></li>
                                <li role="presentation"><div class="stepwizard-step"><a href="#step-6" type="button" class="steps-register-house btn-default btn-circle">ÉVALUATION MUNICIPALE</a></div></li>
                                <li role="presentation"><div class="stepwizard-step"><a href="#step-7" type="button" class="steps-register-house btn-default btn-circle">FRAIS MENSUELS / TAXES</a></div></li>
                                <li role="presentation"><div class="stepwizard-step"><a href="#step-8" type="button" class="steps-register-house btn-default btn-circle">INCLUSIONS / EXCLUSIONS</a></div></li>
                                <li role="presentation"><div class="stepwizard-step"><a href="#step-9" type="button" class="steps-register-house btn-default btn-circle">DIMENSIONS DES PIÈCES</a></div></li>
                                <li role="presentation"><div class="stepwizard-step"><a href="#step-10" type="button" class="steps-register-house btn-default btn-circle">BÂTIMENT ET INTÉRIEUR</a></div></li>
                                <li role="presentation"><div class="stepwizard-step"><a href="#step-11" type="button" class="steps-register-house btn-default btn-circle">TERRAIN ET EXTÉRIEUR</a></div></li>
                                <li role="presentation"><div class="stepwizard-step"><a href="#step-12" type="button" class="steps-register-house btn-default btn-circle">LOYERS</a></div></li>
                                <li role="presentation"><div class="stepwizard-step"><a href="#step-13" type="button" class="steps-register-house btn-default btn-circle">AUTRES DÉTAILS</a></div></li>
                            </ul>
                        </div>
                    </div> 
                    <br />
                  <input type="hidden" name="house_id" id="house_id" value="{{$buld_id}}">
                    <!-- <form role="form" action="" method="post"> -->
                    @if(!empty($get_register_building[0]->TypeID))
                      {{--*/ $es_type = $get_register_building[0]->TypeID /*--}}
                      @else
                      {{--*/ $es_type = '' /*--}}
                     @endif
                     @if(!empty($get_register_building[0]->Price))
                      {{--*/ $Price = $get_register_building[0]->Price /*--}}
                      @else
                      {{--*/ $Price = '' /*--}}
                     @endif
                     @if(!empty($get_register_building[0]->precisionID))
                      {{--*/ $precisionID = $get_register_building[0]->precisionID /*--}}
                      @else
                      {{--*/ $precisionID = '' /*--}}
                     @endif  
                     @if(!empty($get_register_building[0]->CategoryID))
                      {{--*/ $CategoryID = $get_register_building[0]->CategoryID /*--}}
                      @else
                      {{--*/ $CategoryID = '' /*--}}
                     @endif 
                     @if(!empty($get_register_building[0]->Built_in))
                      {{--*/ $Built_in = $get_register_building[0]->Built_in /*--}}
                      @else
                      {{--*/ $Built_in = '' /*--}}
                     @endif 
                     @if(!empty($get_register_building[0]->Free_tour))
                      {{--*/ $Free_tour = $get_register_building[0]->Free_tour /*--}}
                      @else
                      {{--*/ $Free_tour = '' /*--}}
                     @endif
                     @if(!empty($get_register_building[0]->Brand_new))
                      {{--*/ $Brand_new = $get_register_building[0]->Brand_new /*--}}
                      @else
                      {{--*/ $Brand_new = '' /*--}}
                     @endif
                     @if(!empty($get_register_building[0]->Description_fr))
                      {{--*/ $Description_fr = $get_register_building[0]->Description_fr /*--}}
                      @else
                      {{--*/ $Description_fr = '' /*--}}
                     @endif  
                     @if(!empty($get_register_building[0]->Description_en))
                      {{--*/ $Description_en = $get_register_building[0]->Description_en /*--}}
                      @else
                      {{--*/ $Description_en = '' /*--}}
                     @endif              

                    {!! Form::open(array('url' => URL::to('/'),'id'=>'form1','data_id'=>'1','method'=>'post','role'=>'form'))!!}   
                        <div style="display: block;" class="setup-content" id="step-1">
                            <i>Pour enregistrer vos informations, cliquer sur le bouton "sauvegarder" au bas de la page. Vous serez ensuite automatiquement redirigé vers la prochaine étape.</i><br /><br />
                            <div class="col-sm-12"><h3 class="step-title">Mon annonce – Étape 1/13</h3></div>
                            <div class="clear">               
                              <div class="form-group col-sm-6">
                                <label class="control-label">Type de propriété</label>
                                <div class="select-box">
                                {!! Form::select('categories_type', $categories_type, $CategoryID, ['id' => 'categories_type']) !!}                                   
                                </div>
                              </div>  
                              <div class="form-group col-sm-6">
                                <label class="control-label">Prix demandé</label>
                                {!! Form::text('price',$Price,array('maxlength' => '100','placeholder'=>'Prix demandé','id'=>'price')) !!}
                                <div id="price_error" style="color:red"></div>
                              </div>                  
                              <div class="form-group col-sm-6">
                                <label class="control-label">Précision</label>
                                <div class="select-box">
                                    {!! Form::select('precision_type', $precision_type, $precisionID, ['id' => 'precision_type']) !!}
                                </div>
                              </div>                   
                              <div class="form-group col-sm-6">
                                <label class="control-label">Sous-types de propriété</label>
                                <div class="select-box">                                   
                                    {!! Form::select('estate_type', $esatte_type, $es_type , ['id' => 'estate_type']) !!}
                                </div>
                              </div>                 
                              <div class="form-group col-sm-6">
                                <label class="control-label">Année de construction</label>
                                
                                  <div class="select-box">
                                  <select name="year" id="year">
                                    <option value="0">Veuillez choisir...</option>
                                    @for ($i = date('Y'); $i >= 1900; $i--)
                                        <option value="{{$i}}"
                                        @if($Built_in==$i)
                                        selected="selected" 
                                        @endif
                                        >{{$i}}</option>
                                    @endfor
                                  </select>                                    
                                  </div>
                                
                              </div>                  
                              <div class="form-group col-sm-12">
                                <ul>
                                    <li>{!! Form::checkbox('free_visit','',$Free_tour,['id' => 'free_visit']) !!}<label class="check-label">En visite libre</label></li>
                                    <li>{!! Form::checkbox('new','',$Brand_new,['id' => 'new']) !!}<label class="check-label">Neuve</label></li>
                                </ul>
                              </div>                  
                              <div class="form-group col-sm-6">
                                <label class="control-label">Description français</label>
                                {!! Form::textarea('desc1',$Description_fr,array('id'=>'desc1')) !!}
                              </div>                  
                              <div class="form-group col-sm-6">
                                <label class="control-label">Description anglais</label>
                                {!! Form::textarea('desc2',$Description_en,array('id'=>'desc2')) !!}
                              </div>    
                              <div class="col-sm-12">
                              <button class="nextBtn pull-right" type="submit">Sauvegarder</button>
                                <a class="nextBtn pull-left" style="margin-left:10px;width:150px;" target="_blank" href="{{URL::to($lang.'/propriete?id='.$get_register_building[0]->id) }}">pré-visualiser</a>
                              </div>
                        
                            </div>                
                        </div>
                        {!! Form::close() !!}
                        @if(!empty($my_profile->Phone))
                          {{--*/ $phone = $my_profile->Phone /*--}}
                        @else
                          {{--*/ $phone = '' /*--}}
                        @endif  
                        @if(!empty($my_profile->Cell))
                          {{--*/ $Cell = $my_profile->Cell /*--}}
                        @else
                          {{--*/ $Cell = '' /*--}}
                        @endif  
                        {!! Form::open(array('url' => URL::to('/'),'id'=>'form2','data_id'=>'2','method'=>'post','role'=>'form'))!!}   
                        <div style="display: none;" class="setup-content normal-height" id="step-2">
                            <i>Pour enregistrer vos informations, cliquer sur le bouton "sauvegarder" au bas de la page. Vous serez ensuite automatiquement redirigé vers la prochaine étape.</i><br /><br />
                        <div class="clear">
                            <div class="col-sm-3 pull-right" style="display:none;">
                                <button class="prevBtn pull-left" type="button">Précédent</button>
                                <button class="nextBtn pull-right" type="submit">Sauvegarder</button>
                                <a class="nextBtn pull-left" style="margin-left:10px;width:150px;" target="_blank" href="{{URL::to($lang.'/propriete?id='.$get_register_building[0]->id) }}">pré-visualiser</a>
                            </div>
                        </div>
                        <div class="clear">
                               <div class="col-sm-6">
                                    
                                      <div class="box-title">Pour me contacter – Étape 2/13
                                      </div>
                                    
                                      <!-- Tab panes -->
                                      <div class="setup-content-box clear">
                                            <div class="row">
                                                <div class="form-group col-sm-8">
                                                    <label class="control-label">Téléphone</label>                                                   
                                                    {!! Form::text('telephone',$phone,array('placeholder'=>'Téléphone','id'=>'telephone', 'help1' => "Inscrivez le numéro de téléphone où vous désirez être joint par les acheteurs intéressés par votre propriété!")) !!}
                                                    <div id="tele_error" style="color:red"></div>
                                                </div>
                                                <div class="form-group col-sm-8">
                                                    <label class="control-label">Autre numéro de téléphone</label>
                                                    {!! Form::text('cellulaire',$Cell,array('placeholder'=>'Céllulaire','id'=>'cellulaire', 'help1' => "Inscrivez votre numéro de cellulaire si vous désirez être joint à ce numéro par les acheteurs intéressés par votre propriété!")) !!}                                                    
                                                    <div id="cell_error" style="color:red"></div>
                                                </div>
                                            </div>
                                        
                                      </div> 
                                </div>
                                <div class="col-sm-6 textarea-height">
                                  {!! Form::textarea('help1', "Lorsque vous cliquerez dans un champ de saisie (ex.: Téléphone), c'est ici que vous pourrez voir des indications concernant le champ en question !" ,array('help' => "Lorsque vous cliquerez dans un champ de saisie (ex.: Téléphone), c'est ici que vous pourrez voir des indications concernant le champ en question !",'id'=>'help1')); !!}
                                <h4>Si vous avez des questions, appelez-nous au 1-844-31-CLIC (2542) !</h4>
                                </div>
                                <div class="col-sm-12">
                                    <button class="prevBtn pull-left" type="button">Précédent</button>
                                    <button class="nextBtn pull-right" type="submit">Sauvegarder</button>
                                <a class="nextBtn pull-left" style="margin-left:10px;width:150px;" target="_blank" href="{{URL::to($lang.'/propriete?id='.$get_register_building[0]->id) }}">pré-visualiser</a>
                                </div>                    
                          </div>
                        </div>
                        {!! Form::close() !!}
                        @if(!empty($get_register_building[0]->RegionID))
                          {{--*/ $RegionID = $get_register_building[0]->RegionID /*--}}
                        @else
                          {{--*/ $RegionID = '' /*--}}
                        @endif
                        @if(!empty($get_register_building[0]->CityID))
                          {{--*/ $CityID = $get_register_building[0]->CityID /*--}}
                        @else
                          {{--*/ $CityID = '' /*--}}
                        @endif
                        @if(!empty($get_register_building[0]->StreetType))
                          {{--*/ $StreetType = $get_register_building[0]->StreetType /*--}}
                        @else
                          {{--*/ $StreetType = '' /*--}}
                        @endif
                        @if(!empty($get_register_building[0]->StreetName))
                          {{--*/ $StreetName = $get_register_building[0]->StreetName /*--}}
                        @else
                          {{--*/ $StreetName = '' /*--}}
                        @endif
                        @if(!empty($get_register_building[0]->HouseNumber))
                          {{--*/ $HouseNumber = $get_register_building[0]->HouseNumber /*--}}
                        @else
                          {{--*/ $HouseNumber = '' /*--}}
                        @endif
                        @if(!empty($get_register_building[0]->Postal_code))
                          {{--*/ $Postal_code = $get_register_building[0]->Postal_code /*--}}
                        @else
                          {{--*/ $Postal_code = '' /*--}}
                        @endif
                        
                        {!! Form::open(array('url' => URL::to('/'),'id'=>'form3','data_id'=>'3','method'=>'post','role'=>'form'))!!}   
                        <div style="display: none;" class="setup-content" id="step-3">
                            <i>Pour enregistrer vos informations, cliquer sur le bouton "sauvegarder" au bas de la page. Vous serez ensuite automatiquement redirigé vers la prochaine étape.</i><br /><br />
                        <div class="clear">
                            <div class="col-sm-3 pull-right" style="display:none;">
                                <button class="prevBtn pull-left" type="button">Précédent</button>
                                <button class="nextBtn pull-right" type="submit">Sauvegarder</button>
                                <a class="nextBtn pull-left" style="margin-left:10px;width:150px;" target="_blank" href="{{URL::to($lang.'/propriete?id='.$get_register_building[0]->id) }}">pré-visualiser</a>
                            </div>
                        </div>
                            <div class="col-sm-6">
                                
                                <div class="box-title">
                                    Localisation – Étape 3/13
                                </div>
                        
                                <div class="setup-content-box clear">
                                    <div class="row">
                                        <div class="form-group col-sm-8">
                                            <label class="control-label">Région</label>
                                            <div class="select-box" help2="Choisissez la région où se situe la ville de la propriété que vous désirez vendre.">
                                            {{-- */$region['']='Veuillez sélectionner la Région'/* --}}
                                                @foreach($regions as $re)
                                                    {{-- */$region[$re['id']]=$re['Name'];/* --}}
                                                @endforeach
                                                {!! Form::select('regions', $region, $RegionID, ['id' => 'region_third']) !!}
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-sm-8">
                                            <label class="control-label">Ville</label>
                                            <div class="select-box">
                                            
                                                <select id="option_ville" help2="Choisissez la ville où se situe la propriété que vous désirez vendre.">
                                                    <option value="">Veuillez sélectionner la Ville</option>
                                                    @if(!empty($building_city))
                                                    @foreach($building_city as $cities)                            
                                                      <option value="{{$cities->id}}"
                                                      @if($cities->id==$CityID)
                                                        selected="selected"
                                                      @endif
                                                      >{{$cities->CityName}}</option>
                                                    @endforeach   
                                                    @endif                                                   
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-sm-8">
                                            <label class="control-label">Type d'artère</label>
                                            <div class="select-box">
                                                 <select name="input_name" id="input_id" help2="Choisissez le type d'artère où se situe la propriété que vous désirez vendre.">
                                                    <option value="">Veuillez sélectionner un type d'artère</option>
                                                    <option value="1" 
                                                    @if($StreetType==1)
                                                    selected="selected" 
                                                    @endif
                                                    >Rue</option>
                                                    <option value="2"
                                                     @if($StreetType==2)
                                                    selected="selected" 
                                                    @endif
                                                    >Boulevard</option>
                                                    <option value="3"
                                                     @if($StreetType==3)
                                                    selected="selected" 
                                                    @endif
                                                    >Avenue</option>
                                                    <option value="4"
                                                     @if($StreetType==4)
                                                    selected="selected" 
                                                    @endif
                                                    >Rang</option>
                                                    <option value="5"
                                                     @if($StreetType==5)
                                                    selected="selected" 
                                                    @endif
                                                    >Route</option>
                                                    <option value="6"
                                                     @if($StreetType==6)
                                                    selected="selected" 
                                                    @endif
                                                    >Chemin</option>

                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-sm-8">
                                            <label class="control-label">Nom de l'artère</label>
                                            @if($StreetName == "")
                                                {!! Form::text('street_name',$StreetName,array('placeholder'=>'','id'=>'street_name', 'help2' => "Inscrivez le nom de la rue où se situe la propriété que vous désirez vendre.")) !!}
                                            @else
                                                {!! Form::text('street_name',$StreetName,array('placeholder'=>'','id'=>'street_name', 'help2' => "Inscrivez le nom de la rue où se situe la propriété que vous désirez vendre.", 'disabled'=>'disabled')) !!}
                                            @endif
                                            <div id="street_error" style="color:red"></div>
                                        </div>
                                        
                                        <div class="form-group col-sm-8">
                                            <label class="control-label"># Résidence</label>
                                            @if($StreetName == "")
                                            {!! Form::text('street_number',$HouseNumber,array('placeholder'=>'','id'=>'street_number', 'help2' => "Inscrivez le numéro civique de la propriété que vous désirez vendre.")) !!}
                                            @else
                                            {!! Form::text('street_number',$HouseNumber,array('placeholder'=>'','id'=>'street_number', 'help2' => "Inscrivez le numéro civique de la propriété que vous désirez vendre.", 'disabled'=>'disabled')) !!}
                                            @endif
                                            <div id="street_number_error" style="color:red"></div>
                                        </div>
                                        
                                        <div class="form-group col-sm-8">
                                            <label class="control-label">Code postal</label>
                                            @if($StreetName == "")
                                                {!! Form::text('postal',$Postal_code,array('placeholder'=>'G7X-3F5','id'=>'postal', 'help2' => "Inscrivez le code postal de la propriété que vous désirez vendre.")) !!}
                                            @else
                                                {!! Form::text('postal',$Postal_code,array('placeholder'=>'G7X-3F5','id'=>'postal', 'help2' => "Inscrivez le code postal de la propriété que vous désirez vendre.", 'disabled'=>'disabled')) !!}
                                            @endif
                                            <div id="postal_error" style="color:red"></div>
                                        </div>
                                    </div>
                                 </div> 
                            </div>                      
                            
                            <div class="col-sm-6 textarea-height">
                                  {!! Form::textarea('help2', "Lorsque vous cliquerez dans un champ de saisie (ex.: Région), c'est ici que vous pourrez voir des indications concernant le champ en question !" ,array('help' => "Lorsque vous cliquerez dans un champ de saisie (ex.: Téléphone), c'est ici que vous pourrez voir des indications concernant le champ en question !",'id'=>'help2')); !!}
                                    <h4>Si vous avez des questions, appelez-nous au 1-844-31-CLIC (2542) !</h4>
                            </div>               
                            <div class="col-sm-12">
                                <button class="prevBtn pull-left" type="button">Précédent</button>
                                <button class="nextBtn pull-right" type="submit" onclick="$('#tab-carte').removeClass('disabled');$('#tab-carte').attr('onclick','');">Sauvegarder</button>
                                <a class="nextBtn pull-left" style="margin-left:10px;width:150px;" target="_blank" href="{{URL::to($lang.'/propriete?id='.$get_register_building[0]->id) }}">pré-visualiser</a>
                            </div>          
                        </div>
                        {!! Form::close() !!}   
                        @if(!empty($get_register_building[0]->Latitude))
                          {{--*/ $Latitude = $get_register_building[0]->Latitude /*--}}
                        @else
                          {{--*/ $Latitude = '46.809422089282265' /*--}}
                        @endif  
                        @if(!empty($get_register_building[0]->Longitude))
                          {{--*/ $Longitude = $get_register_building[0]->Longitude /*--}}
                        @else
                          {{--*/ $Longitude = '-71.26741307753906' /*--}}
                        @endif                   
                        {!! Form::open(array('url' => URL::to('/'),'id'=>'form4','data_id'=>'4','method'=>'post','role'=>'form'))!!}
                        <div style="display: none;" class="setup-content" id="step-4">
                            <i>Pour enregistrer vos informations, cliquer sur le bouton "sauvegarder" au bas de la page. Vous serez ensuite automatiquement redirigé vers la prochaine étape.</i><br /><br />
                        <div class="clear">
                            <div class="col-sm-3 pull-right" style="display:none;">
                                <button class="prevBtn pull-left" type="button">Précédent</button>
                                <button class="nextBtn pull-right" type="submit">Sauvegarder</button>
                                <a class="nextBtn pull-left" style="margin-left:10px;width:150px;" target="_blank" href="{{URL::to($lang.'/propriete?id='.$get_register_building[0]->id) }}">pré-visualiser</a>
                            </div>
                        </div>
                            <div class="col-sm-6">
                                
                                <div class="box-title">
                                    Carte – Étape 4/13
                                </div>
                        
                                <div class="setup-content-box clear">
                                    <div class="col-sm-12">
                                        <p class="map-text">Écrivez votre adresse et cliquer sur Rechercher. Valider que la position de votre maison est la bonne sinon vous pouvez cliquer sur la position pour la changer.</p>         
                                    </div>
                                    <div class="col-sm-12 address-field">
                                    	<div class="row">     
                                            <div class="col-sm-6">                      
                                            <input type="text" id="user_location" name="user_location" value="" class="register-form__location-holder" help3="Entrer votre adresse complète dans ce champ et cliquer sur Rechercher adresse">   
                                            </div>   
                                            <div class="col-sm-6"> 
                                                <input type="type" name="name" value="Rechercher adresse" class="location_button submit-button btn"/>      
                                            <a href="javascript:void(0);" ></a>      
                                            </div>
                                         </div>
                                     </div>   
                                    <div style="width:100%;height:400px" id="register-form__map" class="register-form__map register-form__map--user"></div>
                                    <input type="hidden" name="user_latitude" value="{{$Latitude}}" class="register-form__latitude-holder">
                                    <input type="hidden" name="user_longitude" value="{{$Longitude}}" class="register-form__longitude-holder">
                                 </div> 
                                 <br />
                            </div>   
                            <div class="col-sm-6 textarea-height">
                                  {!! Form::textarea('help3', "Vous pouvez utiliser le zoom pour reculer ou avancer sur la carte afin de trouver précisément l'emplacement que vous voulez assigner à la propriété que vous désirez vendre." ,array('help' => "Vous pouvez utiliser le zoom pour reculer ou avancer sur la carte afin de trouver précisément l'emplacement que vous voulez assigner à la propriété que vous désirez vendre.",'id'=>'help3')); !!}
                                <h4>Si vous avez des questions, appelez-nous au 1-844-31-CLIC (2542) !</h4>
                            </div>            
                            <div class="col-sm-12">
                                <button class="prevBtn pull-left" type="button">Précédent</button>
                                <button class="nextBtn pull-right" type="submit">Sauvegarder</button>
                                <a class="nextBtn pull-left" style="margin-left:10px;width:150px;" target="_blank" href="{{URL::to($lang.'/propriete?id='.$get_register_building[0]->id) }}">pré-visualiser</a>
                            </div>          
                        </div>
                        {!! Form::close() !!}
                        @if(!empty($get_register_building[0]->Size_land_frontage))
                          {{--*/ $Size_land_frontage = $get_register_building[0]->Size_land_frontage /*--}}
                        @else
                          {{--*/ $Size_land_frontage = '' /*--}}
                        @endif 
                        @if(!empty($get_register_building[0]->Size_land_depth))
                          {{--*/ $Size_land_depth = $get_register_building[0]->Size_land_depth /*--}}
                        @else
                          {{--*/ $Size_land_depth = '' /*--}}
                        @endif 
                        @if(!empty($get_register_building[0]->Size_land_area))
                          {{--*/ $Size_land_area = $get_register_building[0]->Size_land_area /*--}}
                        @else
                          {{--*/ $Size_land_area = '' /*--}}
                        @endif 
                        @if(!empty($get_register_building[0]->Size_building_width))
                          {{--*/ $Size_building_width = $get_register_building[0]->Size_building_width /*--}}
                        @else
                          {{--*/ $Size_building_width = '' /*--}}
                        @endif
                        @if(!empty($get_register_building[0]->Size_building_depth))
                          {{--*/ $Size_building_depth = $get_register_building[0]->Size_building_depth /*--}}
                        @else
                          {{--*/ $Size_building_depth = '' /*--}}
                        @endif
                        @if(!empty($get_register_building[0]->Living_area_size_feet))
                          {{--*/ $Living_area_size_feet = $get_register_building[0]->Living_area_size_feet /*--}}
                        @else
                          {{--*/ $Living_area_size_feet = '' /*--}}
                        @endif
                        {!! Form::open(array('url' => URL::to('/'),'id'=>'form5','data_id'=>'5','method'=>'post','role'=>'form'))!!}
                        <div style="display: none;" class="setup-content" id="step-5">
                            <i>Pour enregistrer vos informations, cliquer sur le bouton "sauvegarder" au bas de la page. Vous serez ensuite automatiquement redirigé vers la prochaine étape.</i><br /><br />
                        <div class="clear">
                            <div class="col-sm-3 pull-right" style="display:none;">
                                <button class="prevBtn pull-left" type="button">Précédent</button>
                                <button class="nextBtn pull-right" type="submit">Sauvegarder</button>
                                <a class="nextBtn pull-left" style="margin-left:10px;width:150px;" target="_blank" href="{{URL::to($lang.'/propriete?id='.$get_register_building[0]->id) }}">pré-visualiser</a>
                            </div>
                        </div>
                            <div class="col-sm-6">
                                
                                <div class="box-title">
                                    Dimension – Étape 5/13
                                </div>
                        
                                <div class="setup-content-box clear">
                                    <div class="row">
                                    	
                                        <div class="form-group col-xs-12">
                                        	<p class="txt-instructions">Inscrivez dans les cases ci-dessous les dimensions du terrain et du bâtiment de votre propriété.</p>
                                        </div>
                                        
                                        <div class="form-group col-sm-8">
                                            <label class="control-label">Façade du terrain en pied</label>
                                            {!! Form::text('land_frontage',$Size_land_frontage,array('placeholder'=>'','id'=>'land_frontage', 'help4' => "Vous pouvez trouver cette information sur votre certificat de localisation.")) !!}
                                            <div id="land_frontage_error" style="color:red"></div>
                                        </div>
                                        
                                        <div class="form-group col-sm-8">
                                            <label class="control-label">Profondeur du terrain en pied</label>
                                            {!! Form::text('land_depth',$Size_land_depth,array('placeholder'=>'','id'=>'land_depth', 'help4' => "Vous pouvez trouver cette information sur votre certificat de localisation.")) !!}
                                            <div id="land_depth_error" style="color:red"></div>
                                        </div>
                                        
                                        <div class="form-group col-sm-8">
                                            <label class="control-label">Dimension du terrain en pied carré</label>
                                            {!! Form::text('land_area',$Size_land_area,array('placeholder'=>'','id'=>'land_area', 'help4' => "Vous pouvez trouver cette information sur votre rôle d'évaluation foncière ou sur votre certificat de localisation.")) !!}
                                            <div id="land_area_error" style="color:red"></div>
                                        </div>
                                        
                                        <div class="form-group col-sm-8">
                                            <label class="control-label">Largeur du bâtiment en pied</label>
                                            {!! Form::text('building_width',$Size_building_width,array('placeholder'=>'','id'=>'building_width', 'help4' => "Vous pouvez trouver cette information sur votre certificat de localisation.")) !!}
                                            <div id="building_width_error" style="color:red"></div>
                                        </div>
                                        
                                        <div class="form-group col-sm-8">
                                            <label class="control-label">Profondeur du bâtiment en pied</label>
                                            {!! Form::text('building_depth',$Size_building_depth,array('placeholder'=>'','id'=>'building_depth', 'help4' => "Vous pouvez trouver cette information sur votre certificat de localisation.")) !!}
                                            <div id="building_depth_error" style="color:red"></div>
                                        </div>
                                        
                                        <div class="form-group col-sm-8">
                                            <label class="control-label">Aire habitable en pied carré</label>
                                            {!! Form::text('Living_area_size_feet',$Living_area_size_feet,array('placeholder'=>'','id'=>'Living_area_size_feet', 'help4' => "L'aire habitable ne considère jamais l'aire du sous-sol. Pour avoir une valeur précise, vous pouvez trouver cette information sur votre rôle d'évaluation foncière.")) !!}
                                            <div id="Living_area_size_feet_error" style="color:red"></div>
                                        </div>
                                        
                                    </div>
                                 </div> 
                            </div>                      
                            <div class="col-sm-6 textarea-height">
                                  {!! Form::textarea('help4', "Lorsque vous cliquerez dans un champ de saisie (ex.: Façade du terrain en pied), c'est ici que vous pourrez voir des indications concernant le champ en question !" ,array('help' => "Lorsque vous cliquerez dans un champ de saisie (ex.: Façade du terrain en pied), c'est ici que vous pourrez voir des indications concernant le champ en question !",'id'=>'help4')); !!}
                                <h4>Si vous avez des questions, appelez-nous au 1-844-31-CLIC (2542) !</h4>
                            </div>  
                            
                            <div class="col-sm-12">
                                <button class="prevBtn pull-left" type="button">Précédent</button>
                                <button class="nextBtn pull-right" type="submit">Sauvegarder</button>
                                <a class="nextBtn pull-left" style="margin-left:10px;width:150px;" target="_blank" href="{{URL::to($lang.'/propriete?id='.$get_register_building[0]->id) }}">pré-visualiser</a>
                            </div>          
                        </div>
                        {!! Form::close() !!} 
                        @if(!empty($get_register_building[0]->Evaluation_year))
                          {{--*/ $Evaluation_year = $get_register_building[0]->Evaluation_year /*--}}
                        @else
                          {{--*/ $Evaluation_year = '' /*--}}
                        @endif
                        @if(!empty($get_register_building[0]->Evaluation_building))
                          {{--*/ $Evaluation_building = $get_register_building[0]->Evaluation_building /*--}}
                        @else
                          {{--*/ $Evaluation_building = '' /*--}}
                        @endif
                        @if(!empty($get_register_building[0]->Evaluation_ground))
                          {{--*/ $Evaluation_ground = $get_register_building[0]->Evaluation_ground /*--}}
                        @else
                          {{--*/ $Evaluation_ground = '' /*--}}
                        @endif 
                        @if(!empty($get_register_building[0]->Evaluation_total))
                          {{--*/ $Evaluation_total = $get_register_building[0]->Evaluation_total /*--}}
                        @else
                          {{--*/ $Evaluation_total = '' /*--}}
                        @endif
                        {!! Form::open(array('url' => URL::to('/'),'id'=>'form6','data_id'=>'6','method'=>'post','role'=>'form'))!!}
                        <div style="display: none;" class="setup-content" id="step-6">
                            <i>Pour enregistrer vos informations, cliquer sur le bouton "sauvegarder" au bas de la page. Vous serez ensuite automatiquement redirigé vers la prochaine étape.</i><br /><br />
                        <div class="clear">
                            <div class="col-sm-3 pull-right" style="display:none;">
                                <button class="prevBtn pull-left" type="button">Précédent</button>
                                <button class="nextBtn pull-right" type="submit">Sauvegarder</button>
                                <a class="nextBtn pull-left" style="margin-left:10px;width:150px;" target="_blank" href="{{URL::to($lang.'/propriete?id='.$get_register_building[0]->id) }}">pré-visualiser</a>
                            </div>
                        </div>
                            <div class="col-sm-6">
                                
                                <div class="box-title">
                                    Évaluation municipale – Étape 6/13
                                </div>
                        
                                <div class="setup-content-box clear">
                                    <div class="row">
                                    
                                    <div class="form-group col-xs-12">
                                        <p class="txt-instructions">Inscrivez dans les cases ci-dessous les informations relatives à l’évaluation municipale de la propriété.</p>
                                    </div>
                                    
                                    <div class="form-group col-sm-8">
                                        <label class="control-label">Rôle d'évaluation</label>
                                        <div class="select-box">
                                            <select name="role" id="role" help5="Choisissez quelles années vise le rôle d'évaluation foncière que vous avez en main. Cette information se retrouve directement sur votre rôle d'évaluation foncière ou sur votre facture de taxes municipales.">
                                                <option>Veuillez sélectionner un Rôle d'évaluation</option>
                                                <option value="2013-2014-2015"
                                                @if($Evaluation_year=="2013-2014-2015")
                                                selected="selected" 
                                                @endif
                                                >2013-2014-2015</option>
                                                <option value="2016-2017-2018"
                                                @if($Evaluation_year=="2016-2017-2018")
                                                selected="selected" 
                                                @endif
                                                >2016-2017-2018</option>
                                            </select>
                                        </div>
                                     </div>   
                                    <div class="form-group col-sm-8">
                                        <label class="control-label">Bâtiment</label>
                                        {!! Form::text('batimemt',$Evaluation_building,array('placeholder'=>'','id'=>'batimemt','onkeyup'=>'total_val()', 'help5' => "Inscrivez la valeur du bâtiment indiqué sur votre rôle d'évaluation foncière ou sur votre facture de taxes municipales.")) !!}
                                        <div id="batimemt_error" style="color:red"></div>
                                     </div> 
                                    <div class="form-group col-sm-8">
                                        <label class="control-label">Terrain</label>
                                        {!! Form::text('tarrain',$Evaluation_ground,array('placeholder'=>'','id'=>'tarrain','onkeyup'=>'total_val()', 'help5' => "Inscrivez la valeur du terrain indiqué sur votre rôle d'évaluation foncière ou sur votre facture de taxes municipales.")) !!}
                                         <div id="tarrain_error" style="color:red"></div>
                                     </div> 
                                    <div class="form-group col-sm-8">
                                        <label class="control-label">Total</label>
                                        {!! Form::text('total',$Evaluation_total,array('placeholder'=>'','id'=>'total','readonly'=>'true')) !!}
                                        <div id="total_error" style="color:red"></div>
                                     </div> 
                                    </div>
                                </div> 
                            </div>                                        
                            <div class="col-sm-6 textarea-height">
                                  {!! Form::textarea('help5', "Lorsque vous cliquerez dans un champ de saisie (ex.: Rôle d'évaluation), c'est ici que vous pourrez voir des indications concernant le champ en question !" ,array('help' => "Lorsque vous cliquerez dans un champ de saisie (ex.: Rôle d'évaluation), c'est ici que vous pourrez voir des indications concernant le champ en question !",'id'=>'help5')); !!}
                                <h4>Si vous avez des questions, appelez-nous au 1-844-31-CLIC (2542) !</h4>
                            </div>  
                            
                            <div class="col-sm-12">
                                <button class="prevBtn pull-left" type="button">Précédent</button>
                                <button class="nextBtn pull-right" type="submit">Sauvegarder</button>
                                <a class="nextBtn pull-left" style="margin-left:10px;width:150px;" target="_blank" href="{{URL::to($lang.'/propriete?id='.$get_register_building[0]->id) }}">pré-visualiser</a>
                            </div>          
                        </div>
                        {!! Form::close() !!}
                        @if(!empty($get_register_building[0]->Electricity_by_month))
                          {{--*/ $Electricity_by_month = $get_register_building[0]->Electricity_by_month /*--}}
                        @else
                          {{--*/ $Electricity_by_month = '' /*--}}
                        @endif
                        @if(!empty($get_register_building[0]->Insurance_by_month))
                          {{--*/ $Insurance_by_month = $get_register_building[0]->Insurance_by_month /*--}}
                        @else
                          {{--*/ $Insurance_by_month = '' /*--}}
                        @endif 
                        @if(!empty($get_register_building[0]->Heating_by_month))
                          {{--*/ $Heating_by_month = $get_register_building[0]->Heating_by_month /*--}}
                        @else
                          {{--*/ $Heating_by_month = '' /*--}}
                        @endif
                         @if(!empty($get_register_building[0]->Maintenance_fees_by_month))
                          {{--*/ $Maintenance_fees_by_month = $get_register_building[0]->Maintenance_fees_by_month /*--}}
                        @else
                          {{--*/ $Maintenance_fees_by_month = '' /*--}}
                        @endif 
                         @if(!empty($get_register_building[0]->Copropriete_taxes_by_month))
                          {{--*/ $Copropriete_taxes_by_month = $get_register_building[0]->Copropriete_taxes_by_month /*--}}
                        @else
                          {{--*/ $Copropriete_taxes_by_month = '' /*--}}
                        @endif 
                        @if(!empty($get_register_building[0]->Municipal_taxes_by_year))
                          {{--*/ $Municipal_taxes_by_year = $get_register_building[0]->Municipal_taxes_by_year /*--}}
                        @else
                          {{--*/ $Municipal_taxes_by_year = '' /*--}}
                        @endif
                        @if(!empty($get_register_building[0]->School_taxes_by_year))
                          {{--*/ $School_taxes_by_year = $get_register_building[0]->School_taxes_by_year /*--}}
                        @else
                          {{--*/ $School_taxes_by_year = '' /*--}}
                        @endif
                        @if(!empty($get_register_building[0]->Other_taxes_by_year))
                          {{--*/ $Other_taxes_by_year = $get_register_building[0]->Other_taxes_by_year /*--}}
                        @else
                          {{--*/ $Other_taxes_by_year = '' /*--}}
                        @endif
                        {!! Form::open(array('url' => URL::to('/'),'id'=>'form7','data_id'=>'7','method'=>'post','role'=>'form'))!!}
                        <div style="display: none;" class="setup-content" id="step-7">
                            <i>Pour enregistrer vos informations, cliquer sur le bouton "sauvegarder" au bas de la page. Vous serez ensuite automatiquement redirigé vers la prochaine étape.</i><br /><br />
                        <div class="clear">
                            <div class="col-sm-3 pull-right" style="display:none;">
                                <button class="prevBtn pull-left" type="button">Précédent</button>
                                <button class="nextBtn pull-right" type="submit">Sauvegarder</button>
                                <a class="nextBtn pull-left" style="margin-left:10px;width:150px;" target="_blank" href="{{URL::to($lang.'/propriete?id='.$get_register_building[0]->id) }}">pré-visualiser</a>
                            </div>
                        </div>
                            <div class="col-sm-6">
                                
                                <div class="box-title">
                                    Frais mensuels / taxes - Étape 7/13
                                </div>
                        
                                <div class="setup-content-box clear">
                                    
                                        <div class="inner-setup-box clear">
                                            <h3>Frais mensuels</h3>
                                            <div class="row">
                                            
                                            <div class="form-group col-xs-12">
                                        		<p class="txt-instructions">Inscrivez dans les cases ci-dessous les divers frais et taxes reliés à la propriété.</p>
                                    		</div>
                                            
                                            <div class="form-group col-sm-8">
                                                <label class="control-label">Électricité</label>
                                                {!! Form::text('electricity',$Electricity_by_month,array('placeholder'=>'','id'=>'electricity', 'help6' => "Inscrivez la moyenne mensuelle du coût d'électricité de la propriété que vous désirez vendre. Si possible, vous pouvez divisez le coût annuel de la dernière année par 12 mois.")) !!}
                                                <div id="electricity_error" style="color:red"></div>
                                            </div> 
                                            <div class="form-group col-sm-8">
                                                <label class="control-label">Assurances</label>
                                                {!! Form::text('assurance',$Insurance_by_month,array('placeholder'=>'','id'=>'assurance', 'help6' => "Inscrivez le coût mensuel pour l'assurances habitation de la propriété que vous désirez vendre.")) !!}
                                                <div id="assurance_error" style="color:red"></div>
                                            </div>
                                            <div class="form-group col-sm-8">
                                                <label class="control-label">Chauffage</label>
                                                {!! Form::text('heat',$Heating_by_month,array('placeholder'=>'','id'=>'heat', 'help6' => "Si vous utilisez un chauffage autre que l'électricité, inscrivez le coût mensuel moyen de ce type de chauffage.")) !!}
                                                <div id="heat_error" style="color:red"></div>
                                            </div>
                                            <div class="form-group col-sm-8">
                                                <label class="control-label">Frais d'entretien</label>
                                                 {!! Form::text('maintanence',$Maintenance_fees_by_month,array('placeholder'=>'','id'=>'maintanence', 'help6' => "Inscrivez le coût des frais d'entretien mensuels s'il y a lieu.")) !!}
                                                 <div id="maintanence_error" style="color:red"></div>
                                             </div> 
                                            <div class="form-group col-sm-8">
                                                <label class="control-label">Frais de copropriété (s’il y a lieu)</label>
                                                 {!! Form::text('copropriete',$Copropriete_taxes_by_month,array('placeholder'=>'','id'=>'copropriete', 'help6' => "Inscrivez le coût des frais de copropriété mensuels s'il y a lieu.")) !!}
                                                 <div id="copropriete_error" style="color:red"></div>
                                             </div> 
                                            </div>
                                        </div>
                                        
                                        <div class="inner-setup-box clear">
                                            <h3>Taxes</h3>
                                            <div class="row">
                                            <div class="form-group col-sm-8">
                                                <label class="control-label">Taxes municipales</label>
                                                {!! Form::text('municipal',$Municipal_taxes_by_year,array('placeholder'=>'','id'=>'municipal', 'help6' => "Inscrivez le coût annuelle de votre dernière facture de taxes municipales.")) !!}
                                                <div id="municipal_error" style="color:red"></div>
                                             </div> 
                                            <div class="form-group col-sm-8">
                                                <label class="control-label">Taxes scolaires</label>
                                                {!! Form::text('scolaries',$School_taxes_by_year,array('placeholder'=>'','id'=>'scolaries', 'help6' => "Inscrivez le coût annuelle de votre dernière facture de taxes scolaires.")) !!}
                                                <div id="scolaries_error" style="color:red"></div>
                                             </div> 
                                            <div class="form-group col-sm-8">
                                                <label class="control-label">Autres taxes</label>
                                                {!! Form::text('other_taxes',$Other_taxes_by_year,array('placeholder'=>'','id'=>'other_taxes', 'help6' => "Inscrivez le coût annuelle d'autres taxes s'il y a lieu.")) !!}
                                                <div id="other_taxes_error" style="color:red"></div>
                                             </div> 
                                            </div>
                                        </div>

                                    
                                </div> 
                            </div>
                            <div class="col-sm-6 textarea-height">
                                  {!! Form::textarea('help6', "Lorsque vous cliquerez dans un champ de saisie (ex.: Électricité), c'est ici que vous pourrez voir des indications concernant le champ en question !" ,array('help' => "Lorsque vous cliquerez dans un champ de saisie (ex.: Électricité), c'est ici que vous pourrez voir des indications concernant le champ en question !",'id'=>'help6')); !!}
                                <h4>Si vous avez des questions, appelez-nous au 1-844-31-CLIC (2542) !</h4>
                            </div>  
                            
                            <div class="col-sm-12">
                                <button class="prevBtn pull-left" type="button">Précédent</button>
                                <button class="nextBtn pull-right" type="submit">Sauvegarder</button>
                                <a class="nextBtn pull-left" style="margin-left:10px;width:150px;" target="_blank" href="{{URL::to($lang.'/propriete?id='.$get_register_building[0]->id) }}">pré-visualiser</a>
                            </div>          
                        </div>
                        {!! Form::close() !!}

                        @if(!empty($get_register_building[0]->Inclusion_autre))
                          {{--*/ $Inclusion_autre = $get_register_building[0]->Inclusion_autre /*--}}
                        @else
                          {{--*/ $Inclusion_autre = '' /*--}}
                        @endif
                        @if(!empty($get_register_building[0]->Exclusion_autre))
                          {{--*/ $Exclusion_autre = $get_register_building[0]->Exclusion_autre /*--}}
                        @else
                          {{--*/ $Exclusion_autre = '' /*--}}
                        @endif
                        {!! Form::open(array('url' => URL::to('/'),'id'=>'form8','data_id'=>'8','method'=>'post','role'=>'form'))!!}
                        <div style="display: none;" class="setup-content" id="step-8">
                            <i>Pour enregistrer vos informations, cliquer sur le bouton "sauvegarder" au bas de la page. Vous serez ensuite automatiquement redirigé vers la prochaine étape.</i><br /><br />
                        <div class="clear">
                            <div class="col-sm-3 pull-right" style="display:none;">
                                <button class="prevBtn pull-left" type="button">Précédent</button>
                                <button class="nextBtn pull-right" type="submit">Sauvegarder</button>
                                <a class="nextBtn pull-left" style="margin-left:10px;width:150px;" target="_blank" href="{{URL::to($lang.'/propriete?id='.$get_register_building[0]->id) }}">pré-visualiser</a>
                            </div>
                        </div>
                            <div class="col-sm-6">
                                
                                <div class="box-title">
                                    Inclusions / Exclusions – Étape 8/13
                                </div>
                        
                                <div class="setup-content-box clear">
                                    
                                        <div class="inner-setup-box clear">
                                            <h3>Inclusions</h3>                                           
                                            <div class="row">
                                            
                                            <div class="form-group col-sm-8">
                                            	<p class="txt-instructions">Sélectionnez les items que vous voulez inclure ou exclure de la vente de la propriété.
</p>
                                            </div>
                                            
                                            <div class="form-group col-sm-8">
                                                <label class="control-label">Inclusions</label>                                                                                                  
                                                    <select style="width:343px" multiple="multiple" name="inclusion[]" id="inclusion" placeholder="Inclusion" class="SlectBox" help7="Sélectionner tous les items que vous désirez inclure dans la vente de la propriété. Si un ou plusieurs items ne se retrouve pas dans la liste de choix, vous pourrez les inscrire manuellement dans le champs 'Autres'. Si vous recevez une offre d'achat, c'est à ce moment que vous officialiserez les inclusions par rapport aux négociations avec l'acheteur potentiel!">
                                                            {{--*/ $i = 1 /*--}}
                                                            @foreach($inclusion_exclusion as $key => $value)
                                                            <option  value="{{ $key }}"  @if(!empty($inclusive) && in_array($key,$inclusive)) selected="selected"  @endif>
                                                                {{  $value }}
                                                                {{--*/ $i++ /*--}}
                                                            </option> 
                                                        @endforeach
                                                    </select>                                                    
                                            </div>                                                                                            
                                            <div class="form-group col-sm-8">
                                                <label class="control-label">Autres</label>
                                                {!! Form::text('other_inc',$Inclusion_autre,array('placeholder'=>'','id'=>'other_inc', 'help7' => "Inscrivez les items que vous désirez inclure mais qui ne se retrouve pas dans la liste de choix précédente.")) !!}
                                            </div> 
                                            
                                            </div>
                                        </div>
                                        
                                        <div class="inner-setup-box clear">
                                            <h3>Exclusions</h3>
                                            <div class="row">
                                                                                            
                                                <div class="form-group col-sm-8">         
                                                <label class="control-label">Exclusions</label>                                                
                                                    <select style="width:343px;" multiple="multiple" name="exclusion[]" id="exclusion" placeholder="Exclusions" class="SlectBox" help7="Sélectionner tous les items que vous désirez exclure dans la vente de la propriété. Si un ou plusieurs items ne se retrouve pas dans la liste de choix, vous pourrez les inscrire manuellement dans le champs 'Autres'. Si vous recevez une offre d'achat, c'est à ce moment que vous officialiserez les exclusions par rapport aux négociations avec l'acheteur potentiel!">
                                                            {{--*/ $i = 1 /*--}}
                                                            @foreach($inclusion_exclusion as $key => $value)
                                                            <option  value="{{ $key }}" @if(!empty($exclusive) && in_array($key,$exclusive)) selected="selected"  @endif>
                                                                {{  $value }}                                                                
                                                                {{--*/ $i++ /*--}}
                                                            </option> 
                                                        @endforeach
                                                    </select>                                                                                                
                                                </div>
                                            
                                                
                                            <div class="form-group col-sm-8">
                                                <label class="control-label">Autres</label>
                                                {!! Form::text('other_exc',$Exclusion_autre,array('placeholder'=>'','id'=>'other_exc', 'help7' => "Inscrivez les items que vous désirez exclure mais qui ne se retrouve pas dans la liste de choix précédente.")) !!}
                                            </div>
                                            </div>
                                        </div>

                                    
                                </div> 
                            </div>                      
                            <div class="col-sm-6 textarea-height">
                                  {!! Form::textarea('help7', "Lorsque vous cliquerez dans un champ de saisie (ex.: Inclusions), c'est ici que vous pourrez voir des indications concernant le champ en question !" ,array('help' => "Lorsque vous cliquerez dans un champ de saisie (ex.: Inclusions), c'est ici que vous pourrez voir des indications concernant le champ en question !",'id'=>'help7')); !!}
                            <h4>Si vous avez des questions, appelez-nous au 1-844-31-CLIC (2542) !</h4>
                            </div>  
                            
                            <div class="col-sm-12">
                                <button class="prevBtn pull-left" type="button">Précédent</button>
                                <button class="nextBtn pull-right" type="submit">Sauvegarder</button>
                                <a class="nextBtn pull-left" style="margin-left:10px;width:150px;" target="_blank" href="{{URL::to($lang.'/propriete?id='.$get_register_building[0]->id) }}">pré-visualiser</a>
                            </div>          
                        </div>
                        {!! Form::close() !!}
                        {!! Form::open(array('url' => URL::to('/'),'id'=>'form9','data_id'=>'9','method'=>'post','role'=>'form'))!!}
                        <div style="display: none;" class="setup-content" id="step-9">
                            <i>Pour enregistrer vos informations, cliquer sur le bouton "sauvegarder" au bas de la page. Vous serez ensuite automatiquement redirigé vers la prochaine étape.</i><br /><br />
                        <div class="clear">
                            <div class="col-sm-3 pull-right" style="display:none;">
                                <button class="prevBtn pull-left" type="button">Précédent</button>
                                <button class="nextBtn pull-right" type="submit">Sauvegarder</button>
                                <a class="nextBtn pull-left" style="margin-left:10px;width:150px;" target="_blank" href="{{URL::to($lang.'/propriete?id='.$get_register_building[0]->id) }}">pré-visualiser</a>
                            </div>
                        </div>
                            <div class="col-sm-6">
                            <div class="box-title">
                                Dimensions des pièces – Étape 9/13
                            </div>
                    
                            <div class="setup-content-box clear">                
                                <div class="inner-setup-box clear">
                                <div class="row">
                                <div class="form-group col-xs-12">
                                    <p class="txt-instructions">Sélectionnez d’abord la pièce que vous voulez décrire et l’étage auquel elle se trouve.</p>
                                    <p class="txt-instructions">Inscrivez ensuite les informations sur les pièces de la propriété que vous désirez vendre et choisissez le type de plancher de cette pièce.</p>
                                    <p class="txt-instructions">Cliquez finalement sur le bouton « Ajouter » lorsque vous avez terminé une pièce et faite la suivante!</p>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label class="control-label">Pièce</label>
                                    <div class="select-box">
                                        {!! Form::select('choice_Piece', $choice_piece, '', ['id' => 'choice_Piece', 'help8' => "Sélectionnez la pièce que vous désirez décrire."]) !!}
                                    </div>
                                </div>
                                
                                <div class="form-group col-xs-6">
                                    <label class="control-label">Étage</label>
                                    <div class="select-box">
                                        {!! Form::select('etage_val', $etage_val_piece, '', ['id' => 'etage_val', 'help8' => "Sélectionnez l'étage où se situe la pièce que vous décrivez."]) !!}
                                    </div>
                                </div>
                                    
                                <div class="form-group col-sm-12">
                                    <div class="row">
                                        <label class="form-group-title col-sm-12">Largeur</label>
                                        <div class="col-xs-6">
                                        <label>Pieds</label>
                                            {!! Form::text('pieds','',array('placeholder'=>'','id'=>'pieds', 'help8' => "Inscrivez la largeur de la pièce que vous décrivez.")) !!}
                                            <div id="pieds_err"></div>
                                        </div>
                                        <div class="col-xs-6">
                                        <label>Pouces</label>
                                            {!! Form::text('pouces','',array('placeholder'=>'','id'=>'pouces', 'help8' => "Inscrivez la largeur de la pièce que vous décrivez.")) !!}
                                            <div id="pouces_err"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12">
                                    <div class="row">
                                        <label class="form-group-title col-sm-12">Longueur</label>
                                        <div class="col-xs-6">
                                        <label>Pieds</label>
                                        {!! Form::text('pieds1','',array('placeholder'=>'','id'=>'pieds1', 'help8' => "Inscrivez la longueur de la pièce que vous décrivez.")) !!}
                                        <div id="pieds1_err"></div>
                                        </div>
                                        <div class="col-xs-6">
                                        <label>Pouces</label>
                                        {!! Form::text('pouces1','',array('placeholder'=>'','id'=>'pouces1', 'help8' => "Inscrivez la longueur de la pièce que vous décrivez.")) !!}
                                        <div id="pouces1_err"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-11">
                                    <div class="row">
                                    <label class="control-label col-sm-12">Type de planché</label>
                                    <div class="col-sm-9">
                                    <div class="select-box">
                                        {!! Form::select('courve_val', $courve_val_piece, '', ['id' => 'courve_val', 'help8' => "Sélectionnez le type de plancher de la pièce que vous décrivez."]) !!}
                                    </div>
                                    </div>
                                    </div>
                                </div>
                                <input type="hidden" value="1" name="hid_plench" id="hid_plench">
                                <input type="hidden" value="" name="plench_val" id="plench_val">
                                <div class="add-button-box">
                                    <button type="submit" ><i class="fa fa-plus"></i> Ajouter</button>
                                </div>
                                
                                
                                </div>
                                
                            </div>
                            <div class="listofplench" style="border: 1px solid #ccc; padding: 5px; overflow-y: auto; height: 90px; width:100%">
                                    <span class="list_plench"></span>
                                    <div class="">
                                        <span style="width: 100px;float: left;"><b>Pièce</b></span>
                                        <span style="width: 100px;float: left;"><b>Étage</b></span>
                                        <span><b>Type de planché</b></span></div>    
                                    @if(!empty($building_val))                                
                                        @foreach($building_val as $key=>$plench)                                      
                                            
                                            <div class="floor_{{$key}}">
                                                <span style="width: 100px;float: left;">{{Helper::GetRoomName($plench[0],$lang)}}</span>
                                                <span style="width: 100px;float: left;">{{Helper::GetRoomLevelName($plench[1],$lang)}}</span>
                                                <span style="width: 70px;float: left;">{{Helper::GetRoomFloorName($plench[2],$lang)}}</span>
                                                <span data-attr="{{$key}}" class="plench_del" onclick="return del_form_9({{$key}});"><img src="{{ URL::asset('assets/images/DeleteRed.png') }}" style="height: 18px;cursor:pointer;"></span>
                                            </div>    
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            </div>                  
                            <div class="col-sm-6 textarea-height">
                                  {!! Form::textarea('help8', "Lorsque vous cliquerez dans un champ de saisie (ex.: Pièce), c'est ici que vous pourrez voir des indications concernant le champ en question !" ,array('help' => "Lorsque vous cliquerez dans un champ de saisie (ex.: Pièce), c'est ici que vous pourrez voir des indications concernant le champ en question !",'id'=>'help8')); !!}
                                <h4>Si vous avez des questions, appelez-nous au 1-844-31-CLIC (2542) !</h4>
                            </div>  
                                                
                            <div class="col-sm-12">
                                <button class="prevBtn pull-left" type="button">Précédent</button>
                                <button class="nextBtn pull-right" type="button">Sauvegarder</button>
                                <a class="nextBtn pull-left" style="margin-left:10px;width:150px;" target="_blank" href="{{URL::to($lang.'/propriete?id='.$get_register_building[0]->id) }}">pré-visualiser</a>
                            </div>          
                            </div>
                            {!! Form::close() !!}
                            @if(!empty($get_register_building[0]->indoor_cupboard))
                              {{--*/ $indoor_cupboard = $get_register_building[0]->indoor_cupboard /*--}}
                              {{--*/ $indoor_cupboard=explode(',',$indoor_cupboard) /*--}}                                               
                            @else
                              {{--*/ $indoor_cupboard = '' /*--}}
                            @endif
                            @if(!empty($get_register_building[0]->indoor_cupboard_other))
                              {{--*/ $indoor_cupboard_other = $get_register_building[0]->indoor_cupboard_other /*--}}                              
                            @else
                              {{--*/ $indoor_cupboard_other = '' /*--}}
                            @endif
                            
                            @if(!empty($get_register_building[0]->indoor_windows_type))
                              {{--*/ $indoor_windows_type = $get_register_building[0]->indoor_windows_type /*--}}
                              {{--*/ $indoor_windows_type=explode(',',$indoor_windows_type) /*--}}
                            @else
                              {{--*/ $indoor_windows_type = '' /*--}}
                            @endif
                            @if(!empty($get_register_building[0]->indoor_windows_type_other))
                              {{--*/ $indoor_windows_type_other = $get_register_building[0]->indoor_windows_type_other /*--}}                              
                            @else
                              {{--*/ $indoor_windows_type_other = '' /*--}}
                            @endif

                            @if(!empty($get_register_building[0]->indoor_basement))
                              {{--*/ $indoor_basement = $get_register_building[0]->indoor_basement /*--}}
                              {{--*/ $indoor_basement=explode(',',$indoor_basement) /*--}}
                            @else
                              {{--*/ $indoor_basement = '' /*--}}
                            @endif
                             @if(!empty($get_register_building[0]->indoor_basement_other))
                              {{--*/ $indoor_basement_other = $get_register_building[0]->indoor_basement_other /*--}}                              
                            @else
                              {{--*/ $indoor_basement_other = '' /*--}}
                            @endif
                            @if(!empty($get_register_building[0]->indoor_roofing))
                              {{--*/ $indoor_roofing = $get_register_building[0]->indoor_roofing /*--}}
                              {{--*/ $indoor_roofing=explode(',',$indoor_roofing) /*--}}
                            @else
                              {{--*/ $indoor_roofing = '' /*--}}
                            @endif

                            @if(!empty($get_register_building[0]->indoor_roofing_other))
                              {{--*/ $indoor_roofing_other = $get_register_building[0]->indoor_roofing_other /*--}}                              
                            @else
                              {{--*/ $indoor_roofing_other = '' /*--}}
                            @endif

                            @if(!empty($get_register_building[0]->indoor_equipment_available))
                              {{--*/ $indoor_equipment_available = $get_register_building[0]->indoor_equipment_available /*--}}
                              {{--*/ $indoor_equipment_available=explode(',',$indoor_equipment_available) /*--}}
                            @else
                              {{--*/ $indoor_equipment_available = '' /*--}}
                            @endif
                            @if(!empty($get_register_building[0]->indoor_equipment_available_other))
                              {{--*/ $indoor_equipment_available_other = $get_register_building[0]->indoor_equipment_available_other /*--}}                              
                            @else
                              {{--*/ $indoor_equipment_available_other = '' /*--}}
                            @endif

                            @if(!empty($get_register_building[0]->indoor_heating_system))
                              {{--*/ $indoor_heating_system = $get_register_building[0]->indoor_heating_system /*--}}
                              {{--*/ $indoor_heating_system=explode(',',$indoor_heating_system) /*--}}
                            @else
                              {{--*/ $indoor_heating_system = '' /*--}}
                            @endif
                            @if(!empty($get_register_building[0]->indoor_heating_system_other))
                              {{--*/ $indoor_heating_system_other = $get_register_building[0]->indoor_heating_system_other /*--}}                              
                            @else
                              {{--*/ $indoor_heating_system_other = '' /*--}}
                            @endif
                            
                            @if(!empty($get_register_building[0]->indoor_heating_energy))
                              {{--*/ $indoor_heating_energy = $get_register_building[0]->indoor_heating_energy /*--}}
                              {{--*/ $indoor_heating_energy=explode(',',$indoor_heating_energy) /*--}}
                            @else
                              {{--*/ $indoor_heating_energy = '' /*--}}
                            @endif
                            @if(!empty($get_register_building[0]->indoor_heating_energy_other))
                              {{--*/ $indoor_heating_energy_other = $get_register_building[0]->indoor_heating_energy_other /*--}}                              
                            @else
                              {{--*/ $indoor_heating_energy_other = '' /*--}}
                            @endif
                            
                            @if(!empty($get_register_building[0]->indoor_energy_system))
                              {{--*/ $indoor_energy_system = $get_register_building[0]->indoor_energy_system /*--}}
                              {{--*/ $indoor_energy_system=explode(',',$indoor_energy_system) /*--}}
                            @else
                              {{--*/ $indoor_energy_system = '' /*--}}
                            @endif
                            @if(!empty($get_register_building[0]->indoor_energy_system_other))
                              {{--*/ $indoor_energy_system_other = $get_register_building[0]->indoor_energy_system_other /*--}}                              
                            @else
                              {{--*/ $indoor_energy_system_other = '' /*--}}
                            @endif
                            {!! Form::open(array('url' => URL::to('/'),'id'=>'form10','data_id'=>'10','method'=>'post','role'=>'form'))!!}
                            <div style="display: none;" class="setup-content" id="step-10">
                            <i>Pour enregistrer vos informations, cliquer sur le bouton "sauvegarder" au bas de la page. Vous serez ensuite automatiquement redirigé vers la prochaine étape.</i><br /><br />
                                <div class="col-sm-6">
                                    <div class="box-title">
                                        Bâtiment et intérieur – Étape 10/13
                                    </div>
                                    <div class="setup-content-box clear">
                                        <div class="row">
                                        <div class="form-group col-xs-12">
                                        	<p class="txt-instructions">Complétez les choix ci-dessous pour la description de votre propriété</p>
                                        </div>
                                        <div class="form-group col-sm-6">                                        	
                                            <label class="control-label">Armoires</label>
                                            <!-- <div class="select-box"> -->
                                                <select style="width:236px;" multiple="multiple" name="armo[]" id="armo" placeholder="Armoires" class="SlectBox" help9="Sélectionnez le ou les matériaux des armoires de la propriété que vous désirez vendre.">
                                                    {{--*/ $i = 1 /*--}}
                                                    @foreach($armo_val_data as $key => $value)
                                                    <option  value="{{ $key }}"  @if(!empty($indoor_cupboard) &&  in_array($key,$indoor_cupboard)) selected="selected"  @endif>
                                                        {{  $value }}
                                                        {{--*/ $i++ /*--}}
                                                    </option> 
                                                @endforeach
                                            </select> 
                                            </div>
                                        <!-- </div> -->
                                            
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Autre</label>
                                        {!! Form::text('autre1',$indoor_cupboard_other,array('placeholder'=>'','id'=>'autre1', 'help9'=>'Si le ou les matériaux des armoires de la cuisine ne se retrouve pas dans la liste de choix, inscrivez le à la main ici!')) !!}
                                    </div> 
                                    
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Type de fenêtre</label>
                                        <!-- <div class="select-box"> -->
                                            <select style="width:236px;" multiple="multiple" name="fenetre[]" id="fenetre" placeholder="Type de fenetre" class="SlectBox" help9="Sélectionnez le ou les types de fenêtres de la propriété que vous désirez vendre.">
                                                    {{--*/ $i = 1 /*--}}
                                                    @foreach($tfen_val_data as $key => $value)
                                                    <option  value="{{ $key }}"  @if(!empty($indoor_windows_type) &&  in_array($key,$indoor_windows_type)) selected="selected"  @endif>
                                                        {{  $value }}
                                                        {{--*/ $i++ /*--}}
                                                    </option> 
                                                @endforeach
                                            </select>
                                        
                                    </div>
                                        
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Autre</label>
                                        {!! Form::text('autre2',$indoor_windows_type_other,array('placeholder'=>'','id'=>'autre2', 'help9'=>'Si le ou les types de fenêtre ne se retrouve pas dans la liste de choix, inscrivez le à la main ici!')) !!}
                                    </div>
                                    
                                    
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Sous-sol</label>
                                        <!-- <div class="select-box"> -->
                                            <select style="width:236px;" multiple="multiple" name="sous[]" id="sous" placeholder="Sous-sol" class="SlectBox" help9="Sélectionnez les caractéristiques qui s'applique au sous-sol de la propriété que vous désirez vendre.">
                                                    {{--*/ $i = 1 /*--}}
                                                    @foreach($ss_val_data as $key => $value)
                                                    <option  value="{{ $key }}"  @if(!empty($indoor_basement) &&  in_array($key,$indoor_basement)) selected="selected"  @endif>
                                                        {{  $value }}
                                                        {{--*/ $i++ /*--}}
                                                    </option> 
                                                @endforeach
                                            </select>
                                        <!-- </div> -->
                                    </div>
                                        
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Autre</label>
                                        {!! Form::text('autre3',$indoor_basement_other,array('placeholder'=>'','id'=>'autre3', 'help9'=>'Si une caractéristique de votre sous-sol ne se retrouve pas dans la liste de choix, inscrivez le à la main ici!')) !!}
                                    </div>
                                    
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Toiture</label>
                                        <select style="width:236px;" multiple="multiple" name="toiture[]" id="toiture" placeholder="Toiture" class="SlectBox" help9="Sélectionnez le revêtement de la toiture de la propriété que vous désirez vendre.">
                                                    {{--*/ $i = 1 /*--}}
                                                    @foreach($toit_val_data as $key => $value)
                                                    <option  value="{{ $key }}"  @if(!empty($indoor_roofing) &&  in_array($key,$indoor_roofing)) selected="selected"  @endif>
                                                        {{  $value }}
                                                        {{--*/ $i++ /*--}}
                                                    </option> 
                                                @endforeach
                                            </select>
                                    </div>
                                        
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Autre</label>
                                        {!! Form::text('autre4',$indoor_roofing_other,array('placeholder'=>'','id'=>'autre4', 'help9'=>'Si le revêtement de la toiture ne se retrouve pas dans la liste de choix, inscrivez le à la mains ici!')) !!}
                                    </div>
                                    
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Équipement disponible</label>
                                        <select style="width:236px;" multiple="multiple" name="equi[]" id="equi" placeholder="Equipement disponible" class="SlectBox" help9="Sélectionnez les équipements disponibles avec la propriété que vous désirez vendre.">
                                                    {{--*/ $i = 1 /*--}}
                                                    @foreach($equi_val_data as $key => $value)
                                                    <option  value="{{ $key }}"  @if(!empty($indoor_equipment_available) &&  in_array($key,$indoor_equipment_available)) selected="selected"  @endif>
                                                        {{  $value }}
                                                        {{--*/ $i++ /*--}}
                                                    </option> 
                                                @endforeach
                                            </select>
                                    </div>
                                        
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Autre</label>
                                        {!! Form::text('autre5',$indoor_equipment_available_other,array('placeholder'=>'','id'=>'autre5', 'help9'=>'Si un item ne se retrouve pas dans la liste de choix, inscrivez le à la main ici!')) !!}
                                    </div>
                                    
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Système de chauffage</label>
                                            <select style="width:236px;" multiple="multiple" name="chauffage[]" id="chauffage" placeholder="Mode de chauffage" class="SlectBox" help9="Sélectionnez le ou les modes de chauffage de la propriété que vous désirez vendre.">
                                                    {{--*/ $i = 1 /*--}}
                                                    @foreach($chau_val_data as $key => $value)
                                                    <option  value="{{ $key }}"  @if(!empty($indoor_energy_system) &&  in_array($key,$indoor_energy_system)) selected="selected"  @endif>
                                                        {{  $value }}
                                                        {{--*/ $i++ /*--}}
                                                    </option> 
                                                @endforeach
                                            </select>

                                    </div>
                                        
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Autre</label>
                                        {!! Form::text('autre7',$indoor_heating_energy_other,array('placeholder'=>'','id'=>'autre7', 'help9'=>"Si un mode de chauffage ne se retrouve pas dans la liste de choix, inscrivez le à la main ici!")) !!}
                                    </div>
                                    
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Énergie pour le chauffage</label>
                                        <select style="width:236px;" multiple="multiple" name="energie[]" id="energie" placeholder="Energie pour le chauffage" class="SlectBox" help9="Sélectionnez le ou les types d'énergies nécessaires pour faire fonctionner le ou les modes de chauffage de la propriété que vous désirez vendre.">
                                                    {{--*/ $i = 1 /*--}}
                                                    @foreach($ener_val_data as $key => $value)
                                                    <option  value="{{ $key }}"  @if(!empty($indoor_heating_energy) &&  in_array($key,$indoor_heating_energy)) selected="selected"  @endif>
                                                        {{  $value }}
                                                        {{--*/ $i++ /*--}}
                                                    </option> 
                                                @endforeach
                                            </select>
                                    </div>
                                        
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Autre</label>
                                        {!! Form::text('autre8',$indoor_energy_system_other,array('placeholder'=>'','id'=>'autre8', 'help9'=>"Si un type d'énergie ne se retrouve pas dans la liste de choix, inscrivez le à la main ici!")) !!}
                                    </div>                                    
                                 </div>
                                </div>
                            </div>                
                            <div class="col-sm-6 textarea-height">
                                  {!! Form::textarea('help9', "Lorsque vous cliquerez dans un champ de saisie (ex.: Armoires), c'est ici que vous pourrez voir des indications concernant le champ en question !" ,array('help' => "Lorsque vous cliquerez dans un champ de saisie (ex.: Armoires), c'est ici que vous pourrez voir des indications concernant le champ en question !",'id'=>'help9')); !!}
                            <h4>Si vous avez des questions, appelez-nous au 1-844-31-CLIC (2542) !</h4>
                            </div> 
                            
                            <div class="col-sm-12">
                                <button class="prevBtn pull-left" type="button">Précédent</button>
                                <button class="nextBtn pull-right" type="submit">Sauvegarder</button>
                                <a class="nextBtn pull-left" style="margin-left:10px;width:150px;" target="_blank" href="{{URL::to($lang.'/propriete?id='.$get_register_building[0]->id) }}">pré-visualiser</a>
                            </div>          
                        </div>
                        {!! Form::close() !!}
                        @if(!empty($get_register_building[0]->outdoor_garage))
                              {{--*/ $outdoor_garage = $get_register_building[0]->outdoor_garage /*--}}
                              {{--*/ $outdoor_garage=explode(',',$outdoor_garage) /*--}}
                            @else
                              {{--*/ $outdoor_garage = '' /*--}}
                            @endif
                            @if(!empty($get_register_building[0]->outdoor_garage_other))
                              {{--*/ $outdoor_garage_other = $get_register_building[0]->outdoor_garage_other /*--}}                              
                            @else
                              {{--*/ $outdoor_garage_other = '' /*--}}
                            @endif

                            @if(!empty($get_register_building[0]->outdoor_pool))
                              {{--*/ $outdoor_pool = $get_register_building[0]->outdoor_pool /*--}}
                              {{--*/ $outdoor_pool=explode(',',$outdoor_pool) /*--}}
                            @else
                              {{--*/ $outdoor_pool = '' /*--}}
                            @endif
                            @if(!empty($get_register_building[0]->outdoor_garage_other))
                              {{--*/ $outdoor_garage_other = $get_register_building[0]->outdoor_garage_other /*--}}                              
                            @else
                              {{--*/ $outdoor_garage_other = '' /*--}}
                            @endif

                            @if(!empty($get_register_building[0]->outdoor_topography))
                              {{--*/ $outdoor_topography = $get_register_building[0]->outdoor_topography /*--}}
                              {{--*/ $outdoor_topography=explode(',',$outdoor_topography) /*--}}
                            @else
                              {{--*/ $outdoor_topography = '' /*--}}
                            @endif
                            @if(!empty($get_register_building[0]->outdoor_topography_other))
                              {{--*/ $outdoor_topography_other = $get_register_building[0]->outdoor_topography_other /*--}}                              
                            @else
                              {{--*/ $outdoor_topography_other = '' /*--}}
                            @endif

                            @if(!empty($get_register_building[0]->outdoor_sewage_system))
                              {{--*/ $outdoor_sewage_system = $get_register_building[0]->outdoor_sewage_system /*--}}
                              {{--*/ $outdoor_sewage_system=explode(',',$outdoor_sewage_system) /*--}}
                            @else
                              {{--*/ $outdoor_sewage_system = '' /*--}}
                            @endif
                            @if(!empty($get_register_building[0]->outdoor_sewage_system_other))
                              {{--*/ $outdoor_sewage_system_other = $get_register_building[0]->outdoor_sewage_system_other /*--}}                              
                            @else
                              {{--*/ $outdoor_sewage_system_other = '' /*--}}
                            @endif

                            @if(!empty($get_register_building[0]->outdoor_proximity))
                              {{--*/ $outdoor_proximity = $get_register_building[0]->outdoor_proximity /*--}}
                              {{--*/ $outdoor_proximity=explode(',',$outdoor_proximity) /*--}}
                            @else
                              {{--*/ $outdoor_proximity = '' /*--}}
                            @endif
                            @if(!empty($get_register_building[0]->outdoor_proximity_other))
                              {{--*/ $outdoor_proximity_other = $get_register_building[0]->outdoor_proximity_other /*--}}                              
                            @else
                              {{--*/ $outdoor_proximity_other = '' /*--}}
                            @endif

                            @if(!empty($get_register_building[0]->outdoor_siding))
                              {{--*/ $outdoor_siding = $get_register_building[0]->outdoor_siding /*--}}
                              {{--*/ $outdoor_siding=explode(',',$outdoor_siding) /*--}}
                            @else
                              {{--*/ $outdoor_siding = '' /*--}}
                            @endif
                            @if(!empty($get_register_building[0]->outdoor_siding_other))
                              {{--*/ $outdoor_siding_other = $get_register_building[0]->outdoor_siding_other /*--}}                              
                            @else
                              {{--*/ $outdoor_siding_other = '' /*--}}
                            @endif

                            @if(!empty($get_register_building[0]->outdoor_foundation))
                              {{--*/ $outdoor_foundation = $get_register_building[0]->outdoor_foundation /*--}}
                              {{--*/ $outdoor_foundation=explode(',',$outdoor_foundation) /*--}}
                            @else
                              {{--*/ $outdoor_foundation = '' /*--}}
                            @endif
                            @if(!empty($get_register_building[0]->outdoor_foundation_other))
                              {{--*/ $outdoor_foundation_other = $get_register_building[0]->outdoor_foundation_other /*--}}                              
                            @else
                              {{--*/ $outdoor_foundation_other = '' /*--}}
                            @endif

                            @if(!empty($get_register_building[0]->outdoor_water_supply))
                              {{--*/ $outdoor_water_supply = $get_register_building[0]->outdoor_water_supply /*--}}
                              {{--*/ $outdoor_water_supply=explode(',',$outdoor_water_supply) /*--}}
                            @else
                              {{--*/ $outdoor_water_supply = '' /*--}}
                            @endif
                            @if(!empty($get_register_building[0]->outdoor_water_supply_other))
                              {{--*/ $outdoor_water_supply_other = $get_register_building[0]->outdoor_water_supply_other /*--}}                              
                            @else
                              {{--*/ $outdoor_water_supply_other = '' /*--}}
                            @endif

                        {!! Form::open(array('url' => URL::to('/'),'id'=>'form11','data_id'=>'11','method'=>'post','role'=>'form'))!!}
                        <div style="display: none;" class="setup-content" id="step-11">
                            <i>Pour enregistrer vos informations, cliquer sur le bouton "sauvegarder" au bas de la page. Vous serez ensuite automatiquement redirigé vers la prochaine étape.</i><br /><br />
                            <div class="col-sm-6">
                                <div class="box-title">
                                    Terrain et extérieur – Étape 11/13
                                </div>
                                <div class="setup-content-box clear">
                                    <div class="row">
                                    <div class="form-group col-xs-12">
                                        <p class="txt-instructions">Complétez les choix ci-dessous pour la description de votre propriété</p>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Garage</label>
                                        <select style="width:236px;" multiple="multiple" name="garage[]" id="garage" placeholder="Garage" class="SlectBox" help10="Sélectionnez le ou les types de garages de la propriété que vous désirez vendre.">
                                                    {{--*/ $i = 1 /*--}}
                                                    @foreach($gara_val_data as $key => $value)
                                                    <option  value="{{ $key }}"  @if(!empty($outdoor_garage) &&  in_array($key,$outdoor_garage)) selected="selected"  @endif>
                                                        {{  $value }}
                                                        {{--*/ $i++ /*--}}
                                                    </option> 
                                                @endforeach
                                            </select>
                                    </div>
                                        
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Autre</label>
                                        {!! Form::text('autre11',$outdoor_garage_other,array('placeholder'=>'','id'=>'autre11', 'help10'=>"Si un type de garage ne se retrouve pas dans la liste de choix, inscrivez le à la main ici!")) !!}
                                    </div> 
                                    
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Piscine</label>
                                            <select style="width:236px;" multiple="multiple" name="piscine[]" id="piscine" placeholder="Piscine" class="SlectBox" help10="Sélectionnez le type de piscine de la propriété que vous désirez vendre.">
                                                    {{--*/ $i = 1 /*--}}
                                                    @foreach($pisc_val_data as $key => $value)
                                                    <option  value="{{ $key }}"  @if(!empty($outdoor_pool) &&  in_array($key,$outdoor_pool)) selected="selected"  @endif>
                                                        {{  $value }}
                                                        {{--*/ $i++ /*--}}
                                                    </option> 
                                                @endforeach
                                            </select>

                                    </div>
                                        
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Autre</label>
                                        {!! Form::text('autre12',$outdoor_topography_other,array('placeholder'=>'','id'=>'autre12', 'help10'=>"Si un type de piscine ne se retrouve pas dans la liste de choix, inscrivez le à la main ici!")) !!}
                                    </div>
                                    
                                    
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Topographie</label>
                                            <select style="width:236px;" multiple="multiple" name="topographie[]" id="topographie" placeholder="Topographie" class="SlectBox" help10="Sélectionnez la topographie du terrain de la propriété que vous désirez vendre.">
                                                    {{--*/ $i = 1 /*--}}
                                                    @foreach($topo_val_data as $key => $value)
                                                    <option  value="{{ $key }}"  @if(!empty($outdoor_topography) &&  in_array($key,$outdoor_topography)) selected="selected"  @endif>
                                                        {{  $value }}
                                                        {{--*/ $i++ /*--}}
                                                    </option> 
                                                @endforeach
                                            </select>
                                    </div>
                                        
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Autre</label>
                                        {!! Form::text('autre13',$outdoor_topography_other,array('placeholder'=>'','id'=>'autre13', 'help10'=>"Si une caractéristique ne se retrouve pas dans la liste de choix, inscrivez le à la main ici!")) !!}
                                    </div>
                                    
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Système d'égouts</label>
                                        <select style="width:236px;" multiple="multiple" name="system[]" id="system" placeholder="Systeme degouts" class="SlectBox" help10="Sélectionnez le ou les systèmes d'égouts de la propriété que vous désirez vendre.">
                                                    {{--*/ $i = 1 /*--}}
                                                    @foreach($syeg_val_data as $key => $value)
                                                    <option  value="{{ $key }}"  @if(!empty($outdoor_sewage_system) &&  in_array($key,$outdoor_sewage_system)) selected="selected"  @endif>
                                                        {{  $value }}
                                                        {{--*/ $i++ /*--}}
                                                    </option> 
                                                @endforeach
                                            </select>
                                    </div>
                                        
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Autre</label>
                                        {!! Form::text('autre14',$outdoor_sewage_system_other,array('placeholder'=>'','id'=>'autre14', 'help10'=>"Si un système d'égout ne se retrouve pas dans la liste de choix, inscrivez le à la mains ici!")) !!}
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Proximité de</label>
                                            <select style="width:236px;" multiple="multiple" name="proximate[]" id="proximate" placeholder="Proximite de" class="SlectBox" help10="Sélectionnez les services à proximité de la propriété que vous désirez vendre.">
                                                    {{--*/ $i = 1 /*--}}
                                                    @foreach($prox_val_data as $key => $value)
                                                    <option  value="{{ $key }}"  @if(!empty($outdoor_proximity) && in_array($key,$outdoor_proximity)) selected="selected"  @endif>
                                                        {{  $value }}
                                                        {{--*/ $i++ /*--}}
                                                    </option> 
                                                @endforeach
                                            </select>
                                    </div>
                                        
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Autre</label>
                                        {!! Form::text('autre15',$outdoor_proximity_other,array('placeholder'=>'','id'=>'autre15', 'help10'=>"Si un service ne se retrouve pas dans la liste de choix, inscrivez le à la main ici!")) !!}
                                    </div>
                                    
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Revêtements</label>
                                        <select style="width:236px;" multiple="multiple" name="pare[]" id="pare" placeholder="Proximite de" class="SlectBox" help10="Sélectionnez le ou les types de revêtements de la propriété que vous désirez vendre, s'il y a lieu.">
                                                    {{--*/ $i = 1 /*--}}
                                                    @foreach($pare_val_data as $key => $value)
                                                    <option  value="{{ $key }}"  @if(!empty($outdoor_siding) && in_array($key,$outdoor_siding)) selected="selected"  @endif>
                                                        {{  $value }}
                                                        {{--*/ $i++ /*--}}
                                                    </option> 
                                                @endforeach
                                            </select>
                                    </div>
                                        
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Autre</label>
                                        {!! Form::text('autre16',$outdoor_siding_other,array('placeholder'=>'','id'=>'autre16', 'help10'=>"Si un type revêtement n'apparaît pas dans la liste de choix, inscrivez le à la main ici!")) !!}
                                    </div>
                                    
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Fondation</label>
                                        
                                            <select style="width:236px;" multiple="multiple" name="foundation[]" id="foundation" placeholder="Fondation" class="SlectBox" help10="Sélectionnez le ou les types de fondation de la propriété que vous désirez vendre.">
                                                    {{--*/ $i = 1 /*--}}
                                                    @foreach($fond_val_data as $key => $value)
                                                    <option  value="{{ $key }}"  @if(!empty($outdoor_foundation) && in_array($key,$outdoor_foundation)) selected="selected"  @endif>
                                                        {{  $value }}
                                                        {{--*/ $i++ /*--}}
                                                    </option> 
                                                @endforeach
                                            </select>
                                    </div>
                                        
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Autre</label>
                                        {!! Form::text('autre17',$outdoor_foundation_other,array('placeholder'=>'','id'=>'autre17', 'help10'=>"Si un type de fondation ne se retrouve pas dans la liste de choix, inscrivez le à la main ici!")) !!}
                                    </div>
                                    
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Approvisionnement en eau</label>
                                            
                                            <select style="width:236px;" multiple="multiple" name="eau[]" id="eau" placeholder="Approvisionnement en eau" class="SlectBox" help10="Sélectionnez le ou les types d'approvisionnement en eau de la propriété que vous désirez vendre.">
                                                    {{--*/ $i = 1 /*--}}
                                                    @foreach($eau_val_data as $key => $value)
                                                    <option  value="{{ $key }}"  @if(!empty($outdoor_water_supply) && in_array($key,$outdoor_water_supply)) selected="selected"  @endif>
                                                        {{  $value }}
                                                        {{--*/ $i++ /*--}}
                                                    </option> 
                                                @endforeach
                                            </select>
                                    </div>
                                        
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Autre</label>
                                        {!! Form::text('autre18',$outdoor_water_supply_other,array('placeholder'=>'','id'=>'autre18', 'help10'=>"Si un type d'approvisionnement en eau ne se retrouve pas dans la liste de choix, inscrivez le à la main ici!")) !!}
                                    </div>
                                    
                                 </div>
                                </div>
                            </div>               
                            <div class="col-sm-6 textarea-height">
                                  {!! Form::textarea('help10', "Lorsque vous cliquerez dans un champ de saisie (ex.: Garage), c'est ici que vous pourrez voir des indications concernant le champ en question !" ,array('help' => "Lorsque vous cliquerez dans un champ de saisie (ex.: Garage), c'est ici que vous pourrez voir des indications concernant le champ en question !",'id'=>'help10')); !!}
                            <h4>Si vous avez des questions, appelez-nous au 1-844-31-CLIC (2542) !</h4>
                            </div> 
                            
                            <div class="col-sm-12">
                                <button class="prevBtn pull-left" type="button">Précédent</button>
                                <button class="nextBtn pull-right" type="submit">Sauvegarder</button>
                                <a class="nextBtn pull-left" style="margin-left:10px;width:150px;" target="_blank" href="{{URL::to($lang.'/propriete?id='.$get_register_building[0]->id) }}">pré-visualiser</a>
                            </div>          
                        </div>
                        {!! Form::close() !!}
                        {!! Form::open(array('url' => URL::to('/'),'id'=>'form12','data_id'=>'12','method'=>'post','role'=>'form'))!!}
                        <div style="display: none;" class="setup-content" id="step-12">
                            <i>Pour enregistrer vos informations, cliquer sur le bouton "sauvegarder" au bas de la page. Vous serez ensuite automatiquement redirigé vers la prochaine étape.</i><br /><br />
                            <div class="col-sm-6">
                                <div class="box-title">
                                    Loyers - Étape 12/13
                                </div>
                                <div class="setup-content-box clear">
                                <div class="inner-setup-box clear">
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <p class="txt-instructions"><span class="txt-bigger">S’il y a lieu</span>, inscrivez les informations sur le ou les loyers de la propriété que vous désirez vendre.</p>
                                            <p class="txt-instructions">Sélectionnez le type de loyer que vous voulez décrire et inscrivez le prix de location mensuel.</p>
                                            <p class="txt-instructions">Cliquez finalement sur le bouton « Ajouter » lorsque vous avez terminé !</p>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="control-label">Type</label>
                                            <div class="select-box">
                                                
                                                {!! Form::select('nbun_val_data', $nbun_val_data, '', ['id' => 'nbun_val_data', 'help11'=>'Sélectionnez le type de loyer que vous voulez décrire.']) !!}

                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="control-label">Prix par mois</label>
                                            {!! Form::text('prix','',array('placeholder'=>'','id'=>'prix', 'help11'=>'Sélectionnez le prix actuel du loyer que vous voulez décrire.')) !!}
                                            <div id="prix_err" style="color:red"></div>
                                        </div> 
                                        
                                        <div class="col-xs-12 form-group">
                                            {!! Form::checkbox('avec', '0',null,array('id'=>'avec')) !!} <label class="check-label">Déjà louer par un locataire?</label>
                                        </div>
                                        <div class="add-button-box">
                                            <button type="submit"><i class="fa fa-plus"></i> Ajouter</button>
                                        </div>
                                    </div>
                                </div>  

                                <div class="formdata12" style="border: 1px solid #ccc; padding: 5px; overflow-y: auto; height: 368px; width:325px;">
                                    
                                    <div class="">
                                        <span style="width: 75px;float: left;"><b>Type</b></span>
                                        <span style="width: 100px;float: left;"><b>Prix par mois</b></span>
                                        <span style="width: 100px;float: left;"><b>Déjà louer</b></span>
                                        <span style="width: 25px;float: left;"></span>
                                    </div>
                                    <span class="formdata_12"></span>    
                                    @if(!empty($data_building_rent))
                                      @foreach($data_building_rent as $rent)
                                        <div class="form_12_{{$rent['id1']}}">
                                            <span style="width: 75px;float: left;">{{$rent['Type']}}</span>
                                            <span style="width: 100px;float: left;">{{$rent['price_by_month']}}</span>
                                            <span style="width: 100px;float: left;">{{$rent['already_rent']}}</span>
                                            <span style="width: 25px;float: left;"><img  data-attr="{{$rent['id1']}}" onClick="del_form_12({{$rent['id1']}})" src="{{ URL::asset('assets/images/DeleteRed.png') }}" style="height: 18px;cursor:pointer;"></span>
                                        </div>
                                      @endforeach      
                                    @endif                              
                                </div>

                                </div>
                            </div>               
                            <div class="col-sm-6 textarea-height">
                                  {!! Form::textarea('help11', "Lorsque vous cliquerez dans un champ de saisie (ex.: Type), c'est ici que vous pourrez voir des indications concernant le champ en question !" ,array('help' => "Lorsque vous cliquerez dans un champ de saisie (ex.: Type), c'est ici que vous pourrez voir des indications concernant le champ en question !",'id'=>'help11')); !!}
                            <h4>Si vous avez des questions, appelez-nous au 1-844-31-CLIC (2542) !</h4>
                            </div> 
                            
                            <div class="col-sm-12">
                                <button class="prevBtn pull-left" type="button">Précédent</button>
                                <button class="nextBtn pull-right" type="button">Sauvegarder</button>
                                <a class="nextBtn pull-left" style="margin-left:10px;width:150px;" target="_blank" href="{{URL::to($lang.'/propriete?id='.$get_register_building[0]->id) }}">pré-visualiser</a>
                            </div>          
                        </div>
                        {!! Form::close() !!}
                        {!! Form::open(array('url' => URL::to('/'),'id'=>'form13','data_id'=>'13','method'=>'post','role'=>'form'))!!}
                        <div style="display: none;" class="setup-content" id="step-13">
                        <i>Pour enregistrer vos informations, cliquer sur le bouton "Terminer" et vous pouvez voir votre annonce en cliquant sur "Prévisualiser".</i><br /><br />
                            <div class="col-sm-6">
                                <div class="box-title">
                                    Autres détails – Étape 13/13
                                </div> 
                                <div class="setup-content-box clear">                   
                                <div class="row">
                                	<div class="form-group col-sm-12">
                                    	<p class="txt-instructions">Complétez les informations ci-dessous pour la description de votre propriété</p>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Nombre total de pièce</label>
                                        <div class="select-box">
                                            <select name="Total_rooms_number" id="Total_rooms_number" help12="Sélectionnez le nombre total de pièce de la propriété que vous désirez vendre.">
                                              <option value="">Nombre total de pièce</option>
                                                  @for($i=1;$i<=20;$i++)
                                                    <option value="{{$i}}" {{ ($get_register_building[0]->Total_rooms_number==$i)?'selected':'' }}>{{$i}}</option>
                                                  @endfor 
                                            </select>
                                            <span class="Total_rooms_number_err"></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Nombre de chambre</label>
                                        <div class="select-box">
                                            <select name="Rooms_number" id="Rooms_number" help12="Sélectionnez le nombre de chambre de la propriété que vous désirez vendre.">
                                                <option value="">Nombre de chambre</option>
                                                  @for($i=1;$i<=15;$i++)
                                                    <option value="{{$i}}" {{ ($get_register_building[0]->Rooms_number==$i)?'selected':'' }}>{{$i}}</option>
                                                  @endfor
                                            </select>
                                            <span class="Rooms_number_err"></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Nombre de salle(s) de bain</label>
                                        <div class="select-box">
                                            <select name="Bathroom_number" id="Bathroom_number" help12="Sélectionnez le nombre de salle de bain de la propriété que vous désirez vendre.">
                                                <option value="">Nombre de salle(s) de bain</option>
                                                  @for($i=1;$i<=5;$i++)
                                                    <option value="{{$i}}" {{ ($get_register_building[0]->Bathroom_number==$i)?'selected':''}}>{{$i}}</option>
                                                  @endfor
                                            </select>
                                            <span class="Bathroom_number_err"></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Nombre de stationnement extérieur</label>
                                        <div class="select-box">
                                            <select name="Parking_outdoor_number" id="Parking_outdoor_number" help12="Sélectionnez le nombre de stationnement extérieur de la propriété que vous désirez vendre.">
                                                <option value="0">Nombre de stationnement exterieur</option>
                                                
                                                  @for($i=1;$i<=15;$i++)
                                                    <option value="{{$i}}" {{ ($get_register_building[0]->Parking_outdoor_number==$i)?'selected':'' }}>{{$i}}</option>
                                                  @endfor
                                            </select>
                                            <span class="Parking_outdoor_number_err"></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="control-label">Nombre de stationnement intérieur</label>
                                        <div class="select-box">
                                             <select name="Parking_garage_number" id="Parking_garage_number" help12="Sélectionnez le nombre de stationnement intérieur de la propriété que vous désirez vendre.">
                                                <option value="0">Nombre de stationnement interieur</option>
                                                  @for($i=1;$i<=10;$i++)
                                                    <option value="{{$i}}" {{ ($get_register_building[0]->Parking_garage_number==$i)?'selected':'' }} >{{$i}}</option>
                                                  @endfor
                                            </select>
                                             <span class="Parking_garage_number_err"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="inner-setup-box clear" help12="Sélectionnez la ou les caractéristiques qui s'appliquent à la propriété que vous désirez vendre.">
                                    <h3>Caractéristiques</h3>
                                    <div>
                                        <ul>

                                            <li>{!! Form::checkbox('with_income', '1',($get_register_building[0]->with_income==1)?true:null,array('id'=>'with_income')) !!} Avec Revenu</li>
                                            <li>{!! Form::checkbox('Pool', '1',($get_register_building[0]->Pool==1)?true:null,array('id'=>'Pool')) !!} Piscine</li>
                                            <li>{!! Form::checkbox('No_neighbors_behind', '1',($get_register_building[0]->No_neighbors_behind==1)?true:null,array('id'=>'No_neighbors_behind')) !!} Sans voisin a lamere</li>
                                            <li>{!! Form::checkbox('fireplace', '1',($get_register_building[0]->fireplace==1)?true:null,array('id'=>'fireplace')) !!} Foyer</li>
                                            <li>{!! Form::checkbox('panoramic_view', '1',($get_register_building[0]->panoramic_view==1)?true:null,array('id'=>'panoramic_view')) !!} Vue panoramique</li>
                                            <li>{!! Form::checkbox('Garage', '1',($get_register_building[0]->Garage==1)?true:null,array('id'=>'Garage')) !!} Garage</li>
                                            <li>{!! Form::checkbox('waterside', '1',($get_register_building[0]->waterside==1)?true:null,array('id'=>'waterside')) !!} Bord de leau</li>

                                            <li>{!! Form::checkbox('Air_clim', '1', ($get_register_building[0]->Air_clim==1)?true:null,array('id'=>'Air_clim')) !!} Stationnement exterieur
                                            </li>

                                        </ul>
                                    </div>
                                </div>   
                                </div>
                            </div>           
                            <div class="col-sm-6 textarea-height">
                                  {!! Form::textarea('help12', "Lorsque vous cliquerez dans un champ de saisie (ex.: Nombre total de pièce), c'est ici que vous pourrez voir des indications concernant le champ en question !" ,array('help' => "Lorsque vous cliquerez dans un champ de saisie (ex.: Nombre total de pièce), c'est ici que vous pourrez voir des indications concernant le champ en question !",'id'=>'help12')); !!}
                            <h4>Si vous avez des questions, appelez-nous au 1-844-31-CLIC (2542) !</h4>
                            </div> 
                            <div class="col-sm-12">

                                <button class="prevBtn pull-left" type="button">Précédent</button>
                                <button class="nextBtn pull-right" type="submit">Terminer</button>
                                <a class="nextBtn pull-left" style="margin-left:10px;width:150px;" target="_blank" href="{{URL::to($lang.'/propriete?id='.$get_register_building[0]->id) }}">pré-visualiser</a>

                            </div>          
                        </div>
                        {!!  Form::close()  !!}                     
                
                </div> 
            </div>    
        </div>
    </div>    
    <script type="text/javascript">
        function BuildingSaved() { 
            @if($get_register_building[0]->status == 1)
                alert('Vos informations ont bien été enregistrées. Pour mettre votre annonce en ligne, cliquez sur le bouton orange "Activez mon annonce" dans votre onglet de propriété à vendre.');
            @else
                alert("Vos informations ont bien été enregistrés et votre annonce a été mise à jour.");
            @endif
        }

        var img_url="{{ URL::asset('assets/images/DeleteRed.png') }}";
    </script>
        <!--content end--> 
@stop