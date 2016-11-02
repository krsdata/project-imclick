
<div class="col-md-6"> 
      
     <div class="form-group{{ $errors->first('NameFR', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Package Title (FR) </label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('NameFR',null, ['class' => 'form-control form-cascade-control input-small'])  !!} 
            <span class="label label-danger">{{ $errors->first('NameFR', ':message') }}</span>
        </div>
    </div> 
    
    <div class="form-group{{ $errors->first('NameEN', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Package Title (EN) </label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('NameEN',null, ['class' => 'form-control form-cascade-control input-small'])  !!} 
            <span class="label label-danger">{{ $errors->first('NameEN', ':message') }}</span>
        </div>
    </div> 


    
    <div class="form-group{{ $errors->first('Price', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Price</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::text('Price',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Price', ':message') }}</span>
        </div>
    </div> 

     <div class="form-group{{ $errors->first('Month', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Month</label>
        <div class="col-lg-8 col-md-8"> 
            {!! Form::Number('Month',null, ['class' => 'form-control form-cascade-control input-small','min'=>1])  !!}
            <span class="label label-danger">{{ $errors->first('Month', ':message') }}</span>
        </div>
    </div> 
    
   <!--  <div class="form-group{{ $errors->first('Picture', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Picture</label>
        <div class="col-lg-8 col-md-8"> 
            
          @if(isset($package->Picture_HDR))  {!! Form::hidden('tmpPicture',$package->Picture_HDR)  !!} @endif
            {!! Form::file('Picture', ['class' => 'user_picture']) !!}
            <span class="label label-danger">{{ $errors->first('Picture', ':message') }}</span>
           @if(isset($package->Picture_HDR)) <a href="{{  URL::asset('uploads/package/'.$package->Picture_HDR)  }}"   >View Picture</a>@endif
        </div>
    </div>  -->
    <div class="form-group">
        <label class="col-lg-4 col-md-4 control-label"></label>
        <div class="col-lg-8 col-md-8">

            {!! Form::submit('Submit', ['class'=>'btn btn-primary text-white']) !!}
        </div>
    </div> 

</div>
 