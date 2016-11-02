
<div class="col-md-6"> 

      {!! Form::hidden('BuildingID',isset($bid)?$bid:null, ['class' => 'form-control']) !!} 

     <div class="form-group{{ $errors->first('Inclusion', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Exclusion</label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Text('Exclusion',null, ['class' => 'form-control']) !!}
            <span class="label label-danger">{{ $errors->first('Exclusion', ':message') }}</span>
        </div>
    </div> 
     
   
    <div class="form-group">
        <label class="col-lg-4 col-md-4 control-label"></label>
        <div class="col-lg-2 col-md-2">

            {!! Form::submit('Submit', ['class'=>'btn btn-primary text-white']) !!}
        </div>
         <div class="col-lg-2 col-md-2">
             <a href="{{ route('building') }}">
            {!! Form::button('Back', ['class'=>'btn btn-primary text-white']) !!} </a>
        </div>
    </div> 
 
     
    
 

</div>
      