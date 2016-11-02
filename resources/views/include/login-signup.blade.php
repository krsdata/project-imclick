@if(!Auth::user())
<div class="modal fade hide in" id="loginModal"  role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="modal-close-button" data-dismiss="modal" aria-label="Close">&times;</button>      
        <div class="modal-body">
          <div class="login-tab">
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a class="alogin" href="#Login" aria-controls="Login" style="display:none;" role="tab" data-toggle="tab" onclick="$('.aregister').css('display','inline');$(this).css('display','none');">{{Lang::get('website-lang.sign_in')}}</a></li>
                <li role="presentation"><a class="aregister" href="#Register" aria-controls="Register" role="tab" data-toggle="tab" onclick="$('.alogin').css('display','inline');$(this).css('display','none');">{{Lang::get('website-lang.Register')}}</a></li>
              </ul>
            
              <!-- Tab panes -->
          <div class="tab-content">
            
            <div role="tabpanel" class="tab-pane active" id="Login">
                 {!! Form::open(array('url' => URL::to($lang.'/login'),'method'=>'post','id'=>'loginForm'))!!}   
                <div class="main-field-box">
                  <div id="loginError"></div>
                    <div class="field-box">
                        {!! Form::label(Lang::get('website-lang.email'), Lang::get('website-lang.sign_in')) !!} 
                        {!! Form::email('email',null, ['class'=>'field-input','id'=>'email', 'placeholder'=>Lang::get('website-lang.email')]) !!}  
                    </div>
                    
                    <div class="field-box">
                        {!! Form::password('password', ['class'=>'field-input','id'=>'password', 'placeholder'=>Lang::get('website-lang.Password')]) !!}  
                    </div>
                    
                    <div class="field-box">
                        <input type="checkbox" name="" value=""/> {{ Lang::get('website-lang.Remember_Password')}} 
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
            
            <div role="tabpanel" class="tab-pane" id="Register">
            	   {!! Form::open(array('url' => URL::to($lang.'/signup'),'method'=>'post','id'=>'registerForm'))!!}               
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
                      {!! Form::label(Lang::get('website-lang.Cell'), Lang::get('website-lang.phone')) !!}
                      {!! Form::Number('Phone', null,['class'=>'field-input', 'id'=>'Cell', 'placeholder'=>'','min'=>1]) !!}
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
                        {!! Form::checkbox('conditions', 1, null) !!} J'accepte les <a href="{{URL::to('condition-dutilisation')}}" target="_blank">conditions d'utilisation</a>
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
      
    </div>
  </div>
</div>

<div class="modal fade immo-modal" id="lost-pwd-modal" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="modal-close-button" data-dismiss="modal" aria-label="Close">&times;</button>      
        <div class="modal-body">
            {!! Form::open(array('url' => URL::to($lang.'/reset'),'method'=>'post','id'=>'resetForm'))!!}   
                <div class="main-field-box">
                    <div class="field-box field-box-remove">
                        {!! Form::label(Lang::get('website-lang.email'), Lang::get('website-lang.email')) !!} 
                        {!! Form::email('email',null, ['class'=>'field-input','id'=>'email', 'placeholder'=>'','required'=>'required']) !!}  
                    </div> 
                    <div class="field-box"><div id="resetError"></div></div>
                    <div class="field-box field-box-remove">
                        <button type="submit" id="resetBtn" class="login-button">{{Lang::get('website-lang.submit')}}</button>
                    </div>
                </div>
             {!! Form::close() !!}
        </div>
    </div>
  </div>
</div>

@else
<div class="modal fade immo-modal" id="fav-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="modal-close-button" data-dismiss="modal" aria-label="Close">&times;</button>      
        <div class="modal-body">
          <p>{{Lang::get('website-lang.You_have_successfully_added_favorite')}}</p>
        </div>
    </div>
  </div>
</div> 
<!--login end-->    
@endif