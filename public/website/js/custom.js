var lang = getCookie("language");

function AccesDeniedForMapTab(event) {
    alert("Vous devez remplir l'onglet de localisation avant.");
    event.stopPropagation();
    return false;
}

function ShowCommercantsByCategory(catId, cityId, language) {
    $.ajax({
        url: url + '/' + '/immobilier/plateforme/wp-content/themes/boldial/SolutionCode/Ajax/Common.php',
        type: "POST",
        dataType: "html",
        data: { functionName: "GetAllCommercantsForThisCategory", CatID: catId, CityID: cityId, Language: language }
    }).done(function (result) {
        if (result != null) {
            result = $.parseJSON(result);
            if (!result.Error) {
                $(".comms-box").html(result.Data);
                $(".comms-box").css("display", "");
            }
            else {
                alert(result.ErrorMsg);
            }
        }
    });
}

function closepopup() {
    $(".comms-box").css("display", "none");
}

function LoadMap() {

    var adresse = $("#street_number").val() + " " + $("#street_name").val() + " " + $("#option_ville option:selected").text();
    $("#user_location").val(adresse);

    var lat = $('.register-form__latitude-holder').val();
    var long = $('.register-form__longitude-holder').val();
    initMap(lat, long);
    $(".location_button").click();
}
function initMap(lat, long) {
    var contentString = "<p>Latitude: " + lat + "</p>" + "<p>Longitude: " + long + "</p>";
    var infowindow = new google.maps.InfoWindow({
        content: contentString,
        maxWidth: 200
    });
    var center = new google.maps.LatLng(parseFloat(lat), long);
    var mapOptions = { center: center, zoom: 16, scrollwheel: false };
    map = new google.maps.Map(document.getElementById("register-form__map"), mapOptions);
    marker = new google.maps.Marker({ position: new google.maps.LatLng(lat, long), draggable: true, map: map, title: 'Immoclick' });
    google.maps.event.addListener(marker, 'dragend', function (event) {
        var lat = this.getPosition().lat();
        var long = this.getPosition().lng();
        infowindow.open(map, marker);
        initMap(lat, long);

        $('.register-form__latitude-holder').val(lat);
        $('.register-form__longitude-holder').val(long);
    });
    infowindow.open(map, marker);
    marker.addListener('click', function () {
        infowindow.open(map, marker);
    });
}

function CheckBroker(target) {
    if (target.hasClass("Select-broker")) {
        if ($(".Selected-broker").length < 3) {
            target.removeClass("Select-broker");
            target.addClass("Selected-broker");
            $("#brokersIds").val(GetUserIDsForSelectedBrokers());

        }
    } else {
        target.removeClass("Selected-broker");
        target.addClass("Select-broker");
        $("#brokersIds").val(GetUserIDsForSelectedBrokers());
    }
}

function Checkimage(target, max) {
    if (target.hasClass("select_img_elements")) {
        if ($(".selected_img_elements").length < max) {
            target.removeClass("select_img_elements");
            target.addClass("selected_img_elements");
            $("#brokersIds").val(GetUserIDsForSelectedBrokers());

        }
        else {
            alert("Nombre maximum de photos atteinte! (" + max + ")")
        }
    } else {
        target.removeClass("selected_img_elements");
        target.addClass("select_img_elements");
        $("#brokersIds").val(GetUserIDsForSelectedBrokers());
    }
    $("#SpanImgCount").html($(".selected_img_elements").length);
}

function GetUserIDsForSelectedBrokers(){
    var value = "";
    var selectedbrokers = $(".Selected-broker");

    for (var i = 0; i < selectedbrokers.length; i++) {
        value += $(selectedbrokers[i]).attr("userid") + ",";
    }

    return value.slice(0, -1);
}

function truncateText(string, length) { 
    if(string.length > length){
        return string.substring(0, length) + '...';
    }
    return string;
}

function collapseCitysFromRegion(target, Region_Name) {
    target.parent().find("a").parent().css("display", "none");
    $(".area-city").attr("collapse", "false");
    if (target.attr("collapse") == "false") {
        $("a[region-name='" + Region_Name + "']").parent().css("display", "");
        target.attr("collapse", "true");
    }
    else {
        $("a[region-name='" + Region_Name + "']").parent().css("display", "none");
        target.attr("collapse", "false");
    }
}

