@extends('layouts.master') @section('content') @include('include.header-menu')
<!--content start-->
<div class="content-box">
    <div class="container">
        <div id="link" style="position: absolute; z-index: 10; background: white; padding: 10px;
            display: none; width: 220px;">
        </div>
        <div class="row">
            <div class="product-table-box clear col-xs-12">
                @if(count($courtiers) == 0)
                    <h3>{{Lang::get('website-lang.No_broker_accept_your_request_at_this_time') }}</h3>
                    <h4>Les courtiers volontaires participants que vous avez sélectionnés vous contacteront bientôt. Merci! Si vous avez des questions, appelez nous au 1-844-321-CLIC(2542).</h4>
                @else
                    <h1>Choisir mon {{Helper::GetBrokerOrSpecialisteName($transaction[0]->Transaction_Type)}}</h1>
                    @foreach ($courtiers as $key => $result)
            	    {!! Form::open(array('url' => URL::to($lang.'/courtier-choisi'),'method'=>'post','id'=>'ChooseMyBroker'))!!}  
                    <div class="Choose-broker">
                        <h3>{{utf8_decode($result['FirstName'] . ' ' . $result['LastName'])}}</h3>
                        <h4>{{$result['Name']}}</h4>
                        <img src="{{env('phase1')}}/admin/Style/Image/Courtier/{{$result['Picture']}}" />
                        <input type="hidden" name="CourtierID" value="{{$result['UserID']}}" />
                        <input type="hidden" name="TransactionID" value="{{$transactionID}}" />
                        {!! Form::submit("Choisir ce " . Helper::GetBrokerOrSpecialisteName($transaction[0]->Transaction_Type), ['class' => 'submit-button btn','id'=>'chooseMyBroker']) !!} 
                    </div>
                    {!! Form::close() !!}
                    @endforeach
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