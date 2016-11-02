
<div class="col-md-6"> 

      {!! Form::hidden('UserID',null, ['class' => 'form-control']) !!} 

     <div class="form-group{{ $errors->first('Date', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Date</label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Text('Date',null, ['class' => 'form-control', 'id'=>'breview' ]) !!}
            <span class="label label-danger">{{ $errors->first('Date', ':message') }}</span>
        </div>
    </div> 

    <div class="form-group{{ $errors->first('Rate', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Rate</label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Number('Rate',null, ['class' => 'form-control','id'=>"Rate",'min'=>'1','max'=>'5' ]) !!}
            <span class="label label-danger">{{ $errors->first('Rate', ':message') }}</span>
        </div>
    </div> 

    <div class="form-group{{ $errors->first('saving', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Saving</label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Number('saving',null, ['class' => 'form-control','id'=>"saving" ]) !!}
            <span class="label label-danger">{{ $errors->first('saving', ':message') }}</span>
        </div>
    </div>

    <div class="form-group{{ $errors->first('Text', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Text</label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Textarea('Text',null, ['class' => 'form-control','id'=>"Text" ,'rows'=>2 ]) !!}
            <span class="label label-danger">{{ $errors->first('Text', ':message') }}</span>
        </div>
    </div>


    <div class="form-group{{ $errors->first('Approved', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Approved</label>
        <div class="col-lg-8 col-md-8"> 
             <select name="Approved" id="Approved" class="form-control">
              <option value="0" @if($buildingReview->Approved==0) selected @endif >Yet not Approved</option>
              <option value="1" @if($buildingReview->Approved==1) selected @endif>Approved</option>
              <option value="2" @if($buildingReview->Approved==2) selected @endif>Not Approved</option>
             </select>
            <span class="label label-danger">{{ $errors->first('Approved', ':message') }}</span>
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
      