@extends('layouts.master')
    @section('content') 
        @include('include.search') 
        <!--content start-->
<div class="content-box">
 <div class="container">
  <div class="row">
      <div class="col-sm-2">
          @include('include.left-menu')
      </div>
      <div class="col-sm-10"> 
        <div class="contant-box">
            <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
              @if(!isset(Auth::user()->UserID))
                <div class="panel panel-default">
                  <div id="headingFirst" role="tab" class="panel-heading">
                    <h4 class="panel-title">
                      <a aria-controls="departments" aria-expanded="true" href="#departments" data-parent="#accordion" data-toggle="collapse" role="button" class="">
                        {{Lang::get('website-lang.login_or_sign_up')}}<span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span>
                      </a>
                    </h4>
                  </div>
                  <div aria-labelledby="headingFirst" role="tabpanel" class="panel panel-collapse collapse in" id="departments" aria-expanded="true" style="">
                  <div class="panel-body">
                   <div class="col-md-2"></div>
                      <div class="col-md-8">
                           <div class="modal-body">
                              <div class="col-md-12">
                                <div class="login-tab">
                                    <ul class="nav nav-tabs" role="tablist">
                                      <li role="presentation" ><a class="alogin" href="#Login" aria-controls="Login" role="tab" data-toggle="tab" onclick="$('.aregister').css('display','inline');$(this).css('display','none');">{{Lang::get('website-lang.sign_in')}}</a></li>
                                      <li role="presentation" class="active"><a class="aregister" href="#Register" aria-controls="Register" style="display:none;" role="tab" data-toggle="tab" onclick="$('.alogin').css('display','inline');$(this).css('display','none');">{{Lang::get('website-lang.Register')}}</a></li>
                                    </ul>
                                      <!-- Tab panes -->
                                  <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane =" id="Login">
                                         {!! Form::open(array('url' => URL::to($lang.'/login'),'method'=>'post','id'=>'loginFormPackage'))!!}   
                                        <div class="main-field-box">
                                          <div id="loginErrorPackage"></div>
                                            <div class="field-box">
                                                 {!! Form::label(Lang::get('website-lang.email'), Lang::get('website-lang.email')) !!} 
                                              {!! Form::email('email',null, ['class'=>'field-input','id'=>'email', 'placeholder'=>'']) !!}  
                                            </div>
                                            
                                            <div class="field-box">
                                              {!! Form::label(Lang::get('website-lang.Password'), Lang::get('website-lang.Password')) !!}
                                              {!! Form::password('password', ['class'=>'field-input','id'=>'password', 'placeholder'=>'']) !!}  
                                            </div>
                                            
                                            <div class="field-box">
                                                <button type="submit" id="loginBtn" value="{{Lang::get('website-lang.log_in')}}" class="login-button">{{Lang::get('website-lang.log_in')}}</button>
                                            </div>
                                            
                                            <div class="field-box field-link">

                                             <span class="space-box"></span>  <a href="javascript:void(0)" id="login-model" data-toggle="modal" data-target="#lost-pwd-modal">{{ Lang::get('website-lang.Lost_your_password')}}</a>
                                                
                                            </div>                
                                        </div>
                                         {!! Form::close() !!}
                                    </div>
                                    <div role="tabpanel" class="tab-pane active" id="Register">
                                           {!! Form::open(array('url' => URL::to($lang.'/signup'),'method'=>'post','id'=>'registerFormPackage'))!!}               
                                        <div class="main-field-box">
                                            <div id="regError"></div>
                                            <div class="field-box">
                                              {!! Form::label(Lang::get('website-lang.FirstName'), Lang::get('website-lang.FirstName')) !!}
                                              {!! Form::text('FirstName', null,['class'=>'field-input','id'=>'FirstName', 'placeholder'=>'']) !!}  
                                            </div>
                                            <div class="field-box">
                                              {!! Form::label(Lang::get('website-lang.LastName'), Lang::get('website-lang.LastName')) !!}
                                              {!! Form::text('LastName', null,['class'=>'field-input','id'=>'LastName', 'placeholder'=>'']) !!}
                                            </div>
                                            <div class="field-box">
                                              {!! Form::label(Lang::get('website-lang.email'), Lang::get('website-lang.email')) !!}
                                              {!! Form::email('email', null,['class'=>'field-input',  'id'=>'email', 'placeholder'=>'']) !!}
                                            </div>
                                            <div class="field-box">
                                              {!! Form::label(Lang::get('website-lang.Cell'), Lang::get('website-lang.Cell')) !!}
                                              {!! Form::Number('Cell', null,['class'=>'field-input', 'id'=>'Cell', 'placeholder'=>'','min'=>1]) !!}
                                            </div>
                                            <div class="field-box">
                                              {!! Form::label(Lang::get('website-lang.Password'), Lang::get('website-lang.Password')) !!}
                                              {!! Form::password('password', ['class'=>'field-input', 'id'=>'password' , 'placeholder'=>'']) !!}
                                            </div> 
                                            <div class="field-box">
                                              {!! Form::label(Lang::get('website-lang.con_pwd'), Lang::get('website-lang.con_pwd')) !!}
                                              {!! Form::password('confirm_password', ['class'=>'field-input', 'id'=>'confirm_password' , 'placeholder'=>'']) !!}
                                            </div>
                                            <div class="field-box">
                                              {!! Form::submit(Lang::get('website-lang.Submit'), ['class' => 'login-button','id'=>'registerBtn']) !!} 
                                            </div> 
                                        </div>
                                         {!! Form::close() !!}
                                    </div>
                                  </div>
                                </div> 
                              </div>
                              <div class="col-md-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              @endif
              @if(isset(Auth::user()->UserID)) 
                <div class="panel panel-default">
                    <div id="headingOne" role="tab" class="panel-heading">
                      <h4 class="panel-title">
                        <a aria-controls="Need" aria-expanded="true" href="#Need" data-parent="#accordion" data-toggle="collapse" role="button" class="">
                        <div style="width:100%; float:left">
                          @if($package->Month!=0) 
                            {{--*/ $fb_ad_amt = (100)+(round(((round(100)*5)/100),2))+(round(((round(100)*9.975)/100),2)) /*--}}
                          @else
                            {{--*/ $fb_ad_amt = 0 /*--}}
                          @endif 
                         <span style="float: left;">Informations pour le forfait : {{ $package->NameFR}}  , Montant total : </span>  

                          <div class="without_fb">${{ ($package->Price)+(round(((round($package->Price)*5)/100),2))+(round(((round($package->Price)*9.975)/100),2)) }}</div>
                            <div class="with_fb_amt" style="display:none">
                              ${{ round((($package->Price)+(round(((round($package->Price)*5)/100),2))+(round(((round($package->Price)*9.975)/100),2))+$fb_ad_amt),2) }}
                            </div><span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span>
                          </div>  
                        </a>
                      </h4>
                    </div>
                    <div aria-labelledby="headingOne" role="tabpanel" class="panel panel-collapse collapse in" id="Need" aria-expanded="true" style="">
                    <div class="panel-body">
                      <div class="alert alert-primary primary show-grid col-md-10">
                        <table class="table table-bordered pull-right" align="center">
                          <thead>
                            <tr> 
                              @if($package->id == 3)
                              <th style="width: 80%;">Forfait {{ $package->NameFR}}, Durée jusqu'à la vente</th>
                              @else
                              <th style="width: 80%;">Forfait {{ $package->NameFR}}, Durée de {{ $package->Month}} mois</th>
                              @endif
                              <th>${{ round($package->Price,2) }}</th>
                            </tr>
                          </thead>
                          <tbody>
                             <tr> 
                              <td>TPS : 5.0% </td>
                              <td>${{ round(((round($package->Price)*5)/100),2)}}</td>
                            </tr>
                            <tr> 
                              <td>TVQ : 9.975%</td>
                              <td>${{ round(((round($package->Price)*9.975)/100),2)}}</td>
                            </tr> 
                            <tr class="with_fb_amt" style="display:none">
                                <td>Publicités ciblées sur Facebook $100+(TVQ 9.975%)+(TPS 5%) </td>
                                <td>
                                  ${{ (100)+(round(((round(100)*5)/100),2))+(round(((round(100)*9.975)/100),2)) }}
                                 </td> 
                            </tr> 
                            <tr> 
                              <td>Total Facture</td>
                              <td> 
                                <div class="without_fb">${{  
                                  round(($package->Price)+(round(((round($package->Price)*5)/100),2))+(round(((round($package->Price)*9.975)/100),2)),2) }}</div>
                                <div class="with_fb_amt" style="display:none">
                                  ${{ ($package->Price)+(round(((round($package->Price)*5)/100),2))+(round(((round($package->Price)*9.975)/100),2))+round($fb_ad_amt,2) }}
                                </div>
                              </td> 
                            </tr>
                          </tbody>
                        </table>
                      <div style="float:left; width:100%">
                        @if($package->Month!=0) 
                          <div class="alert alert-success success show-grid payment_msg">
                            <input type="checkbox" value="100" name="targeted_advertising" id="targeted_advertising"> Publicités ciblées sur Facebook (100$)
                          </div> 
                        @endif
                      </div>
                     <div style="float:left; width:100%">
                        @if($errors->any()) 
                           <div class="alert alert-danger"> 
                            <h4>Une erreur s'est produite. Veuillez r&eacute;essayer !</h4> 
                           </div>
                        @endif 
                      </div>  
                    </div>  
                    <div class="col-md-12 paymentMsg">  
                      <div class="col-md-6"> 
                          {!! Form::model($payment, ['route' => ['payment.store'],'class'=>'form-horizontal','id'=>'paypal_pro']) !!}
                            {!! Form::hidden('package_id',$packageID)!!}
                            <input type="hidden" name="fb_add_amt" class="fb_add_amt" id="fb_add_amt" value="">
                            <div class="row contact-field">
                              <div class="form-group clear">
                              <div class="col-sm-8">
                                 <div class="col-sm-8">
                                      <img src="{{URL::asset('website/images/credit.png')}}">  
                                  </div> 
                              </div>
                              </div>
                              <div class="form-group clear">
                                  <div class="col-sm-8">
                                    <label>Numéro de carte *</label>
                                    <input type="hidden" name="fb_add_amt" id="fb_add_amt" class="fb_add_amt" value="">
                                    {!! Form::text('credit_card',null, ['class' => 'form-control form-cascade-control input-small','id'=>'credit_card','maxlength'=>'16'])  !!}
                                    <span class="label label-danger">{{ $errors->first('credit_card', ':message') }}</span>
                                  </div>
                              </div>
                              <div class="form-group clear">
                                  <div class="col-sm-8">
                                    <label>CVV *</label>
                                    {!! Form::text('cvv',null, ['class' => 'form-control form-cascade-control input-small','id'=>'cvv','maxlength'=>'3'])  !!}
                                    <span class="label label-danger">{{ $errors->first('cvv', ':message') }}</span>
                                   </div>
                              </div>
                             <div class="form-group clear">
                              <label style="margin-left:15px;">Date d'expiration</label>
                                <div class="selelct-box">
                                     <div class="col-md-4">
                                        <select name="month" class="form-control" id="expiry_month">
                                            <option value="">Mois</option>
                                          @for($i=1; $i<=12; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                          @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                      <select name="year" class="form-control" id="expiry_yr">
                                        <option value="">Année</option>
                                        @for($i=date('Y'); $i<=date('Y')+20; $i++)
                                          <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                      </select>
                                    </div>
                                </div>
                              </div>
                               <div class="form-group clear">
                                  <div class="col-sm-8">
                                    <label> </label>
                                      <div class="alert alert-danger danger credit_err_msg"  style="display:none"></div>
                                   </div>
                              </div>

                               <div class="col-sm-8">
                                <button class="submit-button pay_by_paypal" type="submit" id="">Payer</button>
                               </div>
                            </div>
                          </form>
                        </div>
                        <div class="col-md-2 line" style="height: 350px; border-left: 0px dashed rgb(204, 204, 204);"></div>
                        <div class="col-md-4">
                          {!! Form::close() !!}
                            <div class="col-md-10">
                               <label>Pay with Paypal Account </label> 
                                {!! Form::model($payment, ['route' => ['payment.store'],'class'=>'form-horizontal','id'=>'express_checkout']) !!}
                                  {!! Form::hidden('package_id',$packageID)!!}
                                  <input type="hidden" name="fb_add_amt" class="fb_add_amt" id="fb_add_amt" value="">
                                  <input type="hidden" name="package_id" value="{{$packageID}}">
                                  <input type="hidden" name="credit_card" value="{{$packageID}}">
                                  <input type="hidden" name="month" value="{{$packageID}}">
                                  <input type="hidden" name="year" value="{{$packageID}}">
                                  <input type="hidden" name="cvv" value="{{$packageID}}">
                                  <input type="hidden" name="card_type" value="{{$packageID}}">
                                  <button class="submit-button pay_by_paypal1 btn-primary btn" type="submit" id="pay_by_paypal">Pay Now</button>
                                {!! Form::close() !!}
                            </div>
                       </div>
                    </div>
                  </div>
                </div>
              </div> 
            @endif
          </div>
        </div>
      </div>
    </div>    
  </div>
</div>
@stop