@extends('layouts.master') 
@section('content') 
@include('include.header-menu')

<!--content start-->
<div class="content-box">
    <div class="container">
    	<div class="tab-content">
            <div id="link" style="position: absolute; z-index: 10; background: white; padding: 10px;
                display: none; width: 220px;">
            </div>
            <div class="row">
                <div class="product-table-box col-xs-12">
                    <h3>RÉPERTOIRE DE COURTIERS IMMOBILIERS VOLONTAIRES PARTICIPANTS</h3>
                </div>
                <div class="product-table-box col-xs-12">
                    <h4>Choisissez de 1 à 3 courtiers volontaires dans le répertoire ci-dessous, remplissez le formulaire plus bas et soumettez votre demande pour que vos courtiers immobiliers vous contactent rapidement!</h4>
                </div>
            </div>
            <div class="row">
                <!--content footer start-->
                <div class="product-table-box col-xs-12">
                    @foreach ($courtiers as $key => $result)
                    <div class="Select-broker" onclick="return CheckBroker($(this));" userID="{{$result['UserID']}}">
                        <img src="{{env('phase1')}}/admin/Style/Image/Courtier/{{$result['Picture']}}" />
                        <div class="broker-box-name">
                            <span>{{utf8_decode($result['FirstName'] . ' ' . $result['LastName'])}}</span>
                            <br />
                            <span>{{$result['Name']}}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!--content footer end-->
            </div>
            <div class="row">
                <div class="col-xs-12 content-footer">
                    {!! Form::open(array('url' => URL::to($lang.'/createtransaction'),'method'=>'post','id'=>'CreateTransactionForm'))!!}               
                    <div class="main-field-box">
                        <div class="field-box">
                          {!! Form::label(Lang::get('website-lang.phone')) !!}
                          {!! Form::text('phone_number', $user->Phone ,['class'=>'field-input',  'id'=>'phone_number', 'placeholder'=>'']) !!}
                        </div>
                        <div class="field-box">
                          {!! Form::label(Lang::get('website-lang.Cell')) !!}
                          {!! Form::text('cell_number', $user->Cell,['class'=>'field-input',  'id'=>'cell_number', 'placeholder'=>'']) !!}
                        </div>
                        <div class="field-box">
                          {!! Form::label(Lang::get('website-lang.residence_number')) !!}
                          {!! Form::text('residence_number', null,['class'=>'field-input',  'id'=>'residence_number', 'placeholder'=>'']) !!}
                        </div>
                        <div class="field-box">
                          {!! Form::label(Lang::get('website-lang.app_number')) !!}
                          {!! Form::text('app_number', null,['class'=>'field-input', 'id'=>'app_number', 'placeholder'=>'']) !!}
                        </div>
                        <div class="field-box">
                          {!! Form::label(Lang::get('website-lang.street_name')) !!}
                          {!! Form::text('street_name', null,['class'=>'field-input', 'id'=>'street_name', 'placeholder'=>'']) !!}
                        </div>
                        <div class="field-box">
                          {!! Form::label(Lang::get('website-lang.street_type')) !!}
                          {!! Form::select('street_type', array('1' => Lang::get('website-lang.street'), '2' => Lang::get('website-lang.boulevard'), '3' => Lang::get('website-lang.avenue'), '4' => Lang::get('website-lang.rang'), '5' => Lang::get('website-lang.road'), '6' => Lang::get('website-lang.trail')), ['class'=>'field-input' ])!!}
                        </div>
                        <div class="field-box">
                          {!! Form::label(Lang::get('website-lang.postal_code')) !!}
                          {!! Form::text('postal_code', null,['class'=>'field-input', 'id'=>'postal_code', 'placeholder'=>'']) !!}
                        </div>
                        <div class="field-box">
                          {!! Form::label(Lang::get('website-lang.city')) !!}
                          {!! Form::text('city', null,['class'=>'field-input', 'id'=>'city', 'placeholder'=>'']) !!}
                        </div>
                        <div class="field-box">
                          {!! Form::submit(Lang::get('website-lang.Submit'), ['class' => 'login-button','id'=>'registerBtn']) !!} 
                        </div>
                        <div id="regError" style="color:Red;"></div>
                        <input id="type" name="type" type="hidden" value="{{$type}}" />
                        <input id="sectorID" name="sectorID" type="hidden" value="{{$sectorID}}" />
                        <input id="buildingID" name="buildingID" type="hidden" value="{{$buildingID}}" />
                        <input id="brokersIds" name="brokersIds" type="hidden" value="" />
                    </div>
                    {!! Form::close() !!}
    
                    <script>
                        $(document).ready(function () {
                            $("#registerBtn").click(function () {
                                var validate = true;
                                $("#regError").html("");
    
                                if ($("#phone_number").val() == "") {
                                    validate = false;
                                    $("#regError").append("{{Lang::get('website-lang.obligatory_phone')}}" + "</br>");
                                }
    
                                if ($("#residence_number").val() == "") {
                                    validate = false;
                                    $("#regError").append("{{Lang::get('website-lang.obligatory_residence_number')}}" + "</br>");
                                }
    
                                if ($("#street_name").val() == "") {
                                    validate = false;
                                    $("#regError").append("{{Lang::get('website-lang.obligatory_street_name')}}" + "</br>");
                                }
    
                                if ($("#postal_code").val() == "") {
                                    validate = false;
                                    $("#regError").append("{{Lang::get('website-lang.obligatory_postal_Code')}}" + "</br>");
                                }
    
                                if ($("#city").val() == "") {
                                    validate = false;
                                    $("#regError").append("{{Lang::get('website-lang.obligatory_city')}}" + "</br>");
                                }
    
                                if ($(".Selected-broker").length == 0) {
                                    validate = false;
                                    $("#regError").append("{{Lang::get('website-lang.obligatory_broker')}}" + "</br>");
                                }
    
                                return validate;
                            });
                        })
                    </script>
                </div>
            </div>
    	</div>    
    </div>
</div>
<!--content end-->
@stop