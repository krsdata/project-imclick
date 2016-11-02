
<div class="col-md-6">
    
    <div class="form-group{{ $errors->first('FirstName', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label"> First Name <span class="error">*</span></label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('FirstName',null, ['class' => 'form-control form-cascade-control input-small'])  !!} 
            <span class="label label-danger">{{ $errors->first('FirstName', ':message') }}</span>
        </div>
    </div> 

    <div class="form-group{{ $errors->first('LastName', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Last Name</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('LastName',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('LastName', ':message') }}</span>
        </div>
    </div>

    <div class="form-group{{ $errors->first('email', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Email</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::email('email',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('email', ':message') }}</span>
            @if(Session::has('flash_alert_notice')) 
            <span class="label label-danger">
                  
                         {{ Session::get('flash_alert_notice') }} 
                    
                   </span>@endif
        </div>
    </div>

    <!-- <div class="form-group{{ $errors->first('Password', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Password</label>
        <div class="col-lg-8 col-md-8"> 
             <input type="password" name="Password" class="form-control form-cascade-control input-small" value="{{ $user->Password }}">
            <span class="label label-danger">{{ $errors->first('Password', ':message') }}</span>
        </div>
    </div> -->
    
    
    
    <div class="form-group{{ $errors->first('Language', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Language</label>
        <div class="col-lg-8 col-md-8"> 
             <select name="Language" id="Language" class="form-control form-cascade-control input-small">
                <option value="">Select Language</option>
                    <option value="en" {{ ($user->Language=='en')?'selected="selected"':'' }}>EN</option>
                    <option value="fr" {{ ($user->Language=='fr')?'selected="selected"':'' }}>FR</option>
            </select>
            <span class="label label-danger">{{ $errors->first('Language', ':message') }}</span>
        </div>
    </div>
    
    <div class="form-group{{ $errors->first('Phone', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Phone</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('Phone',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Phone', ':message') }}</span>
        </div>
    </div>
    
    <div class="form-group{{ $errors->first('Cell', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Cell</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('Cell',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Cell', ':message') }}</span>
        </div>
    </div>
    
    
    
    <div class="form-group{{ $errors->first('Picture', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Picture</label>
        <div class="col-lg-8 col-md-8"> 
            
          @if(isset($user->Picture))  {!! Form::hidden('is_Picture',$user->Picture)  !!} @endif
            {!! Form::file('Picture', ['class' => 'user_picture']) !!}
            <span class="label label-danger">{{ $errors->first('Picture', ':message') }}</span>
            @if(isset($user->Picture)) <a href="{{  URL::asset('uploads/users/'.$user->Picture)  }}"  target="_blank"  >View Picture</a>@endif
        </div>
    </div>
    
    <div class="form-group{{ $errors->first('WebSite', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Website</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::url('WebSite',null, ['class' => 'form-control form-cascade-control input-small','placeholder'=>'http://google.com'])  !!}
            <span class="label label-danger">{{ $errors->first('WebSite', ':message') }}</span>
        </div>
    </div>
    
     <div class="form-group{{ $errors->first('PostalCode', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Postal Code</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('PostalCode',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('PostalCode', ':message') }}</span>
        </div>
    </div>
    
<!--     <div class="form-group{{ $errors->first('Reference', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Reference</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('Reference',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Reference', ':message') }}</span>
        </div>
    </div>-->
    
    <div class="form-group">
        <label class="col-lg-4 col-md-4 control-label"></label>
        <div class="col-lg-8 col-md-8">

            {!! Form::submit('Submit', ['class'=>'btn btn-primary text-white']) !!}
        </div>
    </div> 

