
<div class="col-md-6"> 

      {!! Form::hidden('BuildingID',isset($bid)?$bid:null, ['class' => 'form-control']) !!}
     <div class="form-group{{ $errors->first('Room', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Room  </label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::number('Room',null, ['class' => 'form-control','min'=>'1']) !!}
            <span class="label label-danger">{{ $errors->first('Room', ':message') }}</span>
        </div>
    </div> 
     <div class="form-group{{ $errors->first('Stage', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Stage </label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Number('Stage',null, ['class' => 'form-control','min'=>'1']) !!}
            <span class="label label-danger">{{ $errors->first('Stage', ':message') }}</span>
        </div>
    </div> 
     <div class="form-group{{ $errors->first('Width_X', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Width_X </label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Number('Width_X',null, ['class' => 'form-control','min'=>'1']) !!}
            <span class="label label-danger">{{ $errors->first('Width_X', ':message') }}</span>
        </div>
    </div> 

      <div class="form-group{{ $errors->first('Height_Y', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Height_Y </label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Number('Height_Y',null, ['class' => 'form-control','min'=>'1']) !!}
            <span class="label label-danger">{{ $errors->first('Height_Y', ':message') }}</span>
        </div>
    </div> 

    

     <div class="form-group{{ $errors->first('Floor_type[]', ' has-error') }}">
       <label class="col-lg-4 col-md-4 control-label">Floor type </label>
       <div class="col-lg-8 col-md-8"> 
      <select name = "Floor_type[]" class="form-control select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
         @foreach($buildingChoice as $key => $value)

          <option value="{{ $value->ID }}"  @if(isset($ftype[intval($key)]) && $value->ID == $ftype[intval($key)]) selected="selected"  @endif  > {{ $value->ID }}  </option>
         @endforeach
       
      </select>
      @if(Session::has('flash_alert_notice')) <span class="label label-danger">  {{ Session::get('flash_alert_notice') }} </span>@endif
      </div>
    </div><!-- /.form-group -->
                  
     
   
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
      