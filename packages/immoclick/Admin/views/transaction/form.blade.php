    <div class="col-md-6">   
    {!! Form::hidden('id', $mytransaction[0]->ID, array('id' => 'id')) !!}  

     <div class="form-group{{ $errors->first('BuyOrSold', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Buy or Sold</label>
        <div class="col-lg-8 col-md-8">            
            {{--*/ $buysold=array('0'=>'Buy','1'=>'Sold'); /*--}}
            {!! Form::select('BuyOrSold', $buysold, $mytransaction[0]->BuyOrSold , ['class' => 'form-control']) !!}            
        </div>
    </div>
    
    <div class="form-group{{ $errors->first('CourtierID', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">CourtierID</label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Text('CourtierID',$mytransaction[0]->CourtierID, ['class' => 'form-control']) !!}          
        </div>
    </div>  
   
    <div class="form-group{{ $errors->first('Address', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Address</label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Text('Address',$mytransaction[0]->Address, ['class' => 'form-control' ]) !!}          
        </div>
    </div>
    
    <div class="form-group{{ $errors->first('AddressNumber', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">AddressNumber</label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Text('AddressNumber',$mytransaction[0]->AddressNumber, ['class' => 'form-control' ]) !!}          
        </div>
    </div>
    
    <div class="form-group{{ $errors->first('Appartement', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Appartement</label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Text('Appartement',$mytransaction[0]->Appartement, ['class' => 'form-control' ]) !!}          
        </div>
    </div>
   
    <div class="form-group{{ $errors->first('visitor', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">visitor</label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Text('visitor',$mytransaction[0]->visitor, ['class' => 'form-control' ]) !!}          
        </div>
    </div>

    <div class="form-group{{ $errors->first('Status', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Status</label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Text('Status',$mytransaction[0]->Status, ['class' => 'form-control' ]) !!}          
        </div>
    </div>

    <div class="form-group{{ $errors->first('TypeOfProperty', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">TypeOfProperty</label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Text('TypeOfProperty',$mytransaction[0]->TypeOfProperty, ['class' => 'form-control' ]) !!}          
        </div>
    </div>

    <div class="form-group{{ $errors->first('End_Date', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">End Date</label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Text('End_Date',$mytransaction[0]->End_Date, ['class' => 'form-control' ,'id'=>'end_date', 'readonly'=>'readonly' ]) !!}          
        </div>
    </div>

    <div class="form-group{{ $errors->first('SectorID', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Sector ID</label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Text('SectorID',$mytransaction[0]->SectorID, ['class' => 'form-control' ]) !!}          
        </div>
    </div>

    <div class="form-group{{ $errors->first('StreetType', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Street Type</label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Text('StreetType',$mytransaction[0]->StreetType, ['class' => 'form-control' ]) !!}          
        </div>
    </div>

    <div class="form-group{{ $errors->first('StreetName', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Street Name</label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Text('StreetName',$mytransaction[0]->StreetName, ['class' => 'form-control' ]) !!}          
        </div>
    </div>

    <div class="form-group{{ $errors->first('CityName', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">City Name</label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Text('CityName',$mytransaction[0]->CityName, ['class' => 'form-control' ]) !!}          
        </div>
    </div>

    <div class="form-group{{ $errors->first('PostalCode', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Postal Code</label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Text('PostalCode',$mytransaction[0]->PostalCode, ['class' => 'form-control' ]) !!}          
        </div>
    </div>

    <div class="form-group{{ $errors->first('SectorResearched', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">SectorResearched</label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Text('SectorResearched',$mytransaction[0]->SectorResearched, ['class' => 'form-control' ]) !!}          
        </div>
    </div>

    <div class="form-group{{ $errors->first('AddedByBroker', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">AddedByBroker</label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Text('AddedByBroker',$mytransaction[0]->AddedByBroker, ['class' => 'form-control' ]) !!}          
        </div>
    </div>

    <div class="form-group{{ $errors->first('Date', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">PropertyID</label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Text('PropertyID',$mytransaction[0]->PropertyID, ['class' => 'form-control' ]) !!}          
        </div>
    </div>

    <div class="form-group{{ $errors->first('PAFinale', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">PAFinale</label>
        <div class="col-lg-8 col-md-8"> 
              {!! Form::Text('PAFinale',$mytransaction[0]->PAFinale, ['class' => 'form-control' ]) !!}          
        </div>
    </div>    

    <div class="form-group">
        <label class="col-lg-4 col-md-4 control-label"></label>
        <div class="col-lg-2 col-md-2">

            {!! Form::submit('Submit', ['class'=>'btn btn-primary text-white']) !!}
        </div>
         <div class="col-lg-2 col-md-2">
             <a href="{{ route('transaction') }}">
            {!! Form::button('Back', ['class'=>'btn btn-primary text-white']) !!} </a>
        </div>
    </div>  

</div>
      