$(function () {
    $.ajax({
        type: "GET",
        url: url + '/' + 'getSectors',
        dataType: 'json',
        success: function (response) {
            if (response != 0) {
                var json_obj = response; //JSON.parse(response);//parse JSON 
                var container = $(".sector-list");
                var regionName = "";
                for (var j = 0; j < container.length; j++) {
                    var liClass = $(container[j]).attr("li-class");
                    var IncludePartenaire = $(container[j]).attr("IncludePartenaire");

                    for (var i = 0; i < json_obj.length; i++) {

                        if (IncludePartenaire == "false" && json_obj[i].PartenaireOnly == 1) {
                            continue;
                        }

                        if (regionName != json_obj[i].Region_Name) {
                            regionName = json_obj[i].Region_Name;
                            $(container[j]).append("<li class='area-city' style='cursor:pointer' collapse='false' onclick='collapseCitysFromRegion($(this),\"" + json_obj[i].Region_Name + "\"); return event.stopPropagation();'><strong>" + regionName + "</strong></li>");
                        }

                        $(container[j]).append("<li style='display:none;' style='cursor:pointer'><a class='" + liClass + "' region-name='" + json_obj[i].Region_Name + "' value='" + json_obj[i].SectorID + "'>" + json_obj[i].Name + "</a></li>");
                    }

                    $(container[j]).append("<li class='area-city' style='cursor:pointer' collapse='false' onclick='collapseCitysFromRegion($(this),\"Autre\"); return event.stopPropagation();'><strong>Autre</strong></li>");
                    $(container[j]).append("<li style='display:none;' style='cursor:pointer'><a class='" + liClass + "' region-name='Autre' value='0'>Autre</a></li>");
                }
            }

            $(".select-this-sector").on("click", function () {
                var value = $(this).attr("value");
                var text = $(this).html();
                $('#choose_area').val(value);
                $('#sectorName').val(text);
                $('#loginBtn').click();
            });

            $(".select-this-sector-package").on("click", function () {
                var value = $(this).attr("value");
                var text = truncateText($(this).html(), 12);
                $('#PackageSector').val(value);
                $('#SelectedSectorNamePackage').html(text);
            });
        }
    });

    var sectorID = getCookie("SectorID");

    if (sectorID == "") {
        $("#area-sector").css("display", "inline");
    }

    $(".select-this-sector").on("click", function () {
        var value = $(this).attr("value");
        var text = $(this).html();
        $('#choose_area').val(value);
        $('#sectorName').val(text);
        $('#loginBtn').click();
    });

    $(".select-this-sector-package").on("click", function () {
        var value = $(this).attr("value");
        var text = truncateText($(this).html(), 12);
        $('#PackageSector').val(value);
        $('#SelectedSectorNamePackage').html(text);
    });

    $(".img400").mouseover(function () {
        if (!detectmob()) {
            $(".right-arrow").css("display", "");
            $(".left-arrow").css("display", "");
            $(".scale-ico").css("display", "");
        }
    });

    $(".img400").mouseout(function () {
        if (!detectmob()) {
            $(".right-arrow").css("display", "none");
            $(".left-arrow").css("display", "none");
            $(".scale-ico").css("display", "none");
        }
    });

    $(".left-arrow").click(function () {
        var index = parseInt($(this).attr("index"));
        var max = parseInt($(this).attr("max-index"));

        if (index > 0) {
            index = index - 1;
            $(".img_elements[index=" + index + "]").click();
            var img = $(".img_elements[index=" + index + "]").attr("src");
            $(".eagle-view-medium-img").find("img").attr("src", img);
        } else {
            index = max;
            $(".img_elements[index=" + index + "]").click();
            var img = $(".img_elements[index=" + index + "]").attr("src");
            $(".eagle-view-medium-img").find("img").attr("src", img);
        }
    });

    $(".right-arrow").click(function () {
        var index = parseInt($(this).attr("index"));
        var max = parseInt($(this).attr("max-index"));

        if (index < max) {
            index = index + 1;
            $(".img_elements[index=" + index + "]").click();
            var img = $(".img_elements[index=" + index + "]").attr("src");
            $(".eagle-view-medium-img").find("img").attr("src", img);
        } else {
            index = 0;
            $(".img_elements[index=" + index + "]").click();
            var img = $(".img_elements[index=" + index + "]").attr("src");
            $(".eagle-view-medium-img").find("img").attr("src", img);
        }
    });

    $(".img_elements").click(function () {
        var index = parseInt($(this).attr("index"));
        $(".left-arrow").attr("index", index);
        $(".right-arrow").attr("index", index);
    });

    $(".citys-search").find(".MultiControls").css("display", "");


    $(".region-search").find(".MultiControls").find(".btnOk").css("display", "none");
    $(".region-search").find(".MultiControls").find(".btnCancel").css("width", "100%");
    $(".region-search").find(".MultiControls").css("display", "");

    if (detectmob()) {
        $(".right-arrow").css("display", "");
        $(".left-arrow").css("display", "");
    }

    if ($(".pagination").length > 0) {
        var hrefs = $(".pagination").find("a");
        var params = getParamsUrl();
        var currentpage = $($($(".pagination").find(".active")).children()).html();
        params = params.replace("&page=" + currentpage, "");
        for (var i = 0; i < hrefs.length; i++) {
            var a = $(hrefs[i]);
            var value = a.attr("href") + params;
            a.attr("href", value);
        }
    }

    if ($("#sortable").length > 0) {
        $("#sortable").sortable();
        $("#sortable").disableSelection();
    }

    $(".room-desc").css("display", "");

    $(".img_elements").click(function () {
        $(".room-desc").html($(this).attr("data-title"));
    });

    $(".search-box").css("display", "");

    $('.pay_by_paypal').click(function () {
        // $('.paymentMsg').html('<div class="alert alert-danger"><h4>Please do not refresh the page while payment is being processed..</h4></div>').css('padding', '100px');
        /* $.blockUI({
        message: '<div class="loader"><div class="main-loader ball-clip-rotate-multiple"><div class="inner-loader"><div></div><div></div></div></div></div>'
        }); */
    });

    $('#login_model').click(function () {
        $('#loginModal').removeClass('hide').modal();
        $('#loginModal').modal('show');
    });

    $('#login-model').click(function () {
        $('#loginModal').modal('hide');
        $('#lost-pwd-modal').modal('show');
        $('#lost-pwd-modal').show();
        return false;
    });

    $("#cmdSearchStreetName").click(function () {
        var value = $("#txtSearchStreetName").val();

        if (value == "") {
            $("#hiddenStreetName").val("Empty");
        }

        $("#txtStreetName").val(value);
        $(".search-button").click();
    });

    $("#txtSearchStreetName").keyup(function (event) {
        if (event.keyCode == 13) {
            $("#cmdSearchStreetName").click();
        }
    });

    $("#choose_area").change(function () {
        var value = $("#choose_area option:selected").text();
        $("#sectorName").val(value);
    });

    $('#mapView').click(function () {
        initialize();
    });
    $("#range-slider").slider({});

    $("#ddlOrderSearchResult").change(function () {
        var value = $("#ddlOrderSearchResult").val();
        $("#ddlOrderSearch").val(value);
        $(".search-button").click();
    });

    $('#region').change(function () {
        var length = $('#city_region').children('option').length;
        for (var i = 1; i <= length; i++) {
            $('#city_region')[0].sumo.remove(0);
        }

        var region = [];
        $('#region :selected').each(function (i, selected) {
            region[i] = $(this).val();
        });
        $.ajax({
            type: "GET",
            data: { region: region },
            url: url + '/' + 'getVille',
            // beforeSend: function () {
            //     //   $('.status').html('Processing...');
            // },
            dataType: 'json',
            success: function (response) {

                if (response != 0) {
                    var json_obj = response; //JSON.parse(response);//parse JSON 

                    for (var i = 0; i < json_obj.length; i++) {
                        $('#city_region')[0].sumo.add(json_obj[i].id, json_obj[i].CityName);
                    }

                    /*var count = 0;
                    Object.keys(json_obj.region).forEach(function (key) {
                    //console.log(key);
                    var tt = 'city_' + key;
                    //console.log(json_obj[tt]);
                    //$('#city_region')[0].sumo.add('region_' + key, json_obj.region[key]);

                    console.log(json_obj[tt][count]);
                    Object.keys(json_obj[tt]).forEach(function (key, value) {
                    //console.log(json_obj[tt][2]);
                    // console.log(key);
                    Object.keys(json_obj[tt][key]).forEach(function (key1, value) {
                    $('#city_region')[0].sumo.add(key1, json_obj[tt][key][key1]);
                    });
                    //console.log(count);
                    //console.log(json_obj[tt][count]);
                    //$('#city_region')[0].sumo.add(value, json_obj[tt][count][key]);


                    });
                    // count++;
                    // console.log(count);

                    });*/
                }
                else {
                    $('#city_region')[0].sumo.reload();
                    $(".citys-search").find(".MultiControls").css("display", "");
                }
            }
        });
    });

});



