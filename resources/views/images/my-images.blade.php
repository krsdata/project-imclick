@extends('layouts.master') 
@section('content') 
@include('include.header-menu')
<!--content start-->
<div class="content-box">
    <div class="container">
        <div id="link" style="position: absolute; z-index: 10; background: white; padding: 10px; display: none; width: 220px;">
        </div>
        <div class="row">
            <div class="col-sm-6 admin-side">
            	<h3>Choisir mes images</h3>
            </div>
            <div class="col-sm-6 admin-side">
            	<h3 style="float:right">Photos sélectionnées : <span id="SpanImgCount">0</span> sur <span>{{$package->Picture_HDR}}</span></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 admin-side">
                <p>Cliquer sur les {{$package->Picture_HDR}} images que vous désirez afficher dans votre annonce. Vous pouvez choisir un titre pour chacune des images que vous avez sélectionnées. Ensuite, cliquer sur le bouton "Modifier l'ordre de mes images" dans le bas de cette page pour ordonner vos images comme elles paraîtront dans votre annonce!</p>
            </div>
        </div>
        <div class="row">
            @foreach ($images as $key => $bimage)
            <div class="col-sm-2">
                @if($bimage->enable == 0)
                <img class="select_img_elements" ImageID="{{$bimage->ID}}" onclick="return Checkimage($(this),{{$package->Picture_HDR}});" src="{{ URL::asset('uploads/building/'.$bimage->BuildingID.'/'.$bimage->File_name)}}" data-medium-img="{{ URL::asset('uploads/building/'.$building[0]->id.'/'.$bimage->File_name)}}" data-big-img="{{ URL::asset('uploads/building/'.$building[0]->id.'/'.$bimage->File_name)}}" data-title="@if($lang=='FR') {{$bimage->Value_FR}} @else {{$bimage->Value_EN}} @endif" alt=""> 
                @else
                <img class="selected_img_elements" ImageID="{{$bimage->ID}}" onclick="return Checkimage($(this),{{$package->Picture_HDR}});" src="{{ URL::asset('uploads/building/'.$bimage->BuildingID.'/'.$bimage->File_name)}}" data-medium-img="{{ URL::asset('uploads/building/'.$building[0]->id.'/'.$bimage->File_name)}}" data-big-img="{{ URL::asset('uploads/building/'.$building[0]->id.'/'.$bimage->File_name)}}" data-title="@if($lang=='FR') {{$bimage->Value_FR}} @else {{$bimage->Value_EN}} @endif" alt="">                 
                @endif
                <form id="SaveImageTitle-{{$bimage->ID}}" action="/" method="get">
                    <select name="title" class="SlectBox images-description" ImageID="{{$bimage->ID}}">
                        <option value="">Veuillez choisir</option>
                        @foreach ($titles as $key => $title)
                            <option value="{{$title->ID}}" @if($bimage->Title== $title->ID) selected='selected' @endif>{{$title->Value_FR}}</option>
                        @endforeach  
                    </select>
                    <input name="buildingID" type="hidden" value="{{$buildingID}}" />
                    <input name="imageId" type="hidden" value="{{$bimage->ID}}" />
                </form>
            </div>       
            @endforeach  
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form id="formsaveimages" action="/" method="get">
                    <input id="cmdSaveSelectedImages" class="btn save-btn" type="button" name="name" value="Sauvegarder" />
                    <input id="buildingID" name="buildingID" type="hidden" value="{{$buildingID}}" />
                    <input id="imagesIds" name="imagesIds" type="hidden" value="" />
                </form>
                <a class="btn tips-btn" href="{{URL::to('/images?buildingID='.$buildingID) }}">Modifier l'ordre des images</a>
                <a class="btn tips-btn" target="_blank" href="{{URL::asset('uploads/feuille-preparation-pour-seance photo.pdf')}}">Voir conseils <i class="fa fa-file-pdf-o"></i></a>
                <a class="btn tips-btn" href="{{ url($lang.'/mon-compte#List') }}">Retour </a>
                <span id="msgindeximage"></span>
            </div>
        </div>
    </div>
</div>
<script>
    setTimeout(function () { $(".SlectBox").find("span").css("font-size", "14px"); $("#SpanImgCount").html($(".selected_img_elements").length); }, 300);
</script>
<!--content end-->
@stop