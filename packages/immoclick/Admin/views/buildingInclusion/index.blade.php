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
                   <!--  <form action="{{route('building')}}" method="get">    
                    <div class="col-md-3">
                        <input value="{{ (isset($_REQUEST['search']))?$_REQUEST['search']:''}}" placeholder="search by Name/Email" type="text" name="search" id="search" class="form-control" >
                    </div>
                    <div class="col-md-2">
                        <input type="submit" value="Search" class="btn btn-primary form-control">
                    </div>
                </form>  -->
                    
                </div><!-- /.box-header -->
                
                  
                @if(Session::has('flash_alert_notice'))
                  <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <i class="icon fa fa-check"></i>  
                     {{ Session::get('flash_alert_notice') }} 
                  </div>
                 @endif 
                
                <div class="box-body table-responsive no-padding " style="overflow:inherit">
                  <table class="table table-hover">
                    <tbody><tr>
                      <th>ID</th>
                      <th>Exclusion</th>
                     
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                   
                    @if(count($buildingInclusion)==0)
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
                     @foreach ($buildingInclusion as $key => $building)  
                      <tr>
                        <td>  {{ $building->id }}</td>
                        <td>  {{ $building->Inclusion }} </td> 
                         <td> {{ $building->updated_at }} </td>
                        <td> 
                         <a href="{{ route('buildingInclusion.edit',$building->id) }}?q={{ $building->BuildingID  }}">
                            <i class="fa fa-fw fa-pencil-square-o" title="edit"></i>
                        </a>   
                             {!! Form::open(array('class' => 'form-inline pull-left deletion-form', 'method' => 'DELETE',  'id'=>'deleteForm_'.$building->id, 'route' => array('buildingInclusion.destroy', $building->id))) !!}
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
      <style>
          .btn.btn-block.btn-primary {
  margin-bottom: 3px;
}
</style>
@stop
