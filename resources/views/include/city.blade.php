<div tabindex="0" class="SumoSelect">
    <select class="SlectBox" placeholder="towns" name="towns[]" id="city_region" multiple="multiple" style="display: none;">
         
@foreach ( $arr_region['region'] as $key => $value) 
<option value="{{ $key }}" style="font-weight: bold;">---{{ $value }}---</option>
@foreach ($arr_city['city_'.$key] as $key => $value)
<option  value="{{ $key }}"> 
    {{  $value }} 
</option>
@endforeach 
@endforeach 


<div tabindex="0" class="SumoSelect">
    <select class="SlectBox" placeholder="towns" name="towns[]" id="city_region" multiple="multiple" style="display: none;">
       @foreach ( $arr_region['region'] as $key => $value) 
<option value="{{ $key }}" style="font-weight: bold;">---{{ $value }}---</option>
@foreach ($arr_city['city_'.$key] as $key => $value)
<option  value="{{ $key }}"> 
    {{  $value }} 
</option>
@endforeach 
@endforeach 

    </select>
    
    
    <p class="CaptionCont SlectBox">
        <span class="placeholder">towns</span>
        <label><i></i></label></p>
    <div class="optWrapper multiple">
        <ul class="options">
           
        @foreach ( $arr_region['region'] as $key => $value) 
 
            @foreach ($arr_city['city_'.$key] as $key => $value)
             <li data-val="{{ $key }}"><span><i></i></span><label>
                {{  $value }} 
            </label></li>
            @endforeach 
        @endforeach 

        </ul>
        <div class="MultiControls">
            <p class="btnOk">OK</p><p class="btnCancel">Cancel</p>
        </div>
    </div>
</div>