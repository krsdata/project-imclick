
<div class="col-md-6"> 
    
    <div class="form-group{{ $errors->first('Title', ' has-error') }}">
    </div>  
    @if($building[0]->Default_Picture == "")
        Vous devez choisir un image par d&eacute;faut avant d'ajouter des images.
    @else
  {!! Form::hidden('BuildingID',$bid, ['class' => 'form-control', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group{{ $errors->first('File_name', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">File name</label>
        <div class="col-lg-8 col-md-8"> 
            
          @if(isset($buildingImage->File_name))  {!! Form::hidden('tmpPicture',$buildingImage->File_name)  !!} @endif
            {!! Form::file('File_name[]', ['class' => 'user_picture', 'multiple' => '']) !!}
            <span class="label label-danger">{{ $errors->first('File_name', ':message') }}</span>
           @if(isset($buildingImage->File_name)) <a target="_blank" href="{{  URL::asset('uploads/buildingImage/'.$buildingImage->File_name)  }}"   >View Picture</a>@endif
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
 <a href="{{ route('buildingImage','q='.$bid) }}"><i class="fa fa-fw  fa-file-image-o" title="View image"></i>View Images</a>
    @endif
     
    
 

</div>
      