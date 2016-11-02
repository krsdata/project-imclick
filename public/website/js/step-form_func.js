$(document).ready(function () {

    $("#form1").submit(function (e) {
        e.preventDefault();
        var attr = $(this).attr('data_id');
        var next_attr = parseInt(attr) + 1;
        var estate_type = $("#estate_type").val();
        var precision_type = $("#precision_type").val();
        var categories_type = $("#categories_type").val();
        var price = $("#price").val();
        var year = $("#year").val();
        var desc1 = $("#desc1").val();
        var desc2 = $("#desc2").val();
        var house_id = $("#house_id").val();
        !estate_type ? $("#estate_type").css('color', 'red') : $("#estate_type").css('color', '');
        !precision_type ? $("#precision_type").css('color', 'red') : $("#precision_type").css('color', '');
        !categories_type ? $("#categories_type").css('color', 'red') : $("#categories_type").css('color', '');
        !price ? $("#price").css('background-color', 'rgb(255, 116, 101)') : $("#price").css('background-color', '');
        !year ? $("#year").css('color', 'red') : $("#year").css('color', '');
        !desc1 ? $("#desc1").css('background-color', 'rgb(255, 116, 101)') : $("#desc1").css('background-color', '');
        desc2 = desc2 ? desc2 : desc1;
        var free_visit = $("#free_visit").prop('checked');
        free_visit = free_visit ? 1 : 0;
        var Brand_new = $("#new").prop('checked');
        Brand_new = Brand_new ? 1 : 0;


        if (!estate_type || !precision_type || !categories_type || !price || !year || !desc1) {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            return false;
        }
        else if (!$.isNumeric(estate_type)) {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            return false;
        }
        else if (!$.isNumeric(price)) {
            $('#price_error').html('Veuillez remplir le champ seulement avec des chiffres.');
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            return false;
        }
        else if (!$.isNumeric(precision_type) || !$.isNumeric(precision_type)) {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            return false;
        }
        else {
            var token = $('#form1 > input[name="_token"]').val();
            $.ajax({
                cache: false,
                url: url + "/save_house",
                type: "POST",
                data: { '_token': token, 'house_id': house_id, 'TypeID': estate_type, 'price': price, 'precisionID': precision_type,
                    'CategoryID': categories_type, 'Built_in': year, 'Description_fr': desc1, 'Description_en': desc2, 'Free_tour': free_visit, 'Brand_new': Brand_new, 'form_num': 1
                },
                success: function (response) {
                    console.log(response);

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    });


    /****************for form2***********************/
    $("#form2").submit(function (e) {
        e.preventDefault();
        var attr = $(this).attr('data_id');
        var next_attr = parseInt(attr) + 1;
        var telephone = $("#telephone").val();
        var cellulaire = $("#cellulaire").val();

        !telephone ? $("#telephone").css('background-color', 'rgb(255, 116, 101)') : $("#telephone").css('color', '');

        if (!telephone) {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
        }
        else {
            var token = $('#form2 > input[name="_token"]').val();
            $.ajax({
                cache: false,
                url: url + "/save_house",
                type: "POST",
                data: { '_token': token, 'Phone': telephone, 'Cell': cellulaire, 'form_num': 2 },
                success: function (response) {
                    console.log(response);

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    });
    /***************end form2***************************/
    /***************start form3***************************/
    $("#form3").submit(function (e) {
        e.preventDefault();
        var attr = $(this).attr('data_id');
        var next_attr = parseInt(attr) + 1;
        var region_third = $("#region_third").val();
        var option_ville = $("#option_ville").val();
        var input_id = $("#input_id").val();
        var street_name = $("#street_name").val();
        var street_number = $("#street_number").val();
        var postal = $("#postal").val();
        var house_id = $("#house_id").val();
        !region_third ? $("#region_third").css('color', 'red') : $("#region_third").css('color', '');
        !option_ville ? $("#option_ville").css('color', 'red') : $("#option_ville").css('color', '');
        !input_id ? $("#input_id").css('color', 'red') : $("#input_id").css('color', '');
        !street_name ? $("#street_error").html('Veuillez remplir ce champ.') : $("#street_error").html('');
        !street_number ? $("#street_number_error").html('Veuillez remplir ce champ.') : $("#street_number_error").html('');
        !postal ? $("#postal_error").html('Veuillez remplir ce champ.') : $("#postal_error").html('');
        if (!region_third || !option_ville || !input_id || !street_name || !street_number || !postal) {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            return false;
        }
        else {
            var token = $('#form3 > input[name="_token"]').val();
            $.ajax({
                cache: false,
                url: url + "/save_house",
                type: "POST",
                data: { '_token': token, 'house_id': house_id, 'RegionID': region_third, 'CityID': option_ville, 'StreetType': input_id, 'StreetName': street_name, 'HouseNumber': street_number, 'Postal_code': postal, 'form_num': 3 },
                success: function (response) {

                    // $('#user_location').val(street_name);                
                    // $('.location_button').trigger('click'); 

                    var adresse = $("#street_number").val() + " " + $("#street_name").val() + " " + $("#option_ville option:selected").text();
                    $("#user_location").val(adresse);

                    var lat = $('.register-form__latitude-holder').val();
                    var long = $('.register-form__longitude-holder').val();
                    initMap(lat, long);

                    console.log(response);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    });
    /***************end form3***************************/
    /***************start form4***************************/
    $("#form4").submit(function (e) {
        e.preventDefault();
        var attr = $(this).attr('data_id');
        var next_attr = parseInt(attr) + 1;
        var latitude = $('.register-form__latitude-holder').val();
        var longitude = $('.register-form__longitude-holder').val();
        var token = $('#form4 > input[name="_token"]').val();
        var Size_land_area = land_frontage * land_depth;
        var house_id = $("#house_id").val();
        $.ajax({
            cache: false,
            url: url + "/save_house",
            type: "POST",
            data: { '_token': token, 'house_id': house_id, 'Latitude': latitude, 'Longitude': longitude, 'form_num': 4 },
            success: function (response) {
                console.log(response);

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
    /***************end form4***************************/
    /**************map****************/
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
    /**********end of map**************/
    /***************start form5***************************/
    $("#form5").submit(function (e) {
        e.preventDefault();
        var attr = $(this).attr('data_id');
        var next_attr = parseInt(attr) + 1;
        var land_frontage = $("#land_frontage").val();
        var land_depth = $("#land_depth").val();
        var building_width = $("#building_width").val();
        var building_depth = $("#building_depth").val();
        var land_area = $("#land_area").val();
        var Living_area_size_feet = $("#Living_area_size_feet").val();
        var house_id = $("#house_id").val();

        if (!$.isNumeric(land_frontage) && land_frontage != "") {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            $('#land_frontage_error').html("Veuillez remplir le champ seulement avec des chiffres.");
            return false;
        }
        else if (!$.isNumeric(land_depth) && land_depth != "") {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            $('#land_depth_error').html("Veuillez remplir le champ seulement avec des chiffres.");
            return false;
        }
        else if (!$.isNumeric(land_area) && land_area != "") {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            $('#land_area_error').html("Veuillez remplir le champ seulement avec des chiffres.");
            return false;
        }
        else if (!$.isNumeric(building_width) && building_width != "") {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            $('#building_width_error').html("Veuillez remplir le champ seulement avec des chiffres.");
            return false;
        }
        else if (!$.isNumeric(building_depth) && building_depth != "") {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            $('#building_depth_error').html("Veuillez remplir le champ seulement avec des chiffres.");
            return false;
        }
        else if (!$.isNumeric(Living_area_size_feet) && Living_area_size_feet != "") {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            $('#Living_area_size_feet_error').html("Veuillez remplir le champ seulement avec des chiffres.");
            return false;
        } else {
            var token = $('#form5 > input[name="_token"]').val();
            //var Size_land_area=land_frontage*land_depth;
            // res=0.3048*land_area;
            // land_area=res.toFixed(2);
            res1 = 0.3048 * Living_area_size_feet;
            Living_area_size_feet_meter = res1.toFixed(2);
            $.ajax({
                cache: false,
                url: url + "/save_house",
                type: "POST",
                data: { '_token': token, 'house_id': house_id, 'Size_land_frontage': land_frontage, 'Size_land_depth': land_depth, 'Size_building_width': building_width, 'Size_building_depth': building_depth,
                    'Size_land_area': land_area, 'Living_area_size_feet': Living_area_size_feet, 'Living_area_size_meter': Living_area_size_feet_meter, 'form_num': 5
                },
                success: function (response) {
                    console.log(response);

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    });

    /***************end form5***************************/
    /***************start form6***************************/
    $("#form6").submit(function (e) {
        e.preventDefault();
        var attr = $(this).attr('data_id');
        var next_attr = parseInt(attr) + 1;
        var role = $("#role").val();
        var batimemt = $("#batimemt").val();
        var tarrain = $("#tarrain").val();
        var total = $("#total").val();
        var house_id = $("#house_id").val();

        if (!role) {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            return false;
        }
        else if (!$.isNumeric(batimemt) && batimemt != "") {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            $('#batimemt_error').html("Veuillez remplir le champ seulement avec des chiffres.");
            return false;
        }
        else if (!$.isNumeric(tarrain) && tarrain != "") {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            $('#tarrain_error').html("Veuillez remplir le champ seulement avec des chiffres.");
            return false;
        }
        else if (!$.isNumeric(total) && total != "") {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            $('#total_error').html("Veuillez remplir le champ seulement avec des chiffres.");
            return false;
        }
        else {
            var token = $('#form6 > input[name="_token"]').val();
            $.ajax({
                cache: false,
                url: url + "/save_house",
                type: "POST",
                data: { '_token': token, 'house_id': house_id, 'Evaluation_year': role, 'Evaluation_building': batimemt, 'Evaluation_ground': tarrain, 'Evaluation_total': total, 'form_num': 6 },
                success: function (response) {
                    console.log(response);

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    });


    /***************end form6***************************/
    /***************start form7***************************/
    $("#form7").submit(function (e) {
        e.preventDefault();
        var attr = $(this).attr('data_id');
        var next_attr = parseInt(attr) + 1;
        var electricity = $("#electricity").val();
        var assurance = $("#assurance").val();
        var heat = $("#heat").val();
        var maintanence = $("#maintanence").val();
        var copropriete = $("#copropriete").val();
        var municipal = $("#municipal").val();
        var scolaries = $("#scolaries").val();
        var other_taxes = $("#other_taxes").val();
        var house_id = $("#house_id").val();

        if (!$.isNumeric(electricity) && electricity) {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            $('#electricity_error').html("Veuillez remplir le champ seulement avec des chiffres.");
            return false;
        }
        else if (!$.isNumeric(assurance) && assurance) {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            $('#assurance_error').html("Veuillez remplir le champ seulement avec des chiffres.");
            return false;
        }
        else if (!$.isNumeric(heat) && heat) {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            $('#heat_error').html("Veuillez remplir le champ seulement avec des chiffres.");
            return false;
        }
        else if (!$.isNumeric(maintanence) && maintanence) {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            $('#maintanence_error').html("Veuillez remplir le champ seulement avec des chiffres.");
            return false;
        }
        else if (!$.isNumeric(copropriete) && copropriete) {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            $('#copropriete_error').html("Veuillez remplir le champ seulement avec des chiffres.");
            return false;
        }
        else if (!$.isNumeric(municipal) && municipal) {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            $('#municipal_error').html("Veuillez remplir le champ seulement avec des chiffres.");
            return false;
        }
        else if (!$.isNumeric(scolaries) && scolaries) {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            $('#scolaries_error').html("Veuillez remplir le champ seulement avec des chiffres.");
            return false;
        }
        else if (!$.isNumeric(other_taxes) && other_taxes) {
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            $('#other_taxes_error').html("Veuillez remplir le champ seulement avec des chiffres.");
            return false;
        }
        else {
            var token = $('#form7 > input[name="_token"]').val();
            electricity_year = electricity * 12;
            assurance_year = assurance * 12;
            heat_year = heat * 12;
            maintanence_year = maintanence * 12;
            Copropriete_taxes_by_year = copropriete * 12;
            municipal_month = municipal / 12;
            scolaries_month = scolaries / 12;
            other_taxes_month = other_taxes / 12;
            $.ajax({
                cache: false,
                url: url + "/save_house",
                type: "POST",
                data: { '_token': token, 'house_id': house_id, 'Electricity_by_month': electricity, 'Insurance_by_month': assurance,
                    'Heating_by_month': heat, 'Maintenance_fees_by_month': maintanence, 'Copropriete_taxes_by_month': copropriete,
                    'Electricity_by_year': electricity_year, 'Insurance_by_year': assurance_year, 'Heating_by_year': heat_year,
                    'Maintenance_fees_by_year': maintanence_year, 'Municipal_taxes_by_year': municipal, 'Copropriete_taxes_by_year': Copropriete_taxes_by_year,
                    'School_taxes_by_year': scolaries, 'Other_taxes_by_year': other_taxes, 'Municipal_taxes_by_month': municipal_month,
                    'School_taxes_by_month': scolaries_month, 'Other_taxes_by_month': other_taxes_month, 'form_num': 7
                },
                success: function (response) {
                    console.log(response);

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    });


    /***************end form7***************************/

    /***************start form8***************************/
    $("#form8").submit(function (e) {
        e.preventDefault();
        var attr = $(this).attr('data_id');
        var next_attr = parseInt(attr) + 1;
        var inclusion = $("#inclusion").val();
        var other_inc = $("#other_inc").val();
        var exclusion = $("#exclusion").val();
        var other_exc = $("#other_exc").val();
        var house_id = $("#house_id").val();
        var token = $('#form8 > input[name="_token"]').val();
        $.ajax({
            cache: false,
            url: url + "/save_house",
            type: "POST",
            data: { '_token': token, 'house_id': house_id, 'inclusion': inclusion, 'Inclusion_autre': other_inc,
                'exclusion': exclusion, 'Exclusion_autre': other_exc, 'form_num': 8
            },
            success: function (response) {
                console.log(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                $("#step-" + attr).show();
                $("#step-" + next_attr).hide();
                $('a[href="#step-' + attr + '"]').addClass("btn-primary");
                $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
                return false;
            }
        });

    });


    /***************end form8***************************/
    /***************start form9***************************/
    $("#form9").submit(function (e) {
        e.preventDefault();
        var attr = $(this).attr('data_id');
        var next_attr = parseInt(attr) + 1;
        var house_id = $("#house_id").val();
        var choice_Piece = $("#choice_Piece").val();
        var etage_val = $("#etage_val").val();
        var pieds = $("#pieds").val();
        var pouces = $("#pouces").val();
        var pieds1 = $("#pieds1").val();
        var pouces1 = $("#pouces1").val();
        var courve_val = $('#courve_val').val();
        var token = $('#form9 > input[name="_token"]').val();

        if (!$.isNumeric(pieds)) {
            $('#pieds_err').html('Veuillez remplir le champ seulement avec des chiffres.');
            $('#pieds_err').css('color', 'red');
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            return false;
        }
        else if (!$.isNumeric(pouces)) {
            $('#pouces_err').html('Veuillez remplir le champ seulement avec des chiffres.');
            $('#pouces_err').css('color', 'red');
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            return false;
        }
        else if (!$.isNumeric(pieds1)) {
            $('#pieds1_err').html('Veuillez remplir le champ seulement avec des chiffres.');
            $('#pieds1_err').css('color', 'red');
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            return false;
        }
        else if (!$.isNumeric(pouces1)) {
            $('#pouces1_err').html('Veuillez remplir le champ seulement avec des chiffres.');
            $('#pouces1_err').css('color', 'red');
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            return false;
        }
        else {
            $.ajax({
                cache: false,
                url: url + "/save_house",
                type: "POST",
                data: { '_token': token, 'house_id': house_id, 'Name': choice_Piece, 'Stage': etage_val, 'Width_X': pieds,
                    'Width_Pouce': pouces, 'Height_Y': pieds1, 'Height_Pouce': pouces1, 'courve_val': courve_val, 'form_num': 9
                },
                success: function (response) {
                    var res = JSON.parse(response);
                    console.log(res);
                    var html = $('.listofplench').html();

                    var piece = $("#choice_Piece option:selected").text();
                    var niveau = $("#etage_val option:selected").text();
                    var type_plancher = $("#courve_val option:selected").text();

                    html += '<div class="floor_' + res.id + '">';
                    html += '<span style="width: 100px;float: left;">' + truncateText(piece, 13) + '</span>';
                    html += '<span style="width: 100px;float: left;">' + niveau + '</span>';
                    html += '<span style="width: 70px;float: left;">' + truncateText(type_plancher, 8) + '</span>';
                    html += '<span data-attr="' + res.id + '" class="plench_del" onclick="return del_form_9(' + res.id + ');"><img src="' + img_url + '" style="height: 18px;cursor:pointer;"></span>';
                    html += '</div>';

                    $('.listofplench').html(html);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    $("#step-" + attr).show();
                    $("#step-" + next_attr).hide();
                    $('a[href="#step-' + attr + '"]').addClass("btn-primary");
                    $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
                    return false;
                }
            });
        }
        return false;
    });

    $('#plench_plus').click(function () {
        var courve_val = $('#courve_val').val();
        var i = $('#hid_plench').val();
        if (i == 1) {
            $('#plench_val').append(courve_val);
        }
        else {
            $('#plench_val').append(',' + courve_val);
        }
        $(".list_plench").append('<div class="' + i + '"><span style="float: left; width: 88%;"><b>' + courve_val + '</b></span><span onClick="del(' + i + ')"><img src="' + img_url + '" style="width: 18px;height: 18px;cursor:pointer;"></span></div>');
        i++;
        $('#hid_plench').val(i);
    });
    $('#pieds').keyup(function () {
        var data = $(this).val();
        if (!$.isNumeric(data)) {
            $('#pieds_err').html('Veuillez remplir le champ seulement avec des chiffres.');
            $('#pieds_err').css('color', 'red');
        }
        else {
            $('#pieds_err').html('');
            $('#pieds_err').css('color', '');
        }
    });

    $('#pouces').keyup(function () {
        var data = $(this).val();
        if (!$.isNumeric(data)) {
            $('#pouces_err').html('Veuillez remplir le champ seulement avec des chiffres.');
            $('#pouces_err').css('color', 'red');
        }
        else {
            $('#pouces_err').html('');
            $('#pouces_err').css('color', '');
        }
    });

    $('#pieds1').keyup(function () {
        var data = $(this).val();
        if (!$.isNumeric(data)) {
            $('#pieds1_err').html('Veuillez remplir le champ seulement avec des chiffres.');
            $('#pieds1_err').css('color', 'red');
        }
        else {
            $('#pieds1_err').html('');
            $('#pieds1_err').css('color', '');
        }
    });
    $('#pouces1').keyup(function () {
        var data = $(this).val();
        if (!$.isNumeric(data)) {
            $('#pouces1_err').html('Veuillez remplir le champ seulement avec des chiffres.');
            $('#pouces1_err').css('color', 'red');
        }
        else {
            $('#pouces1_err').html('');
            $('#pouces1_err').css('color', '');
        }
    });
    /***************end form9***************************/
    /***************start form10***************************/
    $("#form10").submit(function (e) {
        e.preventDefault();
        var attr = $(this).attr('data_id');
        var next_attr = parseInt(attr) + 1;
        var house_id = $("#house_id").val();
        var armo = $("#armo").val();
        var autre1 = $("#autre1").val();
        var fenetre = $("#fenetre").val();
        var autre2 = $("#autre2").val();
        var sous = $("#sous").val();
        var autre3 = $("#autre3").val();
        var toiture = $("#toiture").val();
        var autre4 = $("#autre4").val();
        var equi = $("#equi").val();
        var autre5 = $("#autre5").val();
        var appareils = $("#appareils").val();
        var autre6 = $("#autre6").val();
        var chauffage = $("#chauffage").val();
        var autre7 = $("#autre7").val();
        var energie = $("#energie").val();
        var autre8 = $("#autre8").val();
        var token = $('#form10 > input[name="_token"]').val();
        $.ajax({
            cache: false,
            url: url + "/save_house",
            type: "POST",
            data: { '_token': token, 'house_id': house_id, 'indoor_cupboard': armo,
                'indoor_cupboard_other': autre1, 'indoor_windows_type': fenetre,
                'indoor_windows_type_other': autre2,
                'indoor_basement': sous, 'indoor_basement_other': autre3,
                'indoor_roofing': toiture, 'indoor_roofing_other': autre4,
                'indoor_equipment_available': equi, 'indoor_equipment_available_other': autre5,
                'indoor_heating_system': appareils, 'indoor_heating_system_other': autre6,
                'indoor_heating_energy': energie, 'indoor_heating_energy_other': autre7,
                'indoor_energy_system': chauffage, 'indoor_energy_system_other': autre8,
                'form_num': 10
            },
            success: function (response) {
                console.log(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                $("#step-" + attr).show();
                $("#step-" + next_attr).hide();
                $('a[href="#step-' + attr + '"]').addClass("btn-primary");
                $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
                return false;
            }
        });
    });
    /***************end form10***************************/
    /***************start form11***************************/
    $("#form11").submit(function (e) {
        e.preventDefault();
        var attr = $(this).attr('data_id');
        var next_attr = parseInt(attr) + 1;
        var house_id = $("#house_id").val();
        var garage = $("#garage").val();
        var autre11 = $("#autre11").val();
        var piscine = $("#piscine").val();
        var autre12 = $("#autre12").val();
        var topographie = $("#topographie").val();
        var autre13 = $("#autre13").val();
        var system = $("#system").val();
        var autre14 = $("#autre14").val();
        var proximate = $("#proximate").val();
        var autre15 = $("#autre15").val();
        var pare = $("#pare").val();
        var autre16 = $("#autre16").val();
        var foundation = $("#foundation").val();
        var autre17 = $("#autre17").val();
        var eau = $("#eau").val();
        var autre18 = $("#autre18").val();
        var token = $('#form11 > input[name="_token"]').val();
        $.ajax({
            cache: false,
            url: url + "/save_house",
            type: "POST",
            data: { '_token': token, 'house_id': house_id, 'outdoor_garage': garage,
                'outdoor_garage_other': autre11, 'outdoor_pool': piscine,
                'outdoor_pool_other': autre12,
                'outdoor_topography': topographie, 'outdoor_topography_other': autre13,
                'outdoor_sewage_system': system, 'outdoor_sewage_system_other': autre14,
                'outdoor_proximity': proximate, 'outdoor_proximity_other': autre15,
                'outdoor_siding': pare, 'outdoor_siding_other': autre16,
                'outdoor_foundation': foundation, 'outdoor_foundation_other': autre17,
                'outdoor_water_supply': eau, 'outdoor_water_supply_other': autre18,
                'form_num': 11
            },
            success: function (response) {
                console.log(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                $("#step-" + attr).show();
                $("#step-" + next_attr).hide();
                $('a[href="#step-' + attr + '"]').addClass("btn-primary");
                $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
                return false;
            }
        });
    });
    /***************end form11***************************/
    /***************start form12***************************/
    $("#form12").submit(function (e) {
        e.preventDefault();
        var attr = $(this).attr('data_id');
        var next_attr = parseInt(attr) + 1;
        var house_id = $("#house_id").val();
        var nbun_val_data = $("#nbun_val_data").val();
        var prix = parseInt($("#prix").val());
        var avec = $("#avec").prop('checked');
        if (avec == true) {
            avec = 1;
        }
        else {
            avec = 0;
        }
        if (!nbun_val_data) {
            $('#nbun_val_data').css('color', 'red');
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            return false;
        }
        else if (!$.isNumeric(prix)) {
            $('#prix_err').html('Veuillez remplir le champ seulement avec des chiffres.');
            $("#step-" + attr).show();
            $("#step-" + next_attr).hide();
            $('a[href="#step-' + attr + '"]').addClass("btn-primary");
            $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
            return false;
        }
        else {
            var token = $('#form12 > input[name="_token"]').val();
            $.ajax({
                cache: false,
                url: url + "/save_house",
                type: "POST",
                data: { '_token': token, 'house_id': house_id, 'id': nbun_val_data,
                    'price_by_month': prix, 'already_rent': avec, 'form_num': 12
                },
                success: function (response) {
                    var res = JSON.parse(response);
                    console.log(res);
                    $('#prix_err').html('');
                    $('#nbun_val_data').css('color', '');
                    var html = '';
                    $.each(res, function (key, value) {
                        html += '<div class="form_12_' + value.id1 + '"><span style="width: 75px;float: left;">' + value.Type + '</span><span style="width: 100px;float: left;">' + value.price_by_month + '</span><span style="width: 100px;float: left;">' + value.already_rent + '</span><span style="width: 25px;float: left;"><img  data-attr="' + value.id1 + '" onClick="del_form_12(' + value.id1 + ')" src="' + img_url + '" style="height: 18px;cursor:pointer;"></span></div>';
                    });
                    $('.formdata_12').append(html);
                    console.log(html);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    $("#step-" + attr).show();
                    $("#step-" + next_attr).hide();
                    $('a[href="#step-' + attr + '"]').addClass("btn-primary");
                    $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
                    return false;
                }
            });
        }
    });



    /***************end form12***************************/

    /***************start form13***************************/
    $("#form13").submit(function (e) {
        e.preventDefault();
        var attr = $(this).attr('data_id');

        var house_id = $("#house_id").val();
        var next_attr = parseInt(attr) + 1;
        var Total_rooms_number = $("#Total_rooms_number").val().replace(/^\s+|\s+$/gm, '');
        var Rooms_number = $("#Rooms_number").val().replace(/^\s+|\s+$/gm, '');
        var Bathroom_number = $("#Bathroom_number").val().replace(/^\s+|\s+$/gm, '');
        var Parking_outdoor_number = $("#Parking_outdoor_number").val().replace(/^\s+|\s+$/gm, '');
        var Parking_garage_number = $("#Parking_garage_number").val().replace(/^\s+|\s+$/gm, '');
        var with_income = $("#with_income:checkbox:checked").length;
        var Pool = $("#Pool:checkbox:checked").length;
        var No_neighbors_behind = $("#No_neighbors_behind:checkbox:checked").length;
        var fireplace = $("#fireplace:checkbox:checked").length;
        var panoramic_view = $("#panoramic_view:checkbox:checked").length;
        var Garage = $("#Garage:checkbox:checked").length;
        var waterside = $("#waterside:checkbox:checked").length;
        var Air_clim = $("#Air_clim:checkbox:checked").length;
        var token = $('#form13 > input[name="_token"]').val();

        if (Total_rooms_number == '') {
            $('span.Total_rooms_number_err').html('Ce champ est obligatoire.').css('color', 'red').show();
            return false;
        } else {
            $('span.Total_rooms_number_err').hide();
        }

        if (Rooms_number == '') {
            $('span.Rooms_number_err').html('Ce champ est obligatoire.').css('color', 'red').show();
            return false;
        } else {
            $('.Rooms_number_err').hide();
        }

        if (Bathroom_number == '') {
            $('span.Bathroom_number_err').html('Ce champ est obligatoire.').css('color', 'red').show();
            return false;
        } else {
            $('.Bathroom_number_err').hide();
        }

        if (Parking_outdoor_number == '') {
            $('span.Parking_outdoor_number_err').html('Ce champ est obligatoire.').css('color', 'red').show();
            return false;
        } else {
            $('.Parking_outdoor_number_err').hide();
        }

        if (Parking_garage_number == '') {
            $('span.Parking_garage_number_err').html('Ce champ est obligatoire.').css('color', 'red').show();
            return false;
        } else {
            $('span.Parking_garage_number_err').hide();
        }


        $.ajax({
            cache: false,
            url: url + "/save_house",
            type: "POST",
            data: { '_token': token, 'house_id': house_id, 'Air_clim': Air_clim, 'waterside': waterside,
                'Garage': Garage, 'panoramic_view': panoramic_view,
                'fireplace': fireplace,
                'No_neighbors_behind': No_neighbors_behind, 'Pool': Pool,
                'with_income': with_income, 'Parking_outdoor_number': Parking_outdoor_number,
                'Bathroom_number': Bathroom_number, 'Rooms_number': Rooms_number, 'Total_rooms_number': Total_rooms_number,
                'Parking_garage_number': Parking_garage_number, 'form_num': 13
            },
            success: function (response) {
                console.log(response);
                BuildingSaved();
                window.location = url + '/mon-compte#List';
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                $("#step-" + attr).show();
                $("#step-" + next_attr).hide();
                $('a[href="#step-' + attr + '"]').addClass("btn-primary");
                $('a[href="#step-' + next_attr + '"]').removeClass("btn-primary");
                return false;
            }
        });
    });
    /***************end form13***************************/

});

function total_val()
{
    var batimemt=$("#batimemt").val();
    var tarrain=$("#tarrain").val();
    var total=0;
    batimemt=batimemt?batimemt:0;
    tarrain=tarrain?tarrain:0;
    total=parseInt(batimemt)+parseInt(tarrain);
    $("#total").val(total);
}

function del(id)
{
    $('.'+id).remove();
}

function del_form_12(id){
    var token = $('#form12 > input[name="_token"]').val();
    $.ajax({
        cache: false,
        url: url+"/delete_list",
        type: "POST",
        data: {'_token':token,'id':id} ,
        success: function (response) {
            console.log(response);         
            $('.form_12_'+id).remove();           
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);           
        }
    });
}

function del_form_9(id) {
    var token = $('#form9 > input[name="_token"]').val();
    $.ajax({
        cache: false,
        url: url + "/del_build_room",
        type: "POST",
        data: { '_token': token, 'house_id': id },
        success: function (response) {
            console.log(response);
            $('.floor_' + id).remove();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            return false;
        }
    });
}