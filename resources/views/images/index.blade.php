@extends('layouts.master') 
@section('content') 
@include('include.header-menu')
<!--content start-->          
<style>
#sortable { list-style-type: none; margin: 0; padding: 0; float:left; width:100%;}
#sortable li { margin: 3px 3px 3px 0; padding: 1px; float: left; width: 185px; height: 125px; text-align: center; }
</style>
<div class="content-box">
    <div class="container">
        <div id="link" style="position: absolute; z-index: 10; background: white; padding: 10px; display: none; width: 220px;">
        </div>
        <div class="row">
            <!--right start-->
            <div class="col-sm-12 admin-side">
            	<h3>Ordre des images</h3>
                <p>Cliquer et glisser les images pour ajuster l'ordre dans lequel elles seront affichées</p>
                
                <ul id="sortable">
                    @foreach ($images as $key => $bimage)
                        <li class="ui-state-default" id="item-{{$bimage->ID}}"><img class="img_elements" src="{{ URL::asset('uploads/building/'.$bimage->BuildingID.'/'.$bimage->File_name)}}" data-medium-img="{{ URL::asset('uploads/building/'.$building[0]->id.'/'.$bimage->File_name)}}" data-big-img="{{ URL::asset('uploads/building/'.$building[0]->id.'/'.$bimage->File_name)}}" data-title="@if($lang=='FR') {{$bimage->Value_FR}} @else {{$bimage->Value_EN}} @endif" alt=""></li>
                    @endforeach
                </ul>             
            </div>          

        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <input id="cmdSaveindeximages" class="btn save-btn" type="button" name="name" value="Sauvegarder" />
                <a class="btn tips-btn" target="_blank" href="{{URL::asset('uploads/feuille-preparation-pour-seance photo.pdf')}}">Voir conseils <i class="fa fa-file-pdf-o"></i></a>
                <a class="btn tips-btn" href="{{URL::to('/mes-images?buildingID='.$building[0]->id) }}">Retour </a>
                <span id="msgindeximage"></span>
            </div>
        </div>
        
    </div>
</div>
<!--content end-->
@stop