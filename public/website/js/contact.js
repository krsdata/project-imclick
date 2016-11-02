$(document).ready(function(){
    $("#contact_us").submit(function(e){  
        var phone=$('#phone').val();
        var email=$('#email').val(); 
        var your_msg=$('#your_msg').val();
        !phone ? $('#phone_err1').html('Veuillez entrer votre num&eacute;ro de t&eacute;l&eacute;phone') : '';                     
        !your_msg?$('#msg_err1').html('Veuillez entrer un message'):$('#msg_err1').html('');
            if($.isNumeric(phone)) {
                $('#phone_err1').html('');
                var phone_val=0;
            }
            else
                {
                    $('#phone_err1').html('Veuillez entrer un num&eacute;ro de t&eacute;l&eacute;phone valide');
                    var phone_val=1;
                } 

            if( !validateEmail(email) || !email) {
                $('#email_err1').html('Veuillez entrer une adresse &eacute;lectronique valide.');
                var email_val=1;
            }
            else
            {
                $('#email_err1').html('');
                var email_val=0;
            }
        if(phone_val || email_val || !your_msg)
        {
            return false;
        }
        else
        {

        var token = $('#contact_us > input[name="_token"]').val();                    
              $.ajax({
                url: url+"/contact",
                type: "POST",
                data: {'_token':token,'phone':phone,'email':email,'Message':your_msg} ,
                success: function (response) {

                    console.log(response);

                },
                error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
                }
            });  
        }     
    });
});
 function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}