</div>
<div class="col-md-6">
    
    
    <div class="form-group{{ $errors->first('GroupID', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Group ID</label>
        <div class="col-lg-8 col-md-8"> 
             <select name="GroupID" id="GroupID" class="form-control form-cascade-control input-small">
                <option value="">Select Group</option>
                  @foreach ($grps as $key => $grp)  
                         <option value="{{ $grp->id }}" {{ ($user->GroupID==$grp->id)?'selected="selected"':'' }} >{{ $grp->Title }}</option>
                  @endforeach
                
            </select>
            <span class="label label-danger">{{ $errors->first('GroupID', ':message') }}</span>
        </div>
    </div>
    
     <div class="form-group{{ $errors->first('CityID', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">City ID</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('CityID',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('CityID', ':message') }}</span>
        </div>
    </div>
    
     <div class="form-group{{ $errors->first('Adresse', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Adresse</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('Adresse',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Adresse', ':message') }}</span>
        </div>
    </div>
    <div class="form-group{{ $errors->first('BannerID', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">BannerID</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('BannerID',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('BannerID', ':message') }}</span>
        </div>
    </div>
    
    <div class="form-group{{ $errors->first('Transaction_Type', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Transaction Type</label>
        <div class="col-lg-8 col-md-8"> 
            
            <select name="Transaction_Type" id="Transaction_Type" class="form-control form-cascade-control input-small">
                <option value="">Select Transaction Type</option>
                    <option value="1" {{ ($user->Transaction_Type=='1')?'selected="selected"':'' }}>Acheter</option>
                    <option value="2" {{ ($user->Transaction_Type=='2')?'selected="selected"':'' }}>Vendre</option>
                    <option value="3" {{ ($user->Transaction_Type=='3')?'selected="selected"':'' }}>Hypothèque</option>
            
            </select>
            
             <span class="label label-danger">{{ $errors->first('Transaction_Type', ':message') }}</span>
            
            
        </div>
    </div>
    
   
    
    
    <div class="form-group{{ $errors->first('CourtierCityName', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Courtier City Name</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('CourtierCityName',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('CourtierCityName', ':message') }}</span>
        </div>
    </div>
    
<!--     <div class="form-group{{ $errors->first('TempPassword', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Temp Password</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('TempPassword',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('TempPassword', ':message') }}</span>
        </div>
    </div>
    -->
    
<!--     <div class="form-group{{ $errors->first('SmsNumber', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Sms Number</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('SmsNumber',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('SmsNumber', ':message') }}</span>
        </div>
    </div>-->
    <div class="form-group{{ $errors->first('Militaire', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Militaire</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('Militaire',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Militaire', ':message') }}</span>
        </div>
    </div>
    
    <div class="form-group{{ $errors->first('Bilingue', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Bilingue</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('Bilingue',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Bilingue', ':message') }}</span>
        </div>
    </div>
    
    <div class="form-group{{ $errors->first('Vacance', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Vacance</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('Vacance',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Vacance', ':message') }}</span>
        </div>
    </div>
    
    <div class="form-group{{ $errors->first('SignUpDate', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">SignUp Date</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('SignUpDate',null, ['class' => 'form-control form-cascade-control input-small datepicker'])  !!}
            <span class="label label-danger">{{ $errors->first('SignUpDate', ':message') }}</span>
        </div>
    </div>
    
<!--    <div class="form-group{{ $errors->first('LastConnectionDate', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Last Connection Date</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('LastConnectionDate',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('LastConnectionDate', ':message') }}</span>
        </div>
    </div>-->

<!--    <div class="form-group{{ $errors->first('LastSoldDate', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Last Sold Date</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('LastSoldDate',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('LastSoldDate', ':message') }}</span>
        </div>
    </div>-->
    
<!--    <div class="form-group{{ $errors->first('LastBuyDate', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Last Buy Date</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('LastBuyDate',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('LastBuyDate', ':message') }}</span>
        </div>
    </div>-->
    
<!--    <div class="form-group{{ $errors->first('LastTransaction', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Last Transaction</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('LastTransaction',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('LastTransaction', ':message') }}</span>
        </div>
    </div>-->
</div>