<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        .txn table, th, td
        {
            border: 1px solid #0088c;
        }
        .txn table, th, td
        {
            width: 50%;
            padding: 5px;
        }
    </style>
</head>
<body>
    <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td width="197" align="right" valign="top">
                <img src="{{env('phase1')}}/plateforme/wp-content/uploads/logo-immo-clic.png" width="197"
                    height="61" style="display: block;">
            </td>
            <td align="left" valign="middle" bgcolor="" style="background-color: fff; padding: 20px;
                color: #ffffff;">
            </td>
        </tr>
    </table>
    <table width="600" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#971800"
        style="background-color: #971800;">
        <tr>
            <td align="center" valign="top" bgcolor="#ffffff" style="background-color: #A0A0A0;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="left" valign="top" bgcolor="#e7e0b7" style="background-color: #e7e0b7;
                            padding: 20px;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="10" style="margin-bottom: 10px;">
                                <tr>
                                </tr>
                            </table>
                            <table width="100%" border="0" cellspacing="0" cellpadding="10" style="margin-bottom: 10px;">
                                <tr>
                                    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #53231a;">
                                        <div style="font-size: 19px;">
                                        </div>
                                        <div>
                                            <p>Cher usager,</p>
                                            <p style="font-size: 21px; color: #0066ff">reçu de la transaction.</p>
                                            <div class="txn">
                                                <table border="1" style="border-collapse: collapse;" padding="5">
                                                    <tr>
                                                        <td>
                                                            Nom
                                                        </td>
                                                        <td>
                                                            {{ (isset($paypalResponse['userFullName']))?$paypalResponse['userFullName']:'none'}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Courriel
                                                        </td>
                                                        <td>
                                                            {{ (isset($paypalResponse['userFullName']))?$paypalResponse['email']:'none' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Forfait
                                                        </td>
                                                        <td>
                                                            {{ (isset($paypalResponse['PackageName']))?$paypalResponse['PackageName']:'none'}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Paiment no
                                                        </td>
                                                        <td>
                                                            {{ isset($paypalResponse['txn_id'])?$paypalResponse['txn_id']:'none' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Date de paiement
                                                        </td>
                                                        <td>
                                                            {{ isset($paypalResponse['payment_date'])?$paypalResponse['payment_date']:'none'}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Total
                                                        </td>
                                                        <td>
                                                            ${{ isset($paypalResponse['total_amt'])?$paypalResponse['total_amt']:'none'}}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <p>
                                                <b>Merci</b></p>
                                            <p>
                                            </p>
                                            <p>
                                                Immo-clic.ca © 2016. Tous droits réservés.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%" border="0" cellspacing="0" cellpadding="10" style="margin-bottom: 10px;">
                                <tr>
                                    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000000;">
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