function validateSector() { 
    sectorID = $("#PackageSector").val();
    if (sectorID == 0) {
        $("#sectorNotDispo").css("display", "");
        return false;
    }
}

function CancelSectorChoose() {
    $("#choose_area").val("0");
    $("#sectorName").val("Aucun");
    $("#loginBtn").click();
}

function detectmob() {
    if (navigator.userAgent.match(/Android/i)
 || navigator.userAgent.match(/webOS/i)
 || navigator.userAgent.match(/iPhone/i)
 || navigator.userAgent.match(/iPad/i)
 || navigator.userAgent.match(/iPod/i)
 || navigator.userAgent.match(/BlackBerry/i)
 || navigator.userAgent.match(/Windows Phone/i)
 ) {
        return true;
    }
    else {
        return false;
    }
}

function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
}

function getParamsUrl() {
    var result = window.location.href.split("?");
    
    if(result.length > 0)
    {
        return "&" + result[1];
    } 
}


/****View Map****/
function mapView()
{
    $('#mapView').addClass('active');

    $('#costs').removeClass('active');
    $('#detail_view').removeClass('active');
    $('#buy').removeClass('active');

    $('#detail_view').removeClass('active');
    $('#map').addClass('active');
    $('#carte').addClass('active');
    $('#list').removeClass('active');

    $('#description').removeClass('active');
    $('#couts').removeClass('active');
    $('#acheter').removeClass('active');
    initialize();
}

