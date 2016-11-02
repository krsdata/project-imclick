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
                <h1>{{Lang::get('website-lang.thank_you_for_choosing_your_broker') }}</h1>
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