@extends('packages::layouts.master')
@section('content') 
    @include('packages::partials.main-header')
    <!-- Left side column. contains the logo and sidebar -->
    @include('packages::partials.main-sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper"> 
         @include('packages::partials.breadcrumb')

        <!-- Main content -->
          <section class="content">
            <!-- Small boxes (Stat box) -->
              <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-12">
                       <div class="panel panel-cascade">
                          <div class="panel-body ">
                              <div class="row">
                               <div class="box">
                                <div class="box-header ">
                                 <div class="col-md-12 col-md-border">
                               <!--  <form action="{{route('buildingImage')}}" method="get">    
                                    
                                    <div class="col-md-2 pull-right">
                                        <input type="submit" value="Search" class="btn btn-primary form-control">
                                    </div>
                                    <div class="col-md-3 pull-right">
                                        <input value="{{ (isset($_REQUEST['search']))?$_REQUEST['search']:''}}" placeholder="search" type="text" name="search" id="search" class="form-control" >
                                    </div>
                                </form> -->
                                 <div class="col-md-2 pull-right">
                                 <a href="{{ route('building') }}">
                                   <button class="btn btn-primary form-control"> Back </button>
                                   </a>
                                 </div>
                                   </div>
                                </div><!-- /.box-header -->
                
                     
                                    @if(Session::has('flash_alert_notice'))
                                    <div class="alert alert-success ">
                                         {{ Session::get('flash_alert_notice') }} 
                                    </div>
                                  @endif 
                                  @if(Session::has('alert_class'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('alert_class') }} 
                                    </div>
                                  @endif 
                                 
                                      <div class="box-body table-responsive no-padding">
                                      
                                        <div class="col-md-12"> 
                                          @if(count($buildingImage)==0)
                                           
                                              <div class="alert alert-danger alert-dismissable">
                                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                                <i class="icon fa fa-check"></i>  
                                                {{ 'Record not found. Try again !' }}
                                              </div>
                                            
                                         @endif

                                         @foreach($buildingImage as $key => $value)

                                          <div data-name="Building Image"  class="col-md-3" style=" display: inline-block; opacity: 1;">
                                              <div class="panel panel-cascade panel-gallery thumbnail" >
                                                  <div class="panel-heading ">
                                                   {{ ucfirst($value->Title)}}
                                                  </div>
                                                  <div class="panel-body nopadding">
                                                  <a href="{{ url('uploads/building/'.$value->BuildingID.'/'.$value->File_name) }}"  data-gallery="">
                                                      <img alt="" src="{{ url('uploads/building/'.$value->BuildingID.'/'.$value->File_name) }}" class="gallery-img-height" width="100%" style="max-height:300px">
                                                  </a>
                                              </div>
                                              <a  id="" data-target="#confirm-delete" data-toggle="modal" href="javascript:;">
                                            <button value="" class="btn btn-danger delete_user del_btn" type="button" title="Delete"><i class="fa fa-trash-o"></i></button>
                                          </a>
                                         </div>
                                       
                                          </div>
                                          @endforeach
                                    </div >
                                    </div> 


                                  <div id="blueimp-gallery" class="blueimp-gallery">
                          <!-- The container for the modal slides -->
                              <div class="slides"></div>
                              <!-- Controls for the borderless lightbox -->
                              <h3 class="title"></h3>
                              <a class="prev">‹</a>
                              <a class="next">›</a>
                              <a class="close">×</a>
                              <a class="play-pause"></a>
                              <ol class="indicator"></ol>
                              <!-- The modal dialog, which will be used to wrap the lightbox content -->
                              <div class="modal fade">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button type="button" class="close" aria-hidden="true">&times;</button>
                                          <h4 class="modal-title"></h4>
                                      </div>
                                      <div class="modal-body next"></div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-default pull-left prev">
                                              <i class="glyphicon glyphicon-chevron-left"></i>
                                              Previous
                                          </button>
                                          <button type="button" class="btn btn-primary next">
                                              Next
                                              <i class="glyphicon glyphicon-chevron-right"></i>
                                          </button>
                                      </div>
                                  </div>
                              </div>
    </div>
</div>
<script>
    var buildingImagePage = true;
</script>
<div class="pull-right">{!! $buildingImage->render() !!}</div>
                             </div>
                              </div>
                          </div>
                    </div>
                 </div>
                </div>            
              </div>  

            <!-- Main row --> 
          </section><!-- /.content -->
      </div> 
   
@stop
