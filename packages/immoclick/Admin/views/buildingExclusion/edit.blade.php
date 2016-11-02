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
                       <div class="panel panel-cascade">
                          <div class="panel-body ">
                              <div class="row"> 
                                {!! Form::model($buildingExclusion, ['method' => 'PATCH', 'route' => ['buildingExclusion.update', $buildingExclusion->id],'class'=>'form-horizontal','files' => true,'id'=>'building_exc']) !!}
                                    @include('packages::buildingExclusion.form', compact('buildingExclusion'))
                                {!! Form::close() !!}
                              </div>
                          </div>
                    </div>
                </div>            
              </div>  
            <!-- Main row --> 
          </section><!-- /.content -->
      </div> 
@stop



