
<div class="col-md-3"> 
      

    
    <div class="form-group{{ $errors->first('PackageID', ' has-error') }}">
        <label class="col-md-12  ">Package Title (EN) </label>
        <div class="col-md-12"> 
            
             <select name="PackageID" id="PackageID" class="form-control form-cascade-control input-small">
                <option value="">-- Select --</option>
                   @foreach ($package as $key => $value)
                    
                    <option value="{{ $value->id }}" @if($value->id==$building->id) selected @endif >{{ $value->NameEN }}</option>
                   
                   @endforeach
            </select>
            <span class="label label-danger">{{ $errors->first('PackageID', ':message') }}</span>
        </div>
    </div> 

    <div class="form-group{{ $errors->first('PackageID', ' has-error') }}">
        <label class="col-md-12  ">Package Title (FR) </label>
        <div class="col-md-12"> 
               <select name="PackageID" id="PackageID" class="form-control form-cascade-control input-small">
                <option value="">-- Select --</option>
                  @foreach ($package as $key => $value)
                   
                    <option value="{{ $value->id }}" @if($value->id==$building->id) selected="selected" @endif>{{ $value->NameFR }}</option>
                   
                   @endforeach  
            </select>
            <span class="label label-danger">{{ $errors->first('PackageID', ':message') }}</span>
        </div>
    </div> 

         <div class="form-group{{ $errors->first('CityID', ' has-error') }}">
        <label class="col-md-12  ">City</label>
        <div class="col-md-12"> 
            <select name="CityID" id="CityID" class="form-control form-cascade-control input-small">
                <option value="">Select City</option>
                  @foreach ($city as $key => $value)
                    <option value="{{ $value->id }}" @if($value->id==$building->CityID) selected="selected" @endif>{{ $value->CityName }}</option>
                   @endforeach  
            </select>
            <span class="label label-danger">{{ $errors->first('CityID', ':message') }}</span>
        </div>
    </div> 
    
    <div class="form-group{{ $errors->first('CategoryID', ' has-error') }}">
        <label class="col-md-12  ">Category  </label>
        <div class="col-md-12"> 
            <select name="CategoryID" id="CategoryID" class="form-control form-cascade-control input-small">
                <option value="">Select Category</option>
                    @foreach ($bcat as $key => $value)
                    <option value="{{ $value->id }}" @if($value->id==$building->CategoryID) selected="selected" @endif>{{ $value->NameFR }}</option>
                   @endforeach   
            </select>
            <span class="label label-danger">{{ $errors->first('CategoryID', ':message') }}</span>
        </div>
    </div> 

     <div class="form-group{{ $errors->first('TypeID', ' has-error') }}">
        <label class="col-md-12  "> Type </label>
        <div class="col-md-12"> 
           <select name="TypeID" id="TypeID" class="form-control form-cascade-control input-small">
                <option value="">Select Category</option>
                  @foreach ($btype as $key => $value)
                    <option value="{{ $value->id }}" @if($value->id==$building->id) selected="selected" @endif>{{ $value->NameFR }}</option>
                   @endforeach  
            </select>
            <span class="label label-danger">{{ $errors->first('TypeID', ':message') }}</span>
        </div>
    </div> 
    
    
    
     <div class="form-group{{ $errors->first('Built_in', ' has-error') }}">
        <label class="col-md-12  "> Built in </label>
        <div class="col-md-12"> 
            {!! Form::text('Built_in',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Built_in', ':message') }}</span>
        </div>
    </div> 
    
     <div class="form-group{{ $errors->first('Price', ' has-error') }}">
        <label class="col-md-12  "> Price </label>
        <div class="col-md-12"> 
            {!! Form::text('Price',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Price', ':message') }}</span>
        </div>
    </div> 
    
    
     <div class="form-group{{ $errors->first('Address', ' has-error') }}">
        <label class="col-md-12  "> HouseNumber </label>
        <div class="col-md-12"> 
            {!! Form::text('HouseNumber',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('HouseNumber', ':message') }}</span>
        </div>
    </div> 
     
    
  <div class="form-group{{ $errors->first('Picture', ' has-error') }}">
        <label class="col-md-12  ">Picture</label>
        <div class="col-md-12"> 
            
          @if(isset($building->Default_Picture))  {!! Form::hidden('tmpPicture',$building->Default_Picture)  !!} @endif
            {!! Form::file('Picture', ['class' => 'user_picture']) !!}
            <span class="label label-danger">{{ $errors->first('Picture', ':message') }}</span>
            @if(isset($building->Default_Picture)) <a href="{{  URL::asset('uploads/building/'.$building->id.'/'.$building->Default_Picture)  }}" target="_blank"   >View Picture</a>@endif
        </div>
    </div> 
    
    
    <div class="form-group{{ $errors->first('City_Name', ' has-error') }}">
        <label class="col-md-12  "> City Name </label>
        <div class="col-md-12"> 
            {!! Form::text('City_Name',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('City_Name', ':message') }}</span>
        </div>
    </div> 
    
    <div class="form-group{{ $errors->first('Postal_code', ' has-error') }}">
        <label class="col-md-12  "> Postal code </label>
        <div class="col-md-12"> 
            {!! Form::text('Postal_code',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Postal_code', ':message') }}</span>
        </div>
    </div> 
    
    <div class="form-group{{ $errors->first('Start_Date', ' has-error') }}">
        <label class="col-md-12  ">Start Date </label>
        <div class="col-md-12"> 
            {!! Form::text('Start_Date',null, ['class' => 'form-control form-cascade-control input-small datepicker','id'=>'Start_Date'])  !!}
            <span class="label label-danger">{{ $errors->first('Start_Date', ':message') }}</span>
        </div>
    </div> 
    
    <div class="form-group{{ $errors->first('End_Date', ' has-error') }}">
        <label class="col-md-12  ">End Date </label>
        <div class="col-md-12"> 
            {!! Form::text('End_Date',null, ['class' => 'form-control form-cascade-control input-small datepicker','id'=>'End_Date'])  !!}
            <span class="label label-danger">{{ $errors->first('End_Date', ':message') }}</span>
        </div>
    </div> 
    
     <div class="form-group{{ $errors->first('Latitude', ' has-error') }}">
        <label class="col-md-12  ">Latitude </label>
        <div class="col-md-12"> 
            {!! Form::text('Latitude',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Latitude', ':message') }}</span>
        </div>
    </div>
    
    <div class="form-group{{ $errors->first('Longitude', ' has-error') }}">
        <label class="col-md-12  ">Longitude </label>
        <div class="col-md-12"> 
            {!! Form::text('Longitude',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Longitude', ':message') }}</span>
        </div>
    </div>
    
    
    <div class="form-group{{ $errors->first('Star', ' has-error') }}">
        <label class="col-md-12  ">Star </label>
        <div class="col-md-12"> 
            {!! Form::text('Star',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Star', ':message') }}</span>
        </div>
    </div>
      
    
    <div class="form-group{{ $errors->first('Rooms_number', ' has-error') }}">
        <label class="col-md-12  ">Rooms number </label>
        <div class="col-md-12"> 
            {!! Form::text('Rooms_number',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Rooms_number', ':message') }}</span>
        </div>
    </div>

   <div class="form-group{{ $errors->first('Bathroom_number', ' has-error') }}">
        <label class="col-md-12  ">Bathroom number </label>
        <div class="col-md-12"> 
            {!! Form::text('Bathroom_number',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Bathroom_number', ':message') }}</span>
        </div>
    </div>

       <div class="form-group{{ $errors->first('Parking_outdoor_number', ' has-error') }}">
        <label class="col-md-12  ">Parking outdoor number </label>
        <div class="col-md-12"> 
            {!! Form::text('Parking_outdoor_number',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Parking_outdoor_number', ':message') }}</span>
        </div>
    </div>

    <div class="form-group{{ $errors->first('Parking_garage_number', ' has-error') }}">
        <label class="col-md-12  ">Parking garage number </label>
        <div class="col-md-12"> 
            {!! Form::text('Parking_garage_number',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Parking_garage_number', ':message') }}</span>
        </div>
    </div>

</div>
<div class="col-md-3"> 
     <div class="form-group{{ $errors->first('Sold', ' has-error') }}">
        <label class="col-md-12  ">Sold </label>
        <div class="col-md-12"> 
            {!! Form::text('Sold',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Sold', ':message') }}</span>
        </div>
    </div>
 

     <div class="form-group{{ $errors->first('Brand_new', ' has-error') }}">
        <label class="col-md-12  ">Brand new </label>
        <div class="col-md-12"> 
            {!! Form::text('Brand_new',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Brand_new', ':message') }}</span>
        </div>
    </div>


     <div class="form-group{{ $errors->first('Free_tour', ' has-error') }}">
        <label class="col-md-12  ">Free tour </label>
        <div class="col-md-12"> 
            {!! Form::text('Free_tour',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Free_tour', ':message') }}</span>
        </div>
    </div>
 


     <div class="form-group{{ $errors->first('Living_area_size_feet', ' has-error') }}">
        <label class="col-md-12  ">Living area size feet</label>
        <div class="col-md-12"> 
            {!! Form::text('Living_area_size_feet',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Living_area_size_feet', ':message') }}</span>
        </div>
    </div>
 

  <!-- -->
    <div class="form-group{{ $errors->first('Property_size_feet', ' has-error') }}">
        <label class="col-md-12  ">Property size feet </label>
        <div class="col-md-12"> 
            {!! Form::text('Property_size_feet',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Property_size_feet', ':message') }}</span>
        </div>
    </div>
     <!-- -->
    <div class="form-group{{ $errors->first('Living_area_size_meter', ' has-error') }}">
        <label class="col-md-12  ">Living area size meter </label>
        <div class="col-md-12"> 
            {!! Form::text('Living_area_size_meter',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Living_area_size_meter', ':message') }}</span>
        </div>
    </div>
     <!-- -->
    <div class="form-group{{ $errors->first('Property_size_meter', ' has-error') }}">
        <label class="col-md-12  ">Property size meter </label>
        <div class="col-md-12"> 
            {!! Form::text('Property_size_meter',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Property_size_meter', ':message') }}</span>
        </div>
    </div>
     <!-- -->
    <div class="form-group{{ $errors->first('Garage', ' has-error') }}">
        <label class="col-md-12  ">Garage </label>
        <div class="col-md-12"> 
            {!! Form::text('Garage',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Garage', ':message') }}</span>
        </div>
    </div>
     <!-- -->
    <div class="form-group{{ $errors->first('Pool', ' has-error') }}">
        <label class="col-md-12  ">Pool </label>
        <div class="col-md-12"> 
            {!! Form::text('Pool',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Pool', ':message') }}</span>
        </div>
    </div>
     <!-- -->
    <div class="form-group{{ $errors->first('No_neighbors_behind', ' has-error') }}">
        <label class="col-md-12  ">No neighbors behind </label>
        <div class="col-md-12"> 
            {!! Form::text('No_neighbors_behind',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('No_neighbors_behind', ':message') }}</span>
        </div>
    </div>
     <!-- -->
    <div class="form-group{{ $errors->first('Mortgage_by_year', ' has-error') }}">
        <label class="col-md-12  ">Mortgage by year </label>
        <div class="col-md-12"> 
            {!! Form::text('Mortgage_by_year',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Mortgage_by_year', ':message') }}</span>
        </div>
    </div>
     <!-- -->
    <div class="form-group{{ $errors->first('Municipal_taxes_by_year', ' has-error') }}">
        <label class="col-md-12  ">Municipal taxes by year </label>
        <div class="col-md-12"> 
            {!! Form::text('Municipal_taxes_by_year',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Municipal_taxes_by_year', ':message') }}</span>
        </div>
    </div>
     <!-- -->
    <div class="form-group{{ $errors->first('School_taxes_by_year', ' has-error') }}">
        <label class="col-md-12  ">School taxes by year </label>
        <div class="col-md-12"> 
            {!! Form::text('School_taxes_by_year',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('School_taxes_by_year', ':message') }}</span>
        </div>
    </div>
     <!-- -->
    <div class="form-group{{ $errors->first('Electricity_by_year', ' has-error') }}">
        <label class="col-md-12  "> Electricity by year </label>
        <div class="col-md-12"> 
            {!! Form::text('Electricity_by_year',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Electricity_by_year', ':message') }}</span>
        </div>
    </div>
     <!--+++++ -->
    <div class="form-group{{ $errors->first('Insurance_by_year', ' has-error') }}">
        <label class="col-md-12  ">Insurance by year </label>
        <div class="col-md-12"> 
            {!! Form::text('Insurance_by_year',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Insurance_by_year', ':message') }}</span>
        </div>
    </div>
      <!--+++++ -->
    <div class="form-group{{ $errors->first('Description_fr', ' has-error') }}">
        <label class="col-md-12  ">Description fr </label>
        <div class="col-md-12"> 
            {!! Form::text('Description_fr',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Description_fr', ':message') }}</span>
        </div>
    </div>
      <!--+++++ -->
    <div class="form-group{{ $errors->first('Description_en', ' has-error') }}">
        <label class="col-md-12  ">Description en </label>
        <div class="col-md-12"> 
            {!! Form::text('Description_en',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Description_en', ':message') }}</span>
        </div>
    </div>
      <!--+++++ -->
    <div class="form-group{{ $errors->first('Evaluation_ground', ' has-error') }}">
        <label class="col-md-12  ">Evaluation ground </label>
        <div class="col-md-12"> 
            {!! Form::text('Evaluation_ground',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Evaluation_ground', ':message') }}</span>
        </div>
    </div>
      <!--+++++ -->
    <div class="form-group{{ $errors->first('Evaluation_building', ' has-error') }}">
        <label class="col-md-12  ">Evaluation building </label>
        <div class="col-md-12"> 
            {!! Form::text('Evaluation_building',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Evaluation_building', ':message') }}</span>
        </div>
    </div>
      <!--+++++ -->
    <div class="form-group{{ $errors->first('Evaluation_total', ' has-error') }}">
        <label class="col-md-12  ">Evaluation total </label>
        <div class="col-md-12"> 
            {!! Form::text('Evaluation_total',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Evaluation_total', ':message') }}</span>
        </div>
    </div>
</div>
<div class="col-md-3">    
      <!--+++++ -->
    <div class="form-group{{ $errors->first('Size_land_frontage', ' has-error') }}">
        <label class="col-md-12  ">Size land frontage </label>
        <div class="col-md-12"> 
            {!! Form::text('Size_land_frontage',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Size_land_frontage', ':message') }}</span>
        </div>
    </div>
      <!--+++++ -->
    <div class="form-group{{ $errors->first('Size_land_depth', ' has-error') }}">
        <label class="col-md-12  ">Size land depth </label>
        <div class="col-md-12"> 
            {!! Form::text('Size_land_depth',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Size_land_depth', ':message') }}</span>
        </div>
    </div>
      <!--+++++ -->
    <div class="form-group{{ $errors->first('Size_land_area', ' has-error') }}">
        <label class="col-md-12  ">Size land area </label>
        <div class="col-md-12"> 
            {!! Form::text('Size_land_area',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Size_land_area', ':message') }}</span>
        </div>
    </div>
      <!--+++++ -->
    <div class="form-group{{ $errors->first('Size_building_depth', ' has-error') }}">
        <label class="col-md-12  ">Size building width </label>
        <div class="col-md-12"> 
            {!! Form::text('Size_building_depth',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('Size_building_depth', ':message') }}</span>
        </div>
    </div>
      <!--+++++ -->
    <div class="form-group{{ $errors->first('indoor_cupboard', ' has-error') }}">
        <label class="col-md-12  ">Indoor cupboard </label>
        <div class="col-md-12"> 
            {!! Form::text('indoor_cupboard',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('indoor_cupboard', ':message') }}</span>
        </div>
    </div>
      <!--+++++ -->
    <div class="form-group{{ $errors->first('indoor_cupboard_other', ' has-error') }}">
        <label class="col-md-12  ">Indoor cupboard_other </label>
        <div class="col-md-12"> 
            {!! Form::text('indoor_cupboard_other',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('indoor_cupboard_other', ':message') }}</span>
        </div>
    </div>
      <!--+++++ -->
    <div class="form-group{{ $errors->first('indoor_heating_energy', ' has-error') }}">
        <label class="col-md-12  ">Indoor heating energy </label>
        <div class="col-md-12"> 
            {!! Form::text('indoor_heating_energy',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('indoor_heating_energy', ':message') }}</span>
        </div>
    </div>
      <!--+++++ -->
    <div class="form-group{{ $errors->first('indoor_heating_energy_other', ' has-error') }}">
        <label class="col-md-12  ">Indoor heating energy other </label>
        <div class="col-md-12"> 
            {!! Form::text('indoor_heating_energy_other',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('indoor_heating_energy_other', ':message') }}</span>
        </div>
    </div>
      <!--+++++ -->
    <div class="form-group{{ $errors->first('indoor_basement', ' has-error') }}">
        <label class="col-md-12  ">Indoor basement </label>
        <div class="col-md-12"> 
            {!! Form::text('indoor_basement',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('indoor_basement', ':message') }}</span>
        </div>
    </div>
      <!--+++++ -->
    <div class="form-group{{ $errors->first('indoor_basement_other', ' has-error') }}">
        <label class="col-md-12  ">Indoor basement other </label>
        <div class="col-md-12"> 
            {!! Form::text('indoor_basement_other',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('indoor_basement_other', ':message') }}</span>
        </div>
    </div>
      <!--+++++ -->
    <div class="form-group{{ $errors->first('indoor_heating_system', ' has-error') }}">
        <label class="col-md-12  ">Indoor heating system </label>
        <div class="col-md-12"> 
            {!! Form::text('indoor_heating_system',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('indoor_heating_system', ':message') }}</span>
        </div>
    </div>
      <!--+++++ -->
    <div class="form-group{{ $errors->first('indoor_heating_system_other', ' has-error') }}">
        <label class="col-md-12  ">Indoor heating system other </label>
        <div class="col-md-12"> 
            {!! Form::text('indoor_heating_system_other',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('indoor_heating_system_other', ':message') }}</span>
        </div>
    </div>
      <!--+++++ -->
    <div class="form-group{{ $errors->first('indoor_windows', ' has-error') }}">
        <label class="col-md-12  ">Indoor windows </label>
        <div class="col-md-12"> 
            {!! Form::text('indoor_windows',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('indoor_windows', ':message') }}</span>
        </div>
    </div>
      <!--+++++ -->
    <div class="form-group{{ $errors->first('indoor_windows_other', ' has-error') }}">
        <label class="col-md-12  ">Indoor windows other </label>
        <div class="col-md-12"> 
            {!! Form::text('indoor_windows_other',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('indoor_windows_other', ':message') }}</span>
        </div>
    </div>
      <!--333 -->
    
    <div class="form-group{{ $errors->first('indoor_windows_type', ' has-error') }}">
        <label class="col-md-12  ">Indoor windows type </label>
        <div class="col-md-12"> 
            {!! Form::text('indoor_windows_type',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('indoor_windows_type', ':message') }}</span>
        </div>
    </div>
      <!--333 -->
    
    <div class="form-group{{ $errors->first('indoor_windows_type_other', ' has-error') }}">
        <label class="col-md-12  ">Indoor windows type other </label>
        <div class="col-md-12"> 
            {!! Form::text('indoor_windows_type_other',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('indoor_windows_type_other', ':message') }}</span>
        </div>
    </div>
      <!--333 -->
    
    <div class="form-group{{ $errors->first('indoor_roofing', ' has-error') }}">
        <label class="col-md-12  ">Indoor roofing </label>
        <div class="col-md-12"> 
            {!! Form::text('indoor_roofing',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('indoor_roofing', ':message') }}</span>
        </div>
    </div>
      <!--333 -->
    
    <div class="form-group{{ $errors->first('indoor_roofing_other', ' has-error') }}">
        <label class="col-md-12  "> Indoor_roofing_other </label>
        <div class="col-md-12"> 
            {!! Form::text('indoor_roofing_other',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('indoor_roofing_other', ':message') }}</span>
        </div>
    </div>
      <!--4444-->
   
    <div class="form-group{{ $errors->first('indoor_equipment_available', ' has-error') }}">
        <label class="col-md-12  ">Indoor equipment available </label>
        <div class="col-md-12"> 
            {!! Form::text('indoor_equipment_available',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('indoor_equipment_available', ':message') }}</span>
        </div>
    </div>
      <!--333 -->
    
    <div class="form-group{{ $errors->first('indoor_equipment_available_other', ' has-error') }}">
        <label class="col-md-12  ">Indoor equipment available other </label>
        <div class="col-md-12"> 
            {!! Form::text('indoor_equipment_available_other',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('indoor_equipment_available_other', ':message') }}</span>
        </div>
    </div>
      <!--333 -->
    </div>
<div class="col-md-3">   
    <div class="form-group{{ $errors->first('outdoor_driveway', ' has-error') }}">
        <label class="col-md-12  ">Outdoor driveway </label>
        <div class="col-md-12"> 
            {!! Form::text('outdoor_driveway',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('outdoor_driveway', ':message') }}</span>
        </div>
    </div>
      <!--333 -->
    
    <div class="form-group{{ $errors->first('outdoor_driveway_other', ' has-error') }}">
        <label class="col-md-12  ">Outdoor driveway other </label>
        <div class="col-md-12"> 
            {!! Form::text('outdoor_driveway_other',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('outdoor_driveway_other', ':message') }}</span>
        </div>
    </div>
      <!--333 -->
    
    <div class="form-group{{ $errors->first('outdoor_water_supply', ' has-error') }}">
        <label class="col-md-12  ">Outdoor water supply </label>
        <div class="col-md-12"> 
            {!! Form::text('outdoor_water_supply',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('outdoor_water_supply', ':message') }}</span>
        </div>
    </div>
      <!--333 -->
    
    <div class="form-group{{ $errors->first('outdoor_water_supply_other', ' has-error') }}">
        <label class="col-md-12  ">Outdoor water supply other </label>
        <div class="col-md-12"> 
            {!! Form::text('outdoor_water_supply_other',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('outdoor_water_supply_other', ':message') }}</span>
        </div>
    </div>
      <!--444 -->
    
    <div class="form-group{{ $errors->first('outdoor_siding', ' has-error') }}">
        <label class="col-md-12  ">Outdoor siding </label>
        <div class="col-md-12"> 
            {!! Form::text('outdoor_siding',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('outdoor_siding', ':message') }}</span>
        </div>
    </div>

     <div class="form-group{{ $errors->first('outdoor_siding_other', ' has-error') }}">
        <label class="col-md-12  ">Outdoor siding other </label>
        <div class="col-md-12"> 
            {!! Form::text('outdoor_siding_other',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('outdoor_siding_other', ':message') }}</span>
        </div>
    </div>
     <div class="form-group{{ $errors->first('outdoor_sewage_system', ' has-error') }}">
        <label class="col-md-12  ">Outdoor sewage system </label>
        <div class="col-md-12"> 
            {!! Form::text('outdoor_sewage_system',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('outdoor_sewage_system', ':message') }}</span>
        </div>
    </div> <div class="form-group{{ $errors->first('outdoor_sewage_system_other', ' has-error') }}">
        <label class="col-md-12  ">Outdoor sewage system other </label>
        <div class="col-md-12"> 
            {!! Form::text('outdoor_sewage_system_other',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('outdoor_sewage_system_other', ':message') }}</span>
        </div>
    </div> <div class="form-group{{ $errors->first('outdoor_landscaping', ' has-error') }}">
        <label class="col-md-12  ">Outdoor landscaping </label>
        <div class="col-md-12"> 
            {!! Form::text('outdoor_landscaping',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('outdoor_landscaping', ':message') }}</span>
        </div>
    </div>
     <div class="form-group{{ $errors->first('outdoor_landscaping_other', ' has-error') }}">
        <label class="col-md-12  ">Outdoor landscaping other </label>
        <div class="col-md-12"> 
            {!! Form::text('outdoor_landscaping_other',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('outdoor_landscaping_other', ':message') }}</span>
        </div>
    </div>

     <div class="form-group{{ $errors->first('outdoor_foundation', ' has-error') }}">
        <label class="col-md-12  ">Outdoor foundation </label>
        <div class="col-md-12"> 
            {!! Form::text('outdoor_foundation',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('outdoor_foundation', ':message') }}</span>
        </div>
    </div>

     <div class="form-group{{ $errors->first('outdoor_foundation_other', ' has-error') }}">
        <label class="col-md-12  ">Outdoor foundation other </label>
        <div class="col-md-12"> 
            {!! Form::text('outdoor_foundation_other',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('outdoor_foundation_other', ':message') }}</span>
        </div>
    </div>

     <div class="form-group{{ $errors->first('outdoor_proximity', ' has-error') }}">
        <label class="col-md-12  ">Outdoor proximity </label>
        <div class="col-md-12"> 
            {!! Form::text('outdoor_proximity',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('outdoor_proximity', ':message') }}</span>
        </div>
    </div>
     <div class="form-group{{ $errors->first('outdoor_proximity_other', ' has-error') }}">
        <label class="col-md-12  ">Outdoor proximity other </label>
        <div class="col-md-12"> 
            {!! Form::text('outdoor_proximity_other',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('outdoor_proximity_other', ':message') }}</span>
        </div>
    </div>

     <div class="form-group{{ $errors->first('outdoor_topography', ' has-error') }}">
        <label class="col-md-12  ">Outdoor topography </label>
        <div class="col-md-12"> 
            {!! Form::text('outdoor_topography',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('outdoor_topography', ':message') }}</span>
        </div>
    </div>

     <div class="form-group{{ $errors->first('outdoor_topography_other', ' has-error') }}">
        <label class="col-md-12  ">Outdoor topography other </label>
        <div class="col-md-12"> 
            {!! Form::text('outdoor_topography_other',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('outdoor_topography_other', ':message') }}</span>
        </div>
    </div>

     <div class="form-group{{ $errors->first('outdoor_garage', ' has-error') }}">
        <label class="col-md-12  ">Outdoor garage </label>
        <div class="col-md-12"> 
            {!! Form::text('outdoor_garage',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('outdoor_garage', ':message') }}</span>
        </div>
    </div>

     <div class="form-group{{ $errors->first('outdoor_garage_other', ' has-error') }}">
        <label class="col-md-12  ">Outdoor garage other </label>
        <div class="col-md-12"> 
            {!! Form::text('outdoor_garage_other',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('outdoor_garage_other', ':message') }}</span>
        </div>
    </div>

     <div class="form-group{{ $errors->first('outdoor_pool', ' has-error') }}">
        <label class="col-md-12  ">Outdoor pool </label>
        <div class="col-md-12"> 
            {!! Form::text('outdoor_pool',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('outdoor_pool', ':message') }}</span>
        </div>
    </div>

     <div class="form-group{{ $errors->first('outdoor_pool_other', ' has-error') }}">
        <label class="col-md-12  ">Outdoor pool other </label>
        <div class="col-md-12"> 
            {!! Form::text('outdoor_pool_other',null, ['class' => 'form-control form-cascade-control input-small'])  !!}
            <span class="label label-danger">{{ $errors->first('outdoor_pool_other', ':message') }}</span>
        </div>
    </div>

</div>
<div class="col-md-12">
<div class="form-group">
        <label class="col-md-12  "></label>
        <div class="col-md-12">

            {!! Form::submit('Submit', ['class'=>'btn btn-primary text-white']) !!}
        </div>
    </div> 
</div>  
 
 <style type="text/css">
.user_picture {
  background: inactivecaption none repeat scroll 0 0;
  border: 1px solid #ccc;
  line-height: 32px;
  width: 100%;
}
 </style>