function costView()
{

    $('#costs').addClass('active');
    $('#detail_view').removeClass('active');
    $('#buy').removeClass('active');
    $('#mapView').removeClass('mapView');

    $('#couts').addClass('active');
    $('#description').removeClass('active');
    $('#carte').removeClass('active');
    $('#acheter').removeClass('active');

}


$(document).ready(function() { 
    
    var c = 1;
    var loan_amount = 1;
    var interest = 1;
    $("#downpayment, #loan_amount, #interest, #downpayment2, #loan_amount2, #interest2, #no_of_year, #credit_card, #cvv").keydown(function (event) {
        // Allow only backspace and delete
        /*if ( event.keyCode == 46 || event.keyCode == 8 ||  event.keyCode == 190 ) {
         // let it happen, don't do anything
         }*/
        if (event.keyCode >= 96 && event.keyCode <= 110 || event.keyCode == 8 || event.keyCode == 190 || event.keyCode == 9 || event.keyCode == 46) {
            // let it happen, don't do anything

            if (event.keyCode == 110)
            {
                var id = $(this).attr('id');
                var text = $(this).val();
                console.log(text);
                if (text)
                {
                    c++;
                }
                if (c > 2)
                {
                    $('#' + id).val(0);
                    c = 1;
                }
            }
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.keyCode < 48 || event.keyCode > 57) {
                event.preventDefault();
                // alert('test'); 
            }
        }
    });
});

function ActivateMyBuilding(id) {
    $.ajax({
        cache: false,
        type: "GET",
        data: { id: id },
        url: url + '/' + 'activate-building',
        contentType: 'application/json; charset=utf-8',
        success: function (response) {
            alert(response);
        }
    });
}



function getEMI() {

    if ($('#downpayment').val() == "") {
        $('#downpayment').val("0");
    }

    var downpayment = $('#downpayment').val();
    var loan_amount = $('#loan_amount').val();
    var interest = $('#interest').val();
    var no_of_year = $('#no_of_year').val();
    var button_name = $('#emi').html();

    loan_amount = loan_amount - downpayment;

    if ((loan_amount > 0) && (interest > 0))
    {
        $('#emi').html('...');
        $('.emi_error').html('');
        $.ajax({
            cache: false,
            type: "GET",
            data: {loan_amount: loan_amount, interest: interest, no_of_year: no_of_year},
            url: url + '/' + 'emi',
            beforeSend: function() {
                $('#emi').html('...');
            },
            contentType: 'application/json; charset=utf-8',
            success: function(response) {
                $('.monthly_amt').html(response);
                $('#emi , .emi').html(button_name);

                $('.loan_amount').val(loan_amount);
                $('.interest').val(interest);
                $('.no_of_year').val(no_of_year);

                //$('select.no_of_year').append('<option value="'+no_of_year+'" selected>'+no_of_year+' YR</option>');
                $('.no_of_year option[value="' + no_of_year + '"]').attr('selected', true);
            }
        });
    } else
    {
        if (loan_amount <= 0)
        {
            $('.emi_error').html('Entrez le montant du pr&ecirc;t').css('color', 'red');
            return false;
        }
        if (interest <= 0)
        {
            $('.emi_error').html('Entrez le taux d\'int&eacute;r&ecirc;t').css('color', 'red');
            return false;
        }
    }
}

function getEMICost() {

    if ($('.downpayment').val() == "") {
        $('.downpayment').val("0");
    }

    var downpayment = $('.downpayment').val();
    var loan_amount = $('.loan_amount').val();
    var interest = $('.interest').val();
    var no_of_year = $('.no_of_year').val();
    var button_name = $('.emi').html();

    loan_amount = loan_amount - downpayment;

    if ((loan_amount > 0) && (interest > 0))
    {
        $('.emi_error').html('');
        $('.emi, #emi').html('...');
        $.ajax({
            type: "GET",
            cache: false,
            data: {loan_amount: loan_amount, interest: interest, no_of_year: no_of_year},
            url: url + '/' + 'emi',
            beforeSend: function() {
                $('.emi, #emi').html('...');
            },
            contentType: 'application/json; charset=utf-8',
            success: function(response) {
                $('.monthly_amt').html(response);
                $('.emi').html(button_name);

                $('#loan_amount').val(loan_amount);
                $('#interest').val(interest);
                $('#no_of_year').val(no_of_year);

                $('#no_of_year option[value="' + no_of_year + '"]').attr('selected', true);

            }
        });
    } else
    {
        if (loan_amount <= 0)
        {
            $('.emi_error').html('Enter loan amount').css('color', 'red');
            return false;
        }
        if (interest <= 0)
        {
            $('.emi_error').html('Enter rate of interest').css('color', 'red');
            return false;
        }
    }
}

