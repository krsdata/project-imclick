@extends('layouts.master') @section('content') @include('include.header-menu')
<!--content start-->
<div class="content-box">
    <div class="container">
        <div id="link" style="position: absolute; z-index: 10; background: white; padding: 10px;
            display: none; width: 220px;">
        </div>
        <div class="row">
            <div class="col-sm-2">
                @include('include.left-menu')
            </div>
            <div class="product-table-box clear col-xs-10">
                @if(isset($courtier))
                    <div class="row">
                        <div class="product-table-box clear col-xs-6 col-sm-offset-3">
                            <div class="My-broker selected">
                                <img src="{{env('phase1')}}/admin/Style/Image/Courtier/{{$courtier['Picture']}}" />
                                <span>{{utf8_decode($courtier['FirstName'] . ' ' . $courtier['LastName'])}}</span>
                                <span>{{Lang::get('website-lang.email'). ' : ' . $courtier['email']}}</span>
                                <span>{{Lang::get('website-lang.phone'). ' : ' . $courtier['Phone']}}</span>
                                <span>{{Lang::get('website-lang.Cell'). ' : ' . $courtier['Cell']}}</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <!--content footer start-->
            <div class="col-xs-12 content-footer">
            </div>
            <!--content footer end-->
        </div>
    </div>
</div>
<!--content end-->
@stop