@extends('layouts.master') @section('content') @include('include.header-menu')
<!--content start-->
<div class="content-box">
    <div class="container">
        <div id="link" style="position: absolute; z-index: 10; background: white; padding: 10px;
            display: none; width: 220px;">
        </div>
        <div class="row">
            <div class="product-table-box col-sm-6 col-sm-offset-3">
                <h3>{{Lang::get('website-lang.please_select_the_corresponding')}}</h3>
                <div class="row">
                    <div class="product-table-box clear col-xs-3 col-sm-offset-2">
                        <label>{{Lang::get('website-lang.sector')}}</label>
                    </div>
                    <div class="product-table-box clear col-xs-6">
                        <select id="selectSector" class="SlectBox" style="width: 200px;">
                            @foreach($sectorCity as $key => $City )
                                <option value="{{$City->SectorID}}">{{$City->Name}}</option>
                            @endforeach
                            <option value="0">Autre</option>
                        </select>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="product-table-box clear col-xs-3 col-sm-offset-2">
                        <label>{{Lang::get('website-lang.type_de_property')}}</label>
                    </div>
                    <div class="product-table-box clear col-xs-6">
                        <select id="selectType" class="SlectBox" style="width: 200px;">
                            <option value="1">{{Lang::get('website-lang.residentiel')}}</option>
                            <option value="2">{{Lang::get('website-lang.multi_familial')}}</option>
                            <option value="3">{{Lang::get('website-lang.commercial')}}</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="product-table-box center-box  clear col-xs-12">
                        <input type="button" name="cmdSelector" id="Button2" onclick="return cmdSelector_click(this);" class="submit-button btn" value="Choisir mes courtiers volontaires" path="{{url('courtiers') . '?buildingID=' . $buildingID}}" />
                    </div>
                </div>
 
                <div class="row">
                    <div class="product-table-box clear col-xs-12">
                        <label class="error-msg" id="SectorErrorMsg"></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!--content footer start-->
            <div class="col-xs-12 content-footer">
            </div>
            <!--content footer end-->
        </div>
        <script type="text/javascript">
            function cmdSelector_click(target) {
                var value = $("#selectSector").val();

                if (value == 0) {
                    $("#SectorErrorMsg").html("{{Lang::get('website-lang.we_are_sorry_no_dealer_in_your_area')}}");
                    return false;
                }

                $("#SectorErrorMsg").html("");

                var path = $(target).attr("path");

                window.location.href = path + "&SectorID=" + value + "&Type=" + $("#selectType").val();
            }
        </script>
    </div>
</div>
<!--content end-->
@stop