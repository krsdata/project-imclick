
<div class="col-md-6"> 

      {!! Form::hidden('BuildingID',isset($bid)?$bid:null, ['class' => 'form-control']) !!}
    
     <div class="form-group{{ $errors->first('Type', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label"> Type </label>
        <div class="col-lg-8 col-md-8"> 
             <select name="Type" class="form-control">
                  <option value="1 1/2">1 1/2</option>
                  <option value="2 1/2">2 1/2</option>
                  <option value="3 1/2">3 1/2</option>
                  <option value="4 1/2">4 1/2</option>
                  <option value="5 1/2">5 1/2</option>
                  <option value="6 1/2">6 1/2</option>
                  <option value="7 1/2">7 1/2</option>
             </select>
            <span class="label label-danger">{{ $errors->first('Type', ':message') }}</span>
        </div>
    </div> 

     <div class="form-group{{ $errors->first('price_by_month', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Price by month </label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Number('price_by_month',null, ['class' => 'form-control','min'=>'1']) !!}
            <span class="label label-danger">{{ $errors->first('price_by_month', ':message') }}</span>
        </div>
    </div> 
     <div class="form-group{{ $errors->first('  already_rent', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label"> Already rent </label>
        <div class="col-lg-8 col-md-8"> 
             <select name="already_rent" class="form-control">
               <option value="0">NO</option>
               <option value="1">Yes</option>
             </select>
            <span class="label label-danger">{{ $errors->first('already_rent', ':message') }}</span>
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
      