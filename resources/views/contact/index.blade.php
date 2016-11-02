@extends('layouts.master') @section('content') @include('include.search')
<!--content start-->
<div class="content-box">
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                @include('include.left-menu')
            </div>
            <div class="col-sm-10">
                <h1 class="page-title">{{ Lang::get('website-lang.to_find_answer')}} <a href="{{url('faq')}}">{{ Lang::get('website-lang.clic_here_faq')}}</a>.</h1>
                <div class="contant-box">
                    <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
                        <div class="panel panel-default">
                            <div id="headingOne" role="tab" class="panel-heading">
                                <h4 class="panel-title">
                                    <a aria-controls="Need" aria-expanded="true" href="#Need" data-parent="#accordion"
                                        data-toggle="collapse" role="button" class="">{{ Lang::get('website-lang.write_us')}}
                                        <span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span></a>
                                </h4>
                            </div> 
                            <div aria-labelledby="headingOne" role="tabpanel" class="panel-collapse collapse in"
                                id="Need" aria-expanded="true" style="">
                                <div class="panel-body">
                                      @if(Session::has('flash_alert_notice'))
                                        <div class="alert alert-success alert-dismissable">
                                          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                          <i class="icon fa fa-check"></i>  
                                           {{ Session::get('flash_alert_notice') }} 
                                        </div>
                                       @endif 
                                    {!! Form::open(array('route' => array('contact.store'),'id'=>'contact_us')) !!}
                                    <div class="row contact-field">
                                        <div class="form-group clear">
                                            <div class="col-sm-5">
                                                <label>
                                                {{ Lang::get('website-lang.phone')}}</label>
                                                {!! Form::text('Phone','', ['class' => 'form-control form-cascade-control','id'=>'phone'])  !!}
                                                <div id="phone_err1" style="color:red"></div>
                                            </div>
                                        </div>
                                        <div class="form-group clear">
                                            <div class="col-sm-5">
                                                <label>
                                                    {{ Lang::get('website-lang.email')}} *</label>
                                                {!! Form::text('email','', ['class' => 'form-control form-cascade-control','id'=>'email'])  !!}
                                                <div id="email_err1" style="color:red"></div>
                                            </div>
                                        </div>
                                        <div class="form-group clear">
                                            <div class="col-sm-10">
                                                <label>
                                                    {{ Lang::get('website-lang.your_message')}} <span class="">*</span></label>
                                                {!! Form::textarea('your_msg','',array('id'=>'your_msg','class'=>'form-control form-cascade-control')) !!}
                                                <div id="msg_err1" style="color:red"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <button class="submit-button" type="submit" style="width: 190px">
                                                {{ Lang::get('website-lang.submit')}}</button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div id="headingTwo" role="tab" class="panel-heading">
                                <h4 class="panel-title">
                                    <a aria-controls="departments" aria-expanded="false" href="#departments" data-parent="#accordion"
                                        data-toggle="collapse" role="button" class="collapsed">{{ Lang::get('website-lang.need_to_reach_out_to_us')}}<span><i
                                            class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span> </a>
                                </h4>
                            </div>
                            <div aria-labelledby="headingTwo" role="tabpanel" class="panel-collapse collapse"
                                id="departments" aria-expanded="false" style="height: 2px;">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-4 contact-detail-box">
                                            <h2 class="contact-detail-title">
                                                {{ Lang::get('website-lang.customer_service')}}</h2>
                                            <p>
                                                <strong>{{ Lang::get('website-lang.toll_free')}} :</strong> 1-844-321-CLIC
                                            </p>
                                            <p>
                                                <strong>{{ Lang::get('website-lang.email')}} :</strong> <a href="mailto:info@immo-clic.ca">info@immo-clic.ca</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--content end-->
@stop