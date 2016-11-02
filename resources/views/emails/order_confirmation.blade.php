<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Preview template</title>
</head>
{{HTML::style('public/assets/front-end/css/bootstrap.css')}}
<body>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="197" align="right" valign="top"><img src="https://www.wiaipi.com/public/assets/front-end/images/logo.png" width="197" height="61" style="display:block;"></td>
    <td align="left" valign="middle" bgcolor="" style="background-color:#A0A0A0 ; padding:20px; color:#ffffff;">
    <div style="font-size:24px;">WIAIPI</div>

    </td>
    
  </tr>
</table>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#971800" style="background-color:#971800;">
  <tr>
    <td align="center" valign="top" bgcolor="#ffffff" style="background-color:#A0A0A0 ;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
    
      <tr>
        <td align="left" valign="top" bgcolor="#e7e0b7" style="background-color:#e7e0b7; padding:20px;"><table width="100%" border="0" cellspacing="0" cellpadding="10" style="margin-bottom:10px;">
          <tr>
            
          </tr>
        </table>

          <table width="100%" border="0" cellspacing="0" cellpadding="10" style="margin-bottom:10px;">
            <tr>
              <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#53231a;"><div style="font-size:19px;">
                <div style="font-weight: bold;">
                  <table class='table users-table table-condensed table-hover'>
                    
                    <tr>
                      <td>Order Reference</td>
                      <td>{{$content['order_reference']}}</td>
                    </tr>
                    <tr>
                      <td>Package booked</td>
                      <td>
                      {{$content['package_title']}} - {{$content['people_allowed']}} peoples
                        <div class="clearfix"></div>
                        <ul>
                          {{--*/ $counter = 0 /*--}}
                          @foreach($content['category_title'] as $drinks)
                            <li>{{$content['category_qty'][$counter]}} x {{$drinks}}</li>
                            <div class="clearfix"></div>
                            {{--*/ $counter++ /*--}}
                          @endforeach                          
                        </ul>
                      </td>
                    </tr>
                    <tr>
                      <td>Club</td>
                      <td>{{$content['club_name']}}</td>
                    </tr>
                    <tr>
                      <td>Amount paid</td>
                      <td>&euro; {{$content['final_amount']}}</td>
                    </tr>
                    <tr>
                      <td>Booking date</td>
                      <td>{{$content['booking_date']}}</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td>
                        <a href="{{URL::to('cancelOrder?cancellation_token='.$content['cancellation_token'])}}">
                          <button type="button" class="btn btn-danger">Cancel this booking</button>
                        </a>
                      </td>
                    </tr>
                  </table>
                </div>
              </td>
            </tr>
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="10" style="margin-bottom:10px;">
            <tr>
              <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;"><div><br>
               
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
</table>
{{HTML::script('public/assets/front-end/js/bootstrap.js')}}
</body>
</html>