// registration function
$(document).ready(function () {
    //$('#login-modal').modal('show');

    $(".images-description").change(function () {
        if ($(this).val() != "") {
            var imageID = $(this).attr("ImageID");
            var data = $("#SaveImageTitle-" + imageID).serialize();

            $.ajax({
                data: data,
                cache: false,
                type: 'GET',
                url: url + '/' + 'edittitle',
                contentType: 'application/json; charset=utf-8',
                success: function (response) {
                    $("#msgindeximage").html(response);
                    $("#cmdSaveindeximages").removeAttr("disabled");

                }
            });
        }
    });

    $("#cmdSaveindeximages").click(function () {
        $("#msgindeximage").html("...");
        $("#cmdSaveindeximages").attr("disabled", "disabled");
        var data = $("#sortable").sortable('serialize');

        $.ajax({
            data: data,
            cache: false,
            type: 'GET',
            url: url + '/' + 'updateindeximages',
            contentType: 'application/json; charset=utf-8',
            success: function (response) {
                $("#msgindeximage").html(response);
                $("#cmdSaveindeximages").removeAttr("disabled");

            }
        });
    });

    $("#cmdSaveSelectedImages").click(function () {
        $("#msgindeximage").html("...");
        $("#cmdSaveSelectedImages").attr("disabled", "disabled");

        var imagesIds = "";
        var images = $(".selected_img_elements");

        for (var i = 0; i < images.length; i++) {
            imagesIds += $(images[i]).attr("ImageID") + ",";
        }

        $("#imagesIds").val(imagesIds);

        var data = $('#formsaveimages').serialize();

        $.ajax({
            data: data,
            cache: false,
            type: 'GET',
            url: url + '/' + 'enableimages',
            contentType: 'application/json; charset=utf-8',
            success: function (response) {
                $("#msgindeximage").html(response);
                $("#cmdSaveSelectedImages").removeAttr("disabled");
                setTimeout(function () { location.reload(true); }, 3000); 
            }
        });
    });

    $("#registerForm,#registerFormPackage").submit(function (e) {
        var RegFormID = this.id;
        e.preventDefault();
        var data = $('#' + RegFormID).serialize();

        var token = $('#' + RegFormID + ' > input[name="_token"]').val();
        var registerBtn = $('form#' + RegFormID + ' input#registerBtn').val();

        $.ajax({
            type: "get",
            data: data,
            cache: false,
            url: url + '/' + 'register',
            beforeSend: function () {
                $('form#' + RegFormID + ' input#registerBtn').val('...');
                $('form#' + RegFormID + ' input#registerBtn').attr('disabled');
            },
            contentType: 'application/json; charset=utf-8',
            success: function (response) {

                $('form#' + RegFormID + ' input#registerBtn').val(registerBtn);
                var obj = JSON.parse(response);
                if (obj.response == 200) {
                    $('#login-modal').modal('hide');
                    BootstrapDialog.show({
                        title: 'un message',
                        message: 'Vous avez enregistré avec succès . Maintenant, vous pouvez vous connecter .'
                    });
                    if (RegFormID == 'registerForm') {
                        $('#loginModal').modal('hide');
                    }
                    setTimeout(function () {
                        location.reload(true);
                    }, 1000);

                }
                else if (obj.response == 300) {
                    $('#login-modal').modal('hide');
                    BootstrapDialog.show({
                        title: 'un message',
                        message: 'Quelque chose a mal tourné !'
                    });
                    if (RegFormID == 'registerForm') {
                        $('#loginModal').modal('hide');
                    }
                }
                else {
                    var html = '';
                    for (var i = 0; i < obj.length; i++) {
                        html += '<li>' + obj[i] + '</li>';
                    }
                    $('#regError').html('<div class="alert alert-danger">' + html + '</div>');
                }
            }
        });
    })

    // LOgin 

    $("#loginForm,#loginFormPackage").submit(function (e) {

        var FormID = this.id;
        e.preventDefault();
        var data = $('#' + FormID).serialize();

        console.log(data);
        var token = $('#' + FormID + ' > input[name="_token"]').val();
        var registerBtn = $('form#' + FormID + ' button#loginBtn').val();
        // console.log(registerBtn+'-'+FormID);
        $.ajax({
            type: "get",
            cache: false,
            //  data: {'email':$('loginForm > input[name=email]').val(), '_token': $('loginForm > input[name=_token]').val()},
            data: data,
            url: url + '/' + 'userLogin',
            beforeSend: function () {
                $('form#' + FormID + ' button#loginBtn').html('...');
                $('form#' + FormID + ' button#loginBtn').attr('disabled');
            },
            contentType: 'application/json; charset=utf-8',
            success: function (response) {
                //console.log(response); 
                $('form#' + FormID + ' button#loginBtn').html(registerBtn);
                var obj = JSON.parse(response);
                if (obj.response == 200) {
                    $('#login-modal').modal('hide');

                    var bid = $('#is_user_login').val();
                    if (bid != undefined) {
                        addTofav(bid);
                        location.reload(true);
                        return null;
                    }
                    window.location.href = "http://www.immo-clic.ca/mon-compte";
                }
                else if (obj.response == 300) {
                    $("#password").val("");
                    $('#loginError').html('<div class="alert alert-danger">Nom d\'utilisateur ou mot de passe invalide!</div>');
                    $('#loginErrorPackage').html('<div class="alert alert-danger">Nom d\'utilisateur ou mot de passe invalide!</div>');
                }
                else if (obj.response == 400) {
                    if (FormID == 'loginForm') {
                        $('#loginError').html('<div class="alert alert-danger">Votre ancien mot de passe a &eacute;t&eacute; mis &agrave; jour. Vous pouvez d&eacute;sormais vous connecter!</div>');
                        //$("#loginForm").submit(); 
                    }
                    if (FormID == 'loginFormPackage') {
                        $('#loginErrorPackage').html('<div class="alert alert-danger">Votre ancien mot de passe a &eacute;t&eacute; mis &agrave; jour. Vous pouvez d&eacute;sormais vous connecter!</div>');
                        //$("#loginFormPackage").submit();  
                    }
                }
                else {
                    var html = '';
                    for (var i = 0; i < obj.length; i++) {

                        html += '<li>' + obj[i] + '</li>';
                    }
                    if (FormID == 'loginForm') {
                        $('#loginError').html('<div class="alert alert-danger">' + html + '</div>');
                    }
                    if (FormID == 'loginFormPackage') {
                        $('#loginErrorPackage').html('<div class="alert alert-danger">' + html + '</div>');
                    }

                }
            }
        });
    })

});

	// Reset password

	$("#resetForm").submit(function(e){    
    	
	 	e.preventDefault(); 
	    var data = $('#resetForm').serialize();
	    var registerBtn =  $('#loginBtn').val();     
	        $.ajax({
	            type: "get", 
	          //  data: {'email':$('loginForm > input[name=email]').val(), '_token': $('loginForm > input[name=_token]').val()},
	            data :data,
	            url: url + '/' + 'forgot-password',
	            beforeSend: function() {
	             	$('#resetBtn').html('...');
	            },
	            contentType: 'application/json; charset=utf-8',
	            success: function(response) {
	                $('#resetBtn').html('R&eacute;initialiser mot de passe');
	            	 if(response==1)
	            	 {
	            	     $('#resetError').html('<div class="alert alert-success">Un lien pour modifier votre mot de passe vous as &eacute;t&eacute; envoy&eacute;. Veuillez bien vouloir v&eacute;rifier vos courriel.</div>'); 
	            	 	//$('.field-box-remove').hide();
	            	 	$('#login-modal').modal('hide');
	            	 }else{
	            		$('#resetError').html('<div class="alert alert-danger">'+response+'</div>'); 
	            	}
	            }
        }); 
    });

	// Reset password functionality 
	// resetPasswprdForm

	$("#resetPasswprdForm").submit(function(e){    
    	
	 	e.preventDefault(); 
	    var data = $('#resetPasswprdForm').serialize();
	    var registerBtn =  $('#resetBtn').val();     
	        $.ajax({
	            type: "get", 
	          //  data: {'email':$('loginForm > input[name=email]').val(), '_token': $('loginForm > input[name=_token]').val()},
	            data :data,
	            url: url + '/' + 'reset-password?resetpassword=true',
	            beforeSend: function() {
	             	$('#resetBtn').html('Please Wait');
	            },
	            dataType: 'json',
	            success: function(response) { 
	            	$('#resetBtn').html('Submit');
	            	 if(response.response==200)
	            	 {
	            	 	$('#resetError').html('<div class="alert alert-success">Password sucessfully reset.</div>'); 
	            	 	setTimeout(function(){
	            	 		window.location.href=url;
	            	 	},1000);
	            	 	 
	            	 }else{
	            	 	var obj =response;
		            	var html ='';
		            	 for (var i = 0 ; i <obj.length; i++) {
		            	 	html +=  '<li>'+obj[i]+'</li>';
		            	 }
		            	 $('#resetError').html('<div class="alert alert-danger">'+html+'</div>');  
	            	} 
	            }
        }); 
    });


    //change password functinality
    $("#changePasswprdForm").submit(function(e){    
        e.preventDefault();
        var data = $(this).serialize();        
        $.ajax({
            url: "/changePassword",
            type: "POST",
            data: data ,
            success: function (response) {
                var res=JSON.parse(response);
                if(res.response==200)
                {
                    $("#changePasswprdForm")[0].reset();
                    $("#ressuccess").html("Votre mot de passe &agrave; &eacute;t&eacute; modifier avec succ&egrave;s!");
                }
                else
                {
                    $("#ressuccess").html("");
                }
                if(res.response==300)
                {
                    $("#resetError").html("Erreur");
                }
                else
                {
                    $("#resetError").html("");
                }
                if(res.old_password)
                {
                    $('#old_password_err').html(res.old_password);
                }
                else
                {
                     $('#old_password_err').html('');
                }
                if(res.new_password)
                {
                    $('#new_password_err').html(res.new_password);
                }
                else{
                    $('#new_password_err').html('');
                }
                if(res.confirm_password)
                {
                    $('#cnew_password_err').html(res.confirm_password);
                }
                else
                {
                    $('#cnew_password_err').html('');
                }
                if(res.error)
                {
                    $('#resetError').html(res.error);
                }
                else                 
                {
                    $('#resetError').html('');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
               //console.log(textStatus, errorThrown);
            }
        }); 
    });

	// Add to fav
 
    function addTofav(bid, target)
    { 
    	var is_user_login = $('#is_user_login').val(); 
    	if(is_user_login=='')
    	{
    	    $.ajax({
    	        type: "get",
    	        data: { chkLogin: 1 },
    	        url: url + '/' + 'addTofav',
    	        beforeSend: function () {
    	            //
    	        },
    	        dataType: 'html',
    	        success: function (response) {
                    console.log(response);
    	            if (response.length != 0) { 
    	                $('#is_user_login').val(response);
    	                addTofav(response);
    	            } else {
                        $('#loginModal').removeClass('hide').modal();
                        $('#loginModal').modal('show');
    	            }
    	        }
    	    }); 
    		return false;
    	} 
        if ($($(target).children()).hasClass("fa-star")) {
           // return false;
        } 
    	$.ajax({
            type: "get", 
            data :{bid:bid},
            url: url + '/' + 'addTofav',
            beforeSend: function() {
              //
            },
            contentType: 'application/json; charset=utf-8',
            success: function (response) {
                if(response.length==0)
                {
                    $($(target).children()).removeClass("fa-star");
                    $($(target).children()).addClass("fa-star-o");
                    return false;  
                } 
                $($(target).children()).removeClass("fa-star-o");
                $($(target).children()).addClass("fa-star");
            	$('#fav-modal').modal('show');
            }
        });
 }

 function makeid() {
     var text = "";
     var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

     for (var i = 0; i < 5; i++)
         text += possible.charAt(Math.floor(Math.random() * possible.length));

     return text;
 }

// Check Login Status
function checkLoginStatus(id)
{
	var data;
	$.ajax({
        type: "get", 
        data :{checkLoginStatus:1},
        url: url + '/' + 'checkLoginStatus',
        dataType: 'json',
        success: function(response) { 
        	data = response;

        	document.cookie="username=John Doe";
        
        	if(data==0)
        	{
        		$('#login-modal').modal('show');
        	}

        	var x = document.cookie;
        	console.log(getCookie('username1'));


        }
    }); 
}

$(document).ready(function(){
	$('#prestigeBtn, #classicBtn , #premiumBtn').click('live',function(){
		    var id = this.id;
		    // checkLoginStatus(id);
    });

    if ($("#brokerCell").attr("cell") == "") {
        $("#brokerCell").css("display", "none");
    }
});

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}

