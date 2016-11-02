@extends('layouts.master')
    @section('content') 
    <script type="text/javascript">
        var links = window.location.href.split("#");
        if (links.length > 1) {
            setTimeout(function () {
                jQuery("a[href='#" + links[1] + "']").click();
            }, 100);

            
        }
    </script>
    <div class="banner-box parallax" style="background-position: 50% 75px;">
      <div class="container">
        <h2 class="title-2">{{ Lang::get('website-lang.my_account') }}</h2>
      </div>
    </div>  
        <!--content start-->
      <div class="content-box"> 
          <div class="container">
            <div class="row"> 
              <div class="my-account">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs clear" role="tablist">
                  <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">{{ Lang::get('website-lang.my_profil')}}</a></li>
                  <li role="presentation" style="{{ Helper::HideIfNotAMember() }}"><a href="#edit-profile" aria-controls="edit-profile" role="tab" data-toggle="tab">{{ Lang::get('website-lang.edit_profil')}}</a></li>
                  <li role="presentation" style="{{ Helper::HideIfNotAMember() }}"><a href="#order" aria-controls="order" role="tab" data-toggle="tab">{{ Lang::get('website-lang.my_favorite_list')}}</a></li>
                  <li role="presentation" style="{{ Helper::HideIfNotAMember() }}"><a href="#List" aria-controls="List" role="tab" data-toggle="tab">{{ Lang::get('website-lang.building_list')}}</a></li>
                  <li role="presentation"><a href="#Password" aria-controls="Password" role="tab" data-toggle="tab">{{ Lang::get('website-lang.change_password')}}</a></li>
                  <li role="presentation" style="{{ Helper::HideIfNotAMember() }}"><a href="#Transactions" aria-controls="Transactions" role="tab" data-toggle="tab">{{ Lang::get('website-lang.transactions')}}</a></li>
                </ul>
              
                <!-- Tab panes -->
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="profile">
                    <div class="profile-box clear row">
                    @if(Session::has('flash_alert_notice_success'))
                        <div class="alert alert-box success">
                            <p style="color:green;">{{ Session::get('flash_alert_notice_success') }}</p>
                        </div>
                      @endif
                      <div class="col-sm-12 profile-right"> 
                      
                          @if($my_profile->GroupID == 1)
                          <form action="{{env('phase1')}}/admin/index.php" method="post">
                            <input type="hidden" name="Mail" value="{{$my_profile->email}}" />
                            <input type="hidden" name="Token" value="{{$my_profile->Password}}" />
                            @if($my_profile->Transaction_Type == 1)
                                <input type="submit" name="Auth" value="MON COMPTE COURTIER" class="submit-button btn" />
                            @else
                                <input type="submit" name="Auth" value="MON COMPTE SPÉCIALISTE" class="submit-button btn" />
                            @endif
                          </form>
                          @endif
                      
                          @if($my_profile->GroupID == 4)
                          <form action="{{env('phase1')}}/admin/index.php" method="post">
                            <input type="hidden" name="Mail" value="{{$my_profile->email}}" />
                            <input type="hidden" name="Token" value="{{$my_profile->Password}}" />
                            <input type="submit" name="Auth" value="MON ANCIEN COMPTE ADMIN" class="submit-button btn" />
                          </form>
                          <br />
                          <a class="submit-button btn" href="{{URL::to('/admin') }}">Mon nouveau compte admin</a>

                          @endif
                      
                          @if($my_profile->GroupID == 5)
                          <form action="{{env('phase1')}}/admin/index.php" method="post">
                            <input type="hidden" name="Mail" value="{{$my_profile->email}}" />
                            <input type="hidden" name="Token" value="{{$my_profile->Password}}" />
                            <input type="submit" name="Auth" value="MON COMPTE PARTENAIRE" class="submit-button btn" />
                          </form>
                          @endif

                          <h4 class="profile-name">
                           
                           @if($my_profile->GroupID == 3)
                           {{ $my_profile->FirstName.' '.$my_profile->LastName }}       
                           @else
                           {{ utf8_decode($my_profile->FirstName.' '.$my_profile->LastName) }}   
                           @endif                 
                          </h4>  
                        <div class="row">   
                        <div class="profile-detail-box col-sm-6 col-sm-offset-4">
                          <p><span>{{ Lang::get('website-lang.email')}} :</span>  {{ $my_profile->email }}  </p> 
                            <p><span>{{ Lang::get('website-lang.FirstName')}} :</span>  @if($my_profile->GroupID == 3){{ $my_profile->FirstName }} @else {{ utf8_decode($my_profile->FirstName) }} @endif</p> 
                            <p><span>{{ Lang::get('website-lang.LastName')}} :</span>  @if($my_profile->GroupID == 3){{ $my_profile->LastName }} @else {{ utf8_decode($my_profile->LastName) }} @endif  </p> 
                          <p><span>{{ Lang::get('website-lang.phone')}} :</span> {{ (isset($my_profile->Phone) && !empty($my_profile->Phone))?Helper::FormatPhoneNumber($my_profile->Phone):'XXXXXXXXXX'}} </p>
                          <p><span>{{ Lang::get('website-lang.Cell')}} :</span> {{ (isset($my_profile->Cell) && !empty($my_profile->Cell))?Helper::FormatPhoneNumber($my_profile->Cell):'XXXXXXXXXX'}} </p>
                          <p><span>{{ Lang::get('website-lang.Adresse')}} :</span> {{ (isset($my_profile->Adresse) && !empty($my_profile->Adresse))?$my_profile->Adresse:''}} </p>
                        </div> 
                        </div>
                      </div>
                    
                </div>
                  </div>
                 
                    <div role="tabpanel" class="tab-pane" id="edit-profile">                    
                      <div class="edit-profile-box col-sm-6 col-sm-offset-2">                       
                      

                  {!! Form::model($my_profile, array('url' => URL::to('mon-compte/update'),'id'=>'form','data_id'=>'','method'=>'post','role'=>'form','class'=>'form-horizontal')) !!}
                     <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">{{ Lang::get('website-lang.FirstName')}} :</label>
                            <div class="col-sm-8"> 
                               {!! Form::text('FirstName',null, ['class' => 'form-control form-cascade-control'])  !!}
                            </div>
                            <p style="color:red">{!! $errors->first('FirstName') !!}</p>
                          </div>

                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">{{ Lang::get('website-lang.LastName')}} :</label>
                            <div class="col-sm-8">
                             
                              {!! Form::text('LastName',null, ['class' => 'form-control form-cascade-control'])  !!}
                            </div>
                            <p style="color:red">{!! $errors->first('LastName') !!}</p>
                          </div>

                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">{{ Lang::get('website-lang.phone')}} :</label>
                            <div class="col-sm-8">
                              
                              {!! Form::text('Phone',null, ['class' => 'form-control form-cascade-control'])  !!}
                            </div>
                             <p style="color:red">{!! $errors->first('Phone') !!}</p>
                          </div>

                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">{{ Lang::get('website-lang.Cell')}} :</label>
                            <div class="col-sm-8">
                              {!! Form::Number('Cell',null, ['class' => 'form-control form-cascade-control'])  !!}
                            </div>
                            <p style="color:red">{!! $errors->first('Cell') !!}</p>
                          </div>

                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">{{ Lang::get('website-lang.Adresse')}} :</label>
                            <div class="col-sm-8">
                              {!! Form::text('Adresse',null, ['class' => 'form-control form-cascade-control'])  !!}
                            </div>
                            <p style="color:red">{!! $errors->first('Adresse') !!}</p>
                          </div>
                          
                          <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                              <button type="submit" class="submit-button btn">{{ Lang::get('website-lang.save_fields')}}</button>
                            </div>
                          </div>
                        {!! Form::close() !!}
                        </div>
                        
                    </div>
                    <div role="tabpanel" class="tab-pane" id="order">
                     @if(count($fav_building)==0) {{Lang::get('website-lang.record_not_found')}} @endif
                      @foreach($fav_building as $key => $result)  
                    <div class="search-list clear" id="{{$result->id}}">
                            <div class="list-img-box">
                                <img src="{{ URL::asset('uploads/building/' . $result->id . '/'.$result->Default_Picture)}}" alt="list image">
                              </div>
                              <div class="list-content-box">
                                <div class="list-title-box">
                                        <h1 class="list-title">
                                            <a href="{{URL::to($lang.'/propriete?id='.$result->id) }}" class="toplink">{{Helper::GetBuildingType($result->TypeID,$lang)}} {{Lang::get('website-lang.to_sell') }} - {{ number_format($result->Price, 0, ',', ' ') }} $</a>
                                        </h1>
                                        <p class="list-address-box"><span><i class="fa fa-map-marker"></i></span> {{ Helper::GetCityName($result->CityID) . ', ' . $result->HouseNumber . ' ' . $result->StreetName . ', ' . strtoupper($result->Postal_code) }} </p>
                                  </div>
                                  <div class="list-description">
                                     @if($lang=='EN')
                                        {{ $result->Description_en }}
                                        @else

                                        {{ $result->Description_fr }} 

                                        @endif
                                        <a class="read-button" href="{{URL::to($lang .'/propriete?id='.$result->id) }}"> {{ Lang::get('website-lang.read_more') }} <i class="fa fa-caret-right"></i></a>
                                        
                                    <span class="highlight_txt"><i class="fa fa-caret-right"></i>
                                        <span class="caracterictique" {{ ($result->Total_rooms_number==0)?'style=display:none;':'style=display:inline;'}}>      {{ $result->Total_rooms_number }} {{ Lang::get('website-lang.room') }}, </span>
                                        <span class="caracterictique" {{ ($result->Rooms_number==0)?'style=display:none;':'style=display:inline;'}}>            {{ $result->Rooms_number }} {{ Lang::get('website-lang.Chambre') }}, </span>
                                        <span class="caracterictique" {{ ($result->Bathroom_number==0)?'style=display:none;':'style=display:inline;'}}>         {{ $result->Bathroom_number }} {{ Lang::get('website-lang.bathroom') }}, </span>
                                        <span class="caracterictique" {{ ($result->Living_area_size_feet==0)?'style=display:none;':'style=display:inline;'}}>   {{ Lang::get('website-lang.living_space_area') }}, {{ $result->Living_area_size_feet }} ft<sup>2</sup>, </span>
                                        <span class="caracterictique" {{ ($result->Parking_outdoor_number==0 && $result->Parking_garage_number==0 )?'style=display:none;':'style=display:inline;'}}>  {{ $result->Parking_outdoor_number + $result->Parking_garage_number }} {{ Lang::get('website-lang.private_outdoor_parking') }}, </span> 
                                        <span class="caracterictique" {{ ($result->Garage==0)?'style=display:none;':'style=display:inline;'}}> {{ Lang::get('website-lang.Garage') }}, </span> 
                                        <span class="caracterictique" {{ ($result->Pool==0)?'style=display:none;':'style=display:inline;'}}> {{ Lang::get('website-lang.Pool') }}, </span> 
                                        <span class="caracterictique" {{ ($result->No_neighbors_behind==0)?'style=display:none;':'style=display:inline;'}}> {{ Lang::get('website-lang.no_neighbors_behind') }}, </span> 
                                    </span>
                                        
                                    <br />
                                    <br />
                                    
                                    <input type="hidden" name="buildingID" value="{{$result->id}}" />

                                    <button type="submit" data-id="{{$result->id}}" class="submit-button rem_favorite btn">{{ Lang::get('website-lang.remove_favorite')}}</button>
                                  </div>  
                              </div>
                          </div>
                          @endforeach 
                  </div>
                  <div role="tabpanel" class="tab-pane" id="List">
                   @if(count($building)==0) {{Lang::get('website-lang.record_not_found')}}. <br />Si vous venez d'acheter un forfait, essayer de rafraichir la page! @endif
                      @foreach($building as $key => $result)   
                    <div class="search-list clear">
                            <h4 class="list-title"><span>Forfait : {{Helper::GetForfaitName($result->PackageID,$lang)}}</span></h4>
                            <div class="list-img-box">
                                @if($result->Default_Picture == "")
                                    <img src="{{ URL::asset('website/images/default_building.jpg')}}" alt="list image">
                                @else
                                    <img src="{{ URL::asset('uploads/building/' . $result->id . '/'.$result->Default_Picture)}}" alt="list image">
                                @endif
                                
                                @if($result->status == 3)
                                    <h1 style="color:Red;"><span>Vendu</span></h1>
                                @endif

                                @if($result->status == 2)
                                {!! Form::open(array('url' => URL::to($lang.'/closeBuilding'),'method'=>'post','id'=>'closebuilding','class'=>'form-horizontal','onsubmit'=>'return confirm("Cette action fermera définitivement votre annonce, êtes-vous sûre de vouloir continuer?");'))!!}   
                                <div class="form-group">
                                    <br />
                                  <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="submit-button btn">J'ai vendu</button>
                                  </div>
                                </div>
                                    <input type="hidden" name="buildingID" value="{{$result->id}}" />
                                {!! Form::close() !!}
                                @endif
                              </div>
                              <div class="list-content-box">                              
                                    @if($result->status == 1)
                                 
                                 <div class="btn-modifs">
                                
                                        @if($result->TransactionID == 0)
                                         <div class="col-md-4">
                                            <a class="submit-button btn" href="{{URL::to('/transactions?buildingID='.$result->id) }}"> {{ Lang::get('website-lang.request_broker') }} </a>
                                            <br /><br />
                                            <span class="orange-title">Étape 1 </span><br /><br /><span>Choisir de 1 à 3 courtiers immobiliers volontaires qui vous rencontrerons GRATUITEMENT pour vous donner l’opinion de la valeur marchande de votre propriété et répondre à vos questions sur la mise en marché et la mise en valeur de celle-ci !</span>
                                         </div>  

                                            @if($result->Default_Picture != "")
                                            <div class="col-md-4">
                                                <a class="submit-button btn" href="{{URL::to('/mes-images?buildingID='.$result->id) }}">{{ Lang::get('website-lang.change_my_pictures') }}</a>
                                                <br /><br />  
                                                <span class="orange-title">Étape 2 </span><br /><br /><span>Notre photographe professionnel vous contactera directement pour prendre rendez-vous! Effectuer la mise en valeur de votre propriété avant qu’il ne passe chez vous!</span>
                                            </div> 
                                            @else
                                            <div class="col-md-4">
                                                <a class="submit-button btn" target="_blank" href="{{URL::asset('uploads/feuille-preparation-pour-seance photo.pdf')}}">Préparation photos <i class="fa fa-file-pdf-o"></i></a>
                                                <br /><br />  
                                                <span class="orange-title">Étape 2 </span><br /><br /><span>Notre photographe professionnel vous contactera directement pour prendre rendez-vous! Effectuer la mise en valeur de votre propriété avant qu’il ne passe chez vous!</span>
                                            </div> 
                                            @endif
                                         <div class="col-md-4">
                                            <a class="submit-button btn" onclick="return alert('Vous devez d’abord choisir vos courtiers immobiliers volontaires!');"> {{ Lang::get('website-lang.edit_informations') }} </a>
                                            <br /><br /> 
                                            <span class="orange-title">Étape 3 </span><br /><br /><span>Description de votre propriété et Mise en ligne de votre annonce. Lorsque vous aurez terminé votre annonce, cliquez sur "Activer mon annonce" pour la mettre en ligne!</span>     
                                         </div>
                                        @elseif(Helper::CheckIfBrokerIsAlreadySelectedForBuilding($result->TransactionID))
                                        <div class="col-md-4"> 
                                            <a class="submit-button btn" href="{{URL::to($lang .'/choisir-mon-courtier?transactionID='.$result->TransactionID) }}"> {{ Lang::get('website-lang.select_a_broker') }} </a>
                                        </div>

                                            @if($result->Default_Picture != "")
                                            <div class="col-md-4">
                                                <a class="submit-button btn" href="{{URL::to('/mes-images?buildingID='.$result->id) }}">{{ Lang::get('website-lang.change_my_pictures') }}</a>
                                                <br /><br />  
                                                <span class="orange-title">Étape 2 </span><br /><br /><span>Notre photographe professionnel vous contactera directement pour prendre rendez-vous! Effectuer la mise en valeur de votre propriété avant qu’il ne passe chez vous!</span>
                                            </div> 
                                            @else
                                            <div class="col-md-4"> 
                                                <a class="submit-button btn" target="_blank" href="{{URL::asset('uploads/feuille-preparation-pour-seance photo.pdf')}}">Préparation photos <i class="fa fa-file-pdf-o"></i></a>
                                                <br /><br />  
                                                <span class="orange-title">Étape 2 </span><br /><br /><span>Notre photographe professionnel vous contactera directement pour prendre rendez-vous! Effectuer la mise en valeur de votre propriété avant qu’il ne passe chez vous!</span>
                                            </div> 
                                            @endif
                                         <div class="col-md-4">
                                            <a class="submit-button btn" href="{{URL::to('/mon-compte/register-house/create?buildingID='.$result->id) }}"> {{ Lang::get('website-lang.edit_informations') }} </a>
                                            <br /><br /> 
                                            <span class="orange-title">Étape 3 </span><br /><br /><span>Description de votre propriété et Mise en ligne de votre annonce. Lorsque vous aurez terminé votre annonce, cliquez sur "Activer mon annonce" pour la mettre en ligne!</span> 
                                            <br /><br /> 
                                            @if(Helper::ValidateRequiredBuildingFields($result->id) == "") 
                                            <input type="button" class="submit-button btn" style="background-color:#f26522;" value="Activer mon annonce" onclick="return ActivateMyBuilding({{$result->id}});"/>
                                            @else
                                            <input type="button" class="submit-button btn" style="background-color:#f26522;" value="Activer mon annonce" onclick="return alert('Des champs obligatoires non pas encore été remplis veuillez faire tous les étapes.');"/>
                                            @endif    
                                         </div>
                                        @else
                                        <div class="col-md-4"> 
                                            <a class="submit-button btn" href="{{URL::to($lang .'/voir-mon-courtier?transactionID='.$result->TransactionID) }}"> {{ Lang::get('website-lang.see_my_broker') }} </a>
                                        </div>

                                            @if($result->Default_Picture != "")
                                            <div class="col-md-4">
                                                <a class="submit-button btn" href="{{URL::to('/mes-images?buildingID='.$result->id) }}">{{ Lang::get('website-lang.change_my_pictures') }}</a>
                                                <br /><br />  
                                                <span class="orange-title">Étape 2 </span><br /><br /><span>Notre photographe professionnel vous contactera directement pour prendre rendez-vous! Effectuer la mise en valeur de votre propriété avant qu’il ne passe chez vous!</span>
                                            </div> 
                                            @else
                                            <div class="col-md-4">
                                                <a class="submit-button btn" target="_blank" href="{{URL::asset('uploads/feuille-preparation-pour-seance photo.pdf')}}">Préparation photos <i class="fa fa-file-pdf-o"></i></a>
                                                <br /><br />  
                                                <span class="orange-title">Étape 2 </span><br /><br /><span>Notre photographe professionnel vous contactera directement pour prendre rendez-vous! Effectuer la mise en valeur de votre propriété avant qu’il ne passe chez vous!</span>
                                            </div> 
                                            @endif

                                        <div class="col-md-4">                                 
                                            <a class="submit-button btn" href="{{URL::to($lang .'/mon-compte/register-house/create?buildingID='.$result->id) }}"> {{ Lang::get('website-lang.edit_informations') }} </a>
                                            <br /><br /> 
                                            <span class="orange-title">Étape 3 </span><br /><br /><span>Description de votre propriété et Mise en ligne de votre annonce</span>    
                                            <br /><br /> 
                                            @if(Helper::ValidateRequiredBuildingFields($result->id) == "") 
                                            <input type="button" class="submit-button btn" style="background-color:#f26522;" value="Activer mon annonce" onclick="return ActivateMyBuilding({{$result->id}});"/>
                                            @else
                                            <input type="button" class="submit-button btn" style="background-color:#f26522;" value="Activer mon annonce" onclick="return alert('Des champs obligatoires non pas encore été remplis veuillez faire tous les étapes.');"/>
                                            @endif  
                                        </div>
                                        @endif
                                 </div>
                                    @else
                                        <div class="list-title-box">
                                            <h1 class="list-title">
                                                <a href="{{URL::to($lang.'/propriete?id='.$result->id) }}" class="toplink">{{Helper::GetBuildingType($result->TypeID,$lang)}} {{Lang::get('website-lang.to_sell') }} - {{ number_format($result->Price, 0, ',', ' ') }} $</a>
                                            </h1>
                                            <p class="list-address-box"><span><i class="fa fa-map-marker"></i></span> {{ Helper::GetCityName($result->CityID) . ', ' . $result->HouseNumber . ' ' . $result->StreetName . ', ' . strtoupper($result->Postal_code) }} </p>
                                        </div>
                                        <div class="list-description">
                                            @if($lang=='EN')
                                                {{$result->Description_en}}
                                            @else
                                                {{$result->Description_fr}} 
                                            @endif
                                            <a class="read-button" href="{{URL::to($lang .'/propriete?id='.$result->id) }}"> {{ Lang::get('website-lang.read_more') }} <i class="fa fa-caret-right"></i></a>
                                    
                                            <span class="highlight_txt"><i class="fa fa-caret-right"></i>
                                                <span class="caracterictique" {{ ($result->Total_rooms_number==0)?'style=display:none;':'style=display:inline;'}}>      {{ $result->Total_rooms_number }} {{ Lang::get('website-lang.room') }}, </span>
                                                <span class="caracterictique" {{ ($result->Rooms_number==0)?'style=display:none;':'style=display:inline;'}}>            {{ $result->Rooms_number }} {{ Lang::get('website-lang.Chambre') }}, </span>
                                                <span class="caracterictique" {{ ($result->Bathroom_number==0)?'style=display:none;':'style=display:inline;'}}>         {{ $result->Bathroom_number }} {{ Lang::get('website-lang.bathroom') }}, </span>
                                                <span class="caracterictique" {{ ($result->Living_area_size_feet==0)?'style=display:none;':'style=display:inline;'}}>   {{ Lang::get('website-lang.living_space_area') }}, {{ $result->Living_area_size_feet }} ft<sup>2</sup>, </span>
                                                <span class="caracterictique" {{ ($result->Parking_outdoor_number==0 && $result->Parking_garage_number==0 )?'style=display:none;':'style=display:inline;'}}>  {{ $result->Parking_outdoor_number + $result->Parking_garage_number }} {{ Lang::get('website-lang.private_outdoor_parking') }}, </span> 
                                                <span class="caracterictique" {{ ($result->Garage==0)?'style=display:none;':'style=display:inline;'}}> {{ Lang::get('website-lang.Garage') }}, </span> 
                                                <span class="caracterictique" {{ ($result->Pool==0)?'style=display:none;':'style=display:inline;'}}> {{ Lang::get('website-lang.Pool') }}, </span> 
                                                <span class="caracterictique" {{ ($result->No_neighbors_behind==0)?'style=display:none;':'style=display:inline;'}}> {{ Lang::get('website-lang.no_neighbors_behind') }}, </span> 
                                            </span>
                                            
                                            <div class="btn-modifs">
                                            @if($result->TransactionID == 0)

                                            <div class="col-md-4"> 
                                              <a class="submit-button btn" href="{{URL::to($lang .'/transactions?buildingID='.$result->id) }}"> {{ Lang::get('website-lang.request_broker') }} </a>
                                            </div>

                                                @if($result->Default_Picture != "")
                                                <div class="col-md-4">
                                                    <a class="submit-button btn" href="{{URL::to('/mes-images?buildingID='.$result->id) }}">{{ Lang::get('website-lang.change_my_pictures') }}</a>
                                                </div> 
                                                @endif
                                             <div class="col-md-4">
                                                    <a class="submit-button btn" onclick="return alert('Vous devez d’abord choisir vos courtiers immobiliers volontaires!');"> {{ Lang::get('website-lang.edit_informations') }} </a>
                                             </div>
                                            @elseif(Helper::CheckIfBrokerIsAlreadySelectedForBuilding($result->TransactionID))

                                            <div class="col-md-4"> 
                                              <a class="submit-button btn" href="{{URL::to($lang .'/choisir-mon-courtier?transactionID='.$result->TransactionID) }}"> {{ Lang::get('website-lang.select_a_broker') }} </a>
                                            </div>

                                                @if($result->Default_Picture != "")
                                                <div class="col-md-4">
                                                    <a class="submit-button btn" href="{{URL::to('/mes-images?buildingID='.$result->id) }}">{{ Lang::get('website-lang.change_my_pictures') }}</a>
                                                </div> 
                                                @endif
                                            
                                            <div class="col-md-4">                                        
                                              <a class="submit-button btn" href="{{URL::to($lang .'/mon-compte/register-house/create?buildingID='.$result->id) }}"> {{ Lang::get('website-lang.edit_informations') }} </a>
                                            </div>
                                            @else

                                            <div class="col-md-4"> 
                                              <a class="submit-button btn" href="{{URL::to($lang .'/voir-mon-courtier?transactionID='.$result->TransactionID) }}"> {{ Lang::get('website-lang.see_my_broker') }} </a>
                                            </div>
                                            
                                                @if($result->Default_Picture != "")
                                                <div class="col-md-4">
                                                    <a class="submit-button btn" href="{{URL::to('/mes-images?buildingID='.$result->id) }}">{{ Lang::get('website-lang.change_my_pictures') }}</a>
                                                </div> 
                                                @endif
                                            
                                            <div class="col-md-4">                                        
                                              <a class="submit-button btn" href="{{URL::to($lang .'/mon-compte/register-house/create?buildingID='.$result->id) }}"> {{ Lang::get('website-lang.edit_informations') }} </a>
                                            </div>
                                            @endif
                                            
                                            </div>
                                            
                                        </div>  
                                    @endif
                              </div>
                          </div>
                          @endforeach 
                   @if(count($building)!=0) <span class="help-text">Si vous avez des questions pendant la création ou la modification de votre annonce, appelez-nous au 1-844-321-CLIC (2542).</span> @endif
                  
                  </div>
                  <div role="tabpanel" class="tab-pane" id="Password">
                    <div class="edit-profile-box col-sm-6 col-sm-offset-3">
                    <!-- <form class="form-horizontal"> -->
                     <div id="resetError" style="color:red"></div>
                     <div id="ressuccess" style="color:green"></div>
                        {!! Form::open(array('url' => URL::to($lang.'/changePassword'),'method'=>'post','id'=>'changePasswprdForm','class'=>'form-horizontal'))!!}   
                        <div class="form-group">
                          <label for="inputPassword3" class="col-sm-4 control-label">{{ Lang::get('website-lang.old_password') }} :</label>
                          <div class="col-sm-8">                            
                            {!! Form::password('old_password', array('class' => 'form-control','placeholder'=>Lang::get('website-lang.old_password'))) !!}
                            <div id="old_password_err" style="color:red"></div>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label for="inputPassword3" class="col-sm-4 control-label">{{ Lang::get('website-lang.Password') }} :</label>
                          <div class="col-sm-8">
                           {!! Form::password('new_password', array('class' => 'form-control','placeholder'=>Lang::get('website-lang.Password'))) !!}
                           <div id="new_password_err" style="color:red"></div>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label for="inputPassword3" class="col-sm-4 control-label">Re-{{ Lang::get('website-lang.Password') }} :</label>
                          <div class="col-sm-8">
                            {!! Form::password('confirm_password', array('class' => 'form-control','placeholder'=>'Re-' . Lang::get('website-lang.Password'))) !!}
                            <div id="cnew_password_err" style="color:red"></div>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" id="resetBtn" class="submit-button btn">{{ Lang::get('website-lang.submit') }}</button>
                          </div>
                        </div>
                      {!! Form::close() !!}
                      </div>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="Transactions">
                    @if(count($transactions)==0) {{Lang::get('website-lang.record_not_found')}} @endif
                        @foreach($transactions as $key => $result)   
                            <div class="search-list clear">
                              <div class="row">  
                                <div class="col-md-3">
                                  <h4>No transaction</h4>
                                    <span>{{sprintf("%09s", $result->ID)}}</span>
                                </div>
                                <div class="col-md-3">
                                  <h4>Date de la demande</h4>
                                    <span>{{$result->Transaction_Date}}</span>
                                </div>
                                <div class="col-md-3">
                                  <h4>Adresse</h4>
                                    <span>{{$result->AddressNumber . " " . $result->StreetName . ", " . $result->CityName}}</span>
                                </div>    
                                          
                                @if($result->Status == 0)
                                    <div class="col-md-3">
                                      <h4>Actions</h4>
                                        <a class="submit-button btn" href="{{URL::to($lang .'/choisir-mon-courtier?transactionID='.$result->ID) }}"> {{ "Choisir mon " . Helper::GetBrokerOrSpecialisteName($result->Transaction_Type) }} </a>
                                    </div>
                                @else
                                    <div class="col-md-3">
                                      <h4>Actions</h4>
                                        <a class="submit-button btn" href="{{URL::to($lang .'/voir-mon-courtier?transactionID='.$result->ID) }}"> {{ "Voir mon " . Helper::GetBrokerOrSpecialisteName($result->Transaction_Type) }} </a>
                                    </div>  
                                @endif
                              </div>
                            </div>
                        @endforeach 
                  </div>
                </div>
              </div>
          </div>    
        </div>
    </div>
    <!--content end--> 
@stop 