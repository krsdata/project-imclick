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
                                    <form action="{{route('transaction')}}" method="get">    
                                    
                                    <div class="col-md-3  ">
                                        <input value="{{ (isset($_REQUEST['search']))?$_REQUEST['search']:''}}" placeholder="Search by Name/Email" type="text" name="search" id="search" class="form-control" >
                                        <span class="input-group-btn">
                                           
                                        </span>
                                    </div>

                                    <!-- <div class="col-md-3  ">
                                        <input value="{{ (isset($_REQUEST['date']))?$_REQUEST['date']:''}}" placeholder="Transaction date" type="text" readonly="readonly" name="date" id="date" class="form-control" >
                                        
                                    </div> -->

                                    <div class="col-md-3  ">
                                          <select name="buyOrsold" id="buyOrsold" class="form-control">
                                          <option value="0">Buy</option>
                                          <option value="1">Sold</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                       
                                        <button type="submit" class="btn btn-danger alert-danger form-control"><span class="glyphicon glyphicon-search"></span>   Search </button>
                                          
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
                
                <div class="box-body table-responsive no-padding "  >
                  <table class="table table-hover">
                    <tbody>
                      <tr>
                        <th>  ID            </th>
                        <th>  Email         </th>
                        <th>  Transaction_Type      </th>
                        <th>  Transaction_Date    </th>
                        <th>  BuyOrSold     </th> 
                        <th>  Status  </th>
                        <th>  Action        </th>
                      </tr>
                      @if(count($results)==0) <tr><td><b style="color:red"> Record not found</b> </td></tr> @endif
                      @foreach ($results as $key => $result)  
                      <tr>
                        <td>  {{ $result->ID }}         </td>
                        <td>  {{ isset($result->user['email'])?$result->user['email']:'Unknow' }}      </td> 
                        <td>  {{ $result->Transaction_Type }}  </td>
                        <td>  {{ $result->Transaction_Date }}  </td> 
                        <td>  {{ (isset($result->BuyOrSold) && $result->BuyOrSold==1)?'Sold':'Buy' }}  </td> 
                        <td>  {{ $result->Status }} </td>
                        
                         
                        <td> 
                         <a href="{{ route('transaction.edit',$result->ID) }}">
                            <i class="fa fa-fw fa-pencil-square-o" title="edit"></i>
                        </a>   
                             {!! Form::open(array('class' => 'form-inline pull-left deletion-form', 'method' => 'DELETE',  'id'=>'deleteForm_'.$result->id, 'route' => array('transaction.destroy', $result->ID))) !!}
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
                           <div class="" align="center">  {!! $results->appends(['search' => isset($_GET['search'])?$_GET['search']:''])->render() !!}</div>
                                
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
