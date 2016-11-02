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
                <div class="box-header">
                    <form action="{{route('package')}}" method="get">    
                    <div class="col-md-3">
                        <input value="{{ (isset($_REQUEST['search']))?$_REQUEST['search']:''}}" placeholder="search" type="text" name="search" id="search" class="form-control" >
                    </div>
                    <div class="col-md-2">
                        <input type="submit" value="Search" class="btn btn-primary form-control">
                    </div>
                </form>
                  <div class="col-md-2 pull-right">
                    <div style="width: 150px;" class="input-group"> 
                        <a href="{{ route('package.create')}}">
                          <button class="btn  btn-primary"><i class="fa fa-user-plus"></i> Add Package</button> 
                        </a>
                    </div>
                  </div>
                     <div class="col-md-2 pull-right">
                    <div style="width: 150px;" class="input-group"> 
                        <a href="{{ route('package-gallery.create')}}">
                          <button class="btn  btn-primary"><i class="fa fa-user-plus"></i> Add Package Image</button> 
                        </a>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                
                <p>
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
                </p>
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tbody><tr>
                      <th>ID</th>
                      <th>Package Title</th>
                       
                      <th>Package Images</th>
                      <th>Created Date</th>
                     
                      <th>Action</th>
                    </tr>
                     @foreach ($packages as $key => $package)  
                      <tr>
                        <td>{{ $package->id }}</td>
                        <td>{{ $package->package['NameFR']. ' ('.$package->Language.')' }}</td> 
                     
                        <td><a href="{{ url('/uploads/packageGallery/'.$package->PictureName) }}" target="_blank" >View picture</a></td>
                        <td>{{ $package->created_at }}</td>
                        <td> 
                            <a href="{{ route('package-gallery.edit',$package->id)}}">
                                <i class="fa fa-fw fa-pencil-square-o" title="edit"></i> 
                            </a>
                            {!! Form::open(array('class' => 'form-inline pull-left deletion-form', 'method' => 'DELETE',  'id'=>'deleteForm_'.$package->id, 'route' => array('package-gallery.destroy', $package->id))) !!}
                                <button class="delbtn" type="submit"><i class="fa fa-fw fa-trash" title="Delete"></i></button>
                            {!! Form::close() !!} 
                        </td>
                      </tr>
                     @endforeach 
                  </tbody></table>
                </div><!-- /.box-body -->
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