function GetStarHouse() {
    if (!$("#ChkStar").is(':checked')) {
        $("#ChkStar").click();
    }
    $(".search-button").click();
}

function GetFreeTourHouse() {
    if (!$("#ChkFreeTour").is(':checked')) {
        $("#ChkFreeTour").click();
    }
    $(".search-button").click();
}

function detectIE() {
    var ua = window.navigator.userAgent;

    var msie = ua.indexOf('MSIE ');
    if (msie > 0) {
        // IE 10 or older => return version number
        return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
    }

    var trident = ua.indexOf('Trident/');
    if (trident > 0) {
        // IE 11 => return version number
        var rv = ua.indexOf('rv:');
        return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
    }

    var edge = ua.indexOf('Edge/');
    if (edge > 0) {
        // Edge (IE 12+) => return version number
        return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
    }

    // other browser
    return false;
}

function GetBrandNewHouse() {
    $("#etat_du_batiment").val("new");
    $(".search-button").click();
}

//Tooltips on interogation
$(document).ready(function () {
    $(".interogation").mouseover(function () {
        $('#link').html($(this).attr("tooltip"));
        $('#link').css({ top: $(this).offset().top + 20 + 'px', left: $(this).offset().left + 40 + 'px', display: 'inline' });
    });

    $(".interogation").mouseout(function () {
        $('#link').css({ display: 'none' });
        $('#link').html("");
    });

    $(".interogation").click(function (e) {
        $('#link').html($(this).attr("tooltip"));
        $('#link').css({ top: $(this).offset().top + 20 + 'px', left: $(this).offset().left + 40 + 'px', display: 'inline' });
        e.stopPropagation();
    });

    $(".packages").click(function (e) {
        $('#link').css({ display: 'none' });
        $('#link').html("");
    });
});

