@extends('packages::layouts.master')

@section('title', 'Dashboard')

@section('header')
    <h1>Dashboard</h1>
@stop

@section('content') 

      @include('packages::partials.main-header')
      <!-- Left side column. contains the logo and sidebar -->
      @include('packages::partials.main-sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Advertisement
            <small>Create</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="#">Advertisement</a></li>
            <li class="active">create</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
          <div class="col-md-12">
             <div class="col-md-12">
        <div class="panel panel-cascade">
          <div class="panel-body ">
            <div class="row">
              <div class="col-md-9">
                {!! Form::open(array('url' => 'admin/advertisement/store', 'class' => 'form-horizontal cascade-forms', 
                'id' => 'advertisement_form', 'files' => true)) !!} 
                  <div class="form-group">
                    <label class="col-lg-3 col-md-3 control-label"> Name </label>
                    <div class="col-lg-9 col-md-9">                                          
                      
                      {!! Form::text('advertisement_name', '', array('class' => 'form-control form-cascade-control input-small'))  !!}
                                            
                    </div>
                  </div>
                  <div class="form-group">
                    <label  class="col-lg-3 col-md-3 control-label">Type</label>
                    <div class="col-lg-9 col-md-9">
                     
                      <?php
                        $adtype_array = ['' => 'select ad type','small button banner' => 'small button banner','skyscraper' => 'skyscraper'];
                      ?>
                      {!!Form::select('advertisement_type', $adtype_array, null, ['class' => 'form-control form-cascade-control input-small']) !!}
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 col-md-3 control-label">Script</label>
                    <div class="col-lg-9 col-md-9"> 
                      {!! Form::textarea('advertisement_script', '', array('class' => 'form-control form-cascade-control input-small'))  !!}
                     </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 col-md-3 control-label">Image</label>
                    <div class="col-lg-9 col-md-9"> 
                      {!! Form::file('image', array('class' => 'btn btn-primary'))  !!} 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 col-md-3 control-label">URL to redirect</label>
                    <div class="col-lg-9 col-md-9"> 
                      {!! Form::text('advertisement_url', '', array('class' => 'form-control form-cascade-control input-small'))  !!}
                     </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail1" class="col-lg-3 col-md-3 control-label">Country</label>
                    <div class="col-lg-9 col-md-9">
                      <select class="form-control select2" name="country_id">
                         <option value="">Select Country</option> 
                        @foreach ($countries as $key => $country) 
                        
                        <option value="{{$key}}">{{$country}}</option> 
                        @endforeach
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-lg-3 col-md-3 control-label">Set expiration date</label>
                    <div class="col-lg-9 col-md-9">
                       <input  type="text" name="expiration_date" placeholder="click to show datepicker" class="form-control form-cascade-control input-small" id="example1" autocomplete="off">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="col-lg-3 col-md-3 control-label"></label>
                    <div class="col-lg-9 col-md-9">
                      <input type="submit" value="Create" class="btn bg-primary text-white btn col-lg-3">
                     </div>
                  </div>
                  
                  
                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
              </div>            
          </div>
           
          </div><!-- /.row -->
          <!-- Main row --> 
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/select2/select2.min.css') }}">
   
@stop
