
<div class="col-md-6"> 
      
    
    <div class="form-group{{ $errors->first('Package', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Package  </label>
        <div class="col-lg-8 col-md-8"> 
            <select name="Package" id="Package" class="form-control">
                
            @foreach ($packages as $key => $value) 
            <option value="{{ $value->id }}-FR" >{{ $value->NameFR }} - FR</option>
            <option value="{{ $value->id }}-EN">{{ $value->NameEN }} - EN</option>
            @endforeach
            </select>
            <span class="label label-danger">{{ $errors->first('Package', ':message') }}</span>
        </div>
    </div> 

 
 
    <div class="form-group{{ $errors->first('Picture', ' has-error') }}">
        <label class="col-lg-4 col-md-4 control-label">Picture</label>
        <div class="col-lg-8 col-md-8"> 
            
          @if(isset($packageGallery->PictureName))  {!! Form::hidden('tmpPicture',$packageGallery->PictureName)  !!} @endif
            {!! Form::file('Picture', ['class' => 'user_picture']) !!}
            <span class="label label-danger">{{ $errors->first('Picture', ':message') }}</span>
           @if(isset($packageGallery->PictureName)) <a target="_blank" href="{{  URL::asset('uploads/packageGallery/'.$packageGallery->PictureName)  }}"   >View Picture</a>@endif
        </div>
    </div> 
    <div class="form-group">
        <label class="col-lg-4 col-md-4 control-label"></label>
        <div class="col-lg-8 col-md-8">

            {!! Form::submit('Submit', ['class'=>'btn btn-primary text-white']) !!}
        </div>
    </div> 

</div>
 