$(document).ready(function () {
    if ($(".highlight_txt").length > 0) {

        var highlights = $(".highlight_txt");

        for (var j = 0; j < highlights.length; j++) {

            var caracte = $(highlights[j]).find(".caracterictique");
            var last = "";

            for (var i = 0; i < caracte.length; i++) {
                if ($(caracte[i]).css('display') == 'inline') {
                    last = $(caracte[i]);
                }
            }

            if (last != "") {
                last.html(last.html().substring(0, last.html().length - 2));
            }
        }
    }
});

/****************custom js********************/
$('#region_third').change(function(){
    var id=$(this).val();
    if(id)
    {
        $.ajax({
        url: "/get_city",
        type: "post",
        data: {'id':id} ,
        success: function (response) {
            var res=JSON.parse(response);                               
            var html1='<option>Please Select Ville</option>';
            $.each( res, function( key1, value1 ) {      
            //console.log( value1.key);        
              html1+="<option value='"+value1.key+"'>"+value1.value+"</option>";
            });
            $('#option_ville').html(html1);
           // you will get response from your php page (what you echo or print)                 

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });
    }
});

/*********************remove favriote**************************/
$('.rem_favorite').click(function(){
    var id=$(this).attr('data-id');    
          $.ajax({
            url: "/rem_fav",
            type: "GET",
            data: {'id':id} ,
            success: function (response) {
                var res=JSON.parse(response);                
                $('#'+res).remove('');
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });
});

$(function(){
    $('#form4').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });

    $('#pay_by_paypal').click(function(){
        $('.paymentMsg').hide();
        $('.payment_msg').html("Don't refresh page while payment is being processed !");
        eraseCookie('fb_ad_amt'); 
    });

    $("#paypal_pro").submit(function (e) {
       // e.preventDefault(); 
        var credit_card = $('#credit_card').val();
        var cvv = $('#cvv').val();
        var expiry_month = $('#expiry_month').val();
        var expiry_yr   = $('#expiry_yr').val();
        var error = 0;
        if(credit_card.length<16)
        {   
            if(credit_card.length==0){ $('.credit_err_msg').html('Enter Card Number').show();  return false; }
            $('.credit_err_msg').html('Invalid Card Number').show(); 
            error++;
            return false;
        }
        if(cvv.length<3)
        {   
            if(cvv.length==0){ $('.credit_err_msg').html('Enter CVV Number').show();  return false; }
            $('.credit_err_msg').html('Invalid CVV Number').show(); 
            error++;
            return false;
        }
        if((expiry_month.length)==0){
            $('.credit_err_msg').html('Select Expiry Month').show(); 
            error++;
            return false;
        }
        if((expiry_yr.length)==0){
            $('.credit_err_msg').html('Select Expiry Year').show(); 
            error++;
            return false;
        }
        if(error==0)
        {
           $('.credit_err_msg').hide();
           $('.paymentMsg').hide();
           $('.payment_msg').html("Don't refresh page while payment is being processed !");
           $('form#paypal_pro').submit(); 
        }
    }); 

// add amount on check for fb add
    var cookie = readCookie('fb_ad_amt'); 
    var is_cookie = $('#targeted_advertising').length;
    if(cookie==100)
    {  
        if(is_cookie!=0)
        {
            document.getElementById("targeted_advertising").checked = true;
            add_amount_for_fb(); 
        } 
    }else{ 
        if(is_cookie!=0)
        {
          document.getElementById("targeted_advertising").checked = false;   
        } 
    }
    $('#targeted_advertising').click(function(){
       
        if($('#targeted_advertising').is(':checked'))
        {  
             $('.fb_add_amt').val(1); 
             createCookie('fb_ad_amt',100,1);
             $('.with_fb_amt').show();
             $('.without_fb').hide();
            
        }else{ 
            $('.fb_add_amt').val(""); 
            eraseCookie('fb_ad_amt'); 
            $('.without_fb').show(); 
            $('.with_fb_amt').hide(); 
        }
    }); 
    // remove cookie for fb_ad_amount
    $('.select-this-sector-package').click(function() {
        eraseCookie('fb_ad_amt'); 
    });
});


function add_amount_for_fb()
{
    if($('#targeted_advertising').is(':checked'))
        { 
             $('.fb_add_amt').val(1); 
             createCookie('fb_ad_amt',100,1);
             $('.with_fb_amt').show();
             $('.without_fb').hide();
            
        }else{
       
            $('.fb_add_amt').val("");
             
            eraseCookie('fb_ad_amt'); 
            $('.without_fb').show(); 
            $('.with_fb_amt').hide();

        }
}


/*======Following method is use to create cookie,delete and read cookie======*/
function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}
/*====================End Cookie method=================*/