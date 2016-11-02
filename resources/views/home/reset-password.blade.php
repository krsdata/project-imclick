@extends('layouts.master')
    @section('content') 
       
        <!--content start-->
<div class="content-box">
    <div class="container">
        <div class="row"> 
            <!--left start-->
            <div class="col-sm-2"></div>
            <!--left end--> 
            <!--center start-->
            <div class="col-sm-7"> 
                <!--banner slider start-->
                <div class="banner-slider"> 
                     {!! Form::open(array('url' => URL::to($lang.'/reset-password'),'method'=>'post','id'=>'resetPasswprdForm'))!!}   
                        <div class="main-field-box">
                          <div id="resetError"></div>
                            <div class="field-box">
                              {!! Form::label(Lang::get('website-lang.Password'), Lang::get('website-lang.Password')) !!} 
                              {!! Form::password('password', ['class'=>'field-input','id'=>'password', 'placeholder'=>'']) !!}  
                              {!! Form::hidden('email',$email, ['class'=>'field-input','id'=>'']) !!}
                              {!! Form::hidden('token',$hashedPassword, ['class'=>'field-input','id'=>'']) !!}
                            </div> 
                            <div class="field-box">
                             {!! Form::label(Lang::get('website-lang.confirm_password'), Lang::get('website-lang.confirm_password')) !!} 
                              {!! Form::password('confirm_password', ['class'=>'field-input','id'=>'password', 'placeholder'=>'']) !!}  
                            </div> 
                            <div class="field-box">
                                <button type="submit" id="resetBtn" class="login-button">{{Lang::get('website-lang.submit')}}</button>
                            </div>   
                            </div>                   
                        </div>
                    {!! Form::close() !!} 
                </div> 
            </div>
            <!--center end--> 
            <!--right start-->
            <div class="col-sm-3"> </div>
            <!--right end--> 
        </div>    
    </div>
</div> 
@stop