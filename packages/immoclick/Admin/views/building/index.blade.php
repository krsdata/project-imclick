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
                                    <form action="{{route('building')}}" method="get">    
                                      <div class="col-md-3 pull-right">
                                          <input value="{{ (isset($_REQUEST['search']))?$_REQUEST['search']:''}}" placeholder="search by Name/Email" type="text" name="search" id="search" class="form-control" >
                                          <span class="input-group-btn">
                                              <button type="submit" class="btn btn-danger btn-danger-input">
                                                  <span class="glyphicon glyphicon-search"></span>
                                              </button>
                                          </span>
                                      </div>
                                    </form>  
                                  </div><!-- /.box-header -->
                                 @if(Session::has('flash_alert_notice'))
                                    <div class="alert alert-success alert-dismissable">
                                      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                      <i class="icon fa fa-check"></i>  
                                       {{ Session::get('flash_alert_notice') }} 
                                    </div>
                                   @endif 
                                  <div class="box-body table-responsive no-padding" >
                                    <table class="table table-hover">
                                      <tbody>
                                    
                                      <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                         <th>Email</th>
                                        <th>Package Title (FR)</th>
                                        <th>Default Picture </th>
                                        <th>Type</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                         <th>Status</th>
                                        <th>Created Date</th>
                                       
                                        <th>Action</th>
                                      </tr>
                                      
                                      @if(count($buildings)==0)
                                        <tr>
                                          <td colspan="11">
                                            <div class="alert alert-danger alert-dismissable">
                                              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                              <i class="icon fa fa-check"></i>  
                                              {{ 'Record not found. Try again !' }}
                                            </div>
                                          </td>
                                        </tr>
                                      @endif

                                       @foreach ($buildings as $key => $building)  
                                        <tr>
                                          <td>{{ $building->id }}</td>
                                          <td>{{ $building->user['FirstName'] }} </td>
                                          <td> {{ $building->user['email'] }} </td>
                                          <td>{{ $building->package['NameFR'] }} </td>
                                          <td> <a target="_blank" href="{{ url('uploads/building/'.$building->id.'/'.$building->Default_Picture) }}">View Picture</a></td>
                                          <td>{{ $building->btype['NameEN'] }} </td>
                                          <td>{{ $building->bcategory['NameEN'] }} </td>
                                          <td>{{ $building->Price }} </td>
                                           <td>

                                          <span class="label label-{{ ($building->status==2)?'success':'warning'}} status" id="{{$building->id}}" data="{{$building->status}}" onclick="changeStatusBuilding({{$building->id}},'building')" >
                                          @if($building->status==1)
                                          {{'Inactive'}}
                                          @elseif($building->status==2)
                                          {{'Active'}}
                                          @elseif($building->status==3)
                                          {{'Vendu'}}
                                          @endif

                                          </span>

                                            </td>
                                           <td>{{ $building->updated_at }} </td>
                                          <td> 
                   
                                          <div class="dropup">
                                              <button id="btn{{ $building->id }}" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action
                                                <span class="caret"></span>
                                              </button>
                                              <ul class="dropdown-menu action-dropdown" aria-labelledby="dropdownMenu1">
                                                
                                                <li><a href="{{ route('building.edit',$building->id)}}"><i class="fa fa-fw fa-pencil-square-o" title="edit"></i> Edit Building</a></li>
                                                <li role="separator" class="divider"></li>
                                                <li><a href="{{ route('buildingImage.create','q='.$building->id) }}"><i class="fa fa-fw  fa-plus-square" title="Add image"></i> Add Image</a></li>
                                                <li role="separator" class="divider"></li>
                                                <li><a href="{{ route('buildingImage','q='.$building->id) }}"><i class="fa fa-fw  fa-file-image-o" title="View image"></i>View Image</a></li>
                                                <li role="separator" class="divider"></li>
                                                <li><a href="{{ route('buildingRoom.create','q='.$building->id) }}"><i class="fa fa-fw  fa-plus-square" title="Add building room"></i>Add Building Room</a></li>
                                                <li role="separator" class="divider"></li>
                                                <li><a href="{{ route('buildingRoom','q='.$building->id) }}"><i class="fa fa-fw  fa-eye" title="View building room"></i>View Building Room</a></li>
                                                
                                                <li role="separator" class="divider"></li>
                                                <li><a href="{{ route('buildingRent.create','q='.$building->id) }}"><i class="fa fa-fw  fa-plus-square" title="Add building rent"></i>Add Building Rent</a></li>
                                                <li role="separator" class="divider"></li>
                                                <li><a href="{{ route('buildingRent','q='.$building->id) }}"><i class="fa fa-fw  fa-eye" title="View building rent"></i>View Building Rent</a></li>
                                                
                                                <li role="separator" class="divider"></li>
                                                <li><a href="{{ route('buildingInclusion.create','q='.$building->id) }}"><i class="fa fa-fw  fa-plus-square" title="Add building Inclusion"></i>Add   Inclusion</a></li>
                                                <li role="separator" class="divider"></li>
                                                <li><a href="{{ route('buildingInclusion','q='.$building->id) }}"><i class="fa fa-fw  fa-eye" title="View building Inclusion"></i>View   Inclusion</a></li>
                                                
                                                <li role="separator" class="divider"></li>
                                                <li><a href="{{ route('buildingExclusion.create','q='.$building->id) }}"><i class="fa fa-fw  fa-plus-square" title="Add building Exclusion"></i>Add  Exclusion</a></li>
                                                <li role="separator" class="divider"></li>
                                                <li><a href="{{ route('buildingExclusion','q='.$building->id) }}"><i class="fa fa-fw  fa-eye" title="View building Exclusion"></i>View   Exclusion</a></li>
                                              
                                              </ul>
                                            </div>
                                          </td>
                                        </tr>
                                       @endforeach 
                                    </tbody></table>
                                  </div><!-- /.box-body -->
                                  <div class="pull-right">  
                                      {!! $buildings->appends(['search' =>isset($_GET['search'])?$_GET['search']:''])->render() !!}
                                  </div>  
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
      <style>
          .btn.btn-block.btn-primary {
  margin-bottom: 3px;
}
</style>
@stop
