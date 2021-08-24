(function() {
    'use strict';

    window.addEventListener('load', function() {

        var intPhone = document.querySelector(".int-phone"),
        errorMsg = document.querySelector("#phone-error-msg"),
        validMsg = document.querySelector("#phone-valid-msg");

        var errorMap = ["Mobile number is invalid.", "Invalid country code.", "Mobile number too short.", "Mobile number too long.", "Invalid mobile number."];

         var iti = window.intlTelInput(intPhone, {
            hiddenInput: "mobile_full",
            initialCountry: "PH",
            onlyCountries: ["ph"],
            separateDialCode: true,
            utilsScript: "../js/intTel/utils.js",
        });

        var reset = function() {
            intPhone.classList.remove("error");
            errorMsg.innerHTML = "";
            errorMsg.classList.add("d-none");
            validMsg.classList.add("d-none");
        };

        // on blur: validate
        intPhone.addEventListener('blur', function() {
            reset();
            if (intPhone.value.trim()) {
            if (iti.isValidNumber()) {
                validMsg.classList.remove("d-none");
                intPhone.setCustomValidity("");
            } else {
                intPhone.classList.add("error");
                intPhone.setCustomValidity(errorMap[errorCode]);
                var errorCode = iti.getValidationError();
                errorMsg.innerHTML = errorMap[errorCode];
                errorMsg.classList.remove("d-none");
            }
            }
        });

        // on keyup / change flag: reset
        intPhone.addEventListener('change', reset);
        intPhone.addEventListener('keyup', reset);

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');

      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            form.classList.add('has-validation-errors');
          } else {
            form.classList.remove('has-validation-errors');
          }
          form.classList.add('was-validated');

          if($('#forCenterValidaiton').val() == 'hasService') {
              $('#notice').hide();
          } else {
              $('#notice').show();
          }

        if ($("#password, #password_confirmation").val() == "") {
            $("#password, #password_confirmation").addClass('is-invalid');
            return false;
        } else {
            $("#password, #password_confirmation").removeClass('is-invalid');
        }

        if ($("#password").val() != $("#password_confirmation").val()) {
            event.preventDefault();
            $("#password_confirmation").addClass('is-invalid');
            $("#confirm_password_error_message").html('<span class="text-danger">Password and confirm password not matched!</span>');
            return false;
        } 
        $("#confirm_password_error_message").html('');

        }, false);
      });
    }, false);
})();

$(document).ready(() => {

    if($('.select2').length) {
        $('.select2').select2({
            allowClear: true,
            // placeholder: "-- Please choose --",
        });
    }

    

    centersCategoryDropdown();
    provincesCategoryDropdown();

    if($('#btnBack').length) {
        $('#btnBack').on('click', function() {
            window.history.back();
        });
    }

    if($('#modeOfPayment').length) {
        const mopValues = {
            hmo: 'HMO Provider',
            corporate: 'Company Name',
            insurance: 'Insurance Company',
            doctor: 'Doctor',
            doctor_dependent: 'Doctor Dependent',
            mmc_employee: 'Name of Employee',
            mmc_employee_dependent: 'MMC Employee Dependent',
        };

        $('#modeOfPayment').on('change', function() {
            if($(this).val() == 'hmo' && $(this).val() != "") {
                $('#mopHolder').hide();
                $('#mopTitle').text('');
                $('#mopOther').removeAttr('required');
                $('#mopCorp').removeAttr('required');
                $('#mopCorp').attr('disabled', 'disabled');
                $('#corpHolder').hide();
                $('#hmoHolder').show();
                $('#mopHMO').attr('required','required');
                $('#mopHMO').removeAttr('disabled');
                $('#mopHMO').select2({
                    allowClear: true,
                    placeholder: "-- Please choose --",
                });
            } else if($(this).val() == 'corporate' && $(this).val() != "") {
                $('#mopHolder').hide();
                $('#mopTitle').text('');
                $('#mopOther').removeAttr('required');
                $('#mopHMO').removeAttr('required');
                $('#mopHMO').attr('disabled', 'disabled');
                $('#hmoHolder').hide();
                $('#corpHolder').show();
                $('#mopCorp').attr('required','required');
                $('#mopCorp').removeAttr('disabled');
                $('#mopCorp').select2({
                    allowClear: true,
                    placeholder: "-- Please choose --",
                });
            } else if($(this).val() == 'philhealth') {
                $('#mopHolder').hide();
                $('#mopTitle').text('');
                $('#mopOther').removeAttr('required');
                $('#mopHMO').removeAttr('required');
                $('#hmoHolder').hide();
                $('#mopCorp').removeAttr('required');
                $('#corpHolder').hide();
                $('input[name="mopOther"]').val('');
                $('select[name="mopOther"]').val('');
            } else if($(this).val() != 'credit_card' && $(this).val() != "") {
                $('#mopHolder').show();
                $('#mopTitle').text(mopValues[$(this).val()]);
                $('#mopOther').attr('required','required');
                $('#mopHMO').removeAttr('required');
                $('#mopHMO').attr('disabled', 'disabled');
                $('#hmoHolder').hide();
                $('#mopCorp').removeAttr('required');
                $('#mopCorp').attr('disabled', 'disabled');
                $('#corpHolder').hide();
            } else {
                $('#mopHolder').hide();
                $('#mopTitle').text('');
                $('#mopOther').removeAttr('required');
                $('#mopHMO').removeAttr('required');
                $('#hmoHolder').hide();
                $('#mopCorp').removeAttr('required');
                $('#corpHolder').hide();
                $('input[name="mopOther"]').val('');
                $('select[name="mopOther"]').val('');
            }
        });
    }

    if($('#centers').length) {
        $('#centers').on('change', function() {
            if($(this).val()) {
                $('#services').removeAttr('disabled');
                $('#btn-add').removeAttr('disabled');
            } else {
                $('#services').attr('disabled', 'disabled');
                $('#btn-add').attr('disabled', 'disabled');
            }
            servicesCategoryDropdown($(this).val());
        });
    }

    if($('#province').length) {
        $('#province').on('change', function () {
            if($(this).val()) {
                $('#city').removeAttr('disabled');
            } else {
                $('#city').attr('disabled', 'disabled');
            }
            citiesCategoryDropdown($(this).val());
        });
    }

    if($('#services').length) {
        $('#services').on('select2:select', function() {
            if($(this).val()) {
                const selectedCenter = $('#centers').select2('data');
                const selectedService = $(this).select2('data');
                appendCenter(selectedCenter, selectedService);
                if($('.date-pick').length) {
                    const year = (new Date).getFullYear();
                    $('.date-pick').datepicker( {
                        minDate: 0,
                        maxDate: new Date(year, 11, 31)
                    });
                }
                $('#forCenterValidaiton').val('hasService');
                $('#multiNotes').show();
            }
        });
    }

    // if($('#btn-add').length) {
    //     $('#btn-add').on('click', function() {
    //         if($('#services').val()) {
    //             const selectedCenter = $('#centers').select2('data');
    //             const selectedService = $('#services').select2('data');
    //             appendCenter(selectedCenter, selectedService);
    //             if($('.date-pick').length) {
    //                 const year = (new Date).getFullYear();
    //                 $('.date-pick').datepicker( {
    //                     // changeMonth: true,
    //                     // changeYear: true,
    //                     minDate: 0,
    //                     maxDate: new Date(year, 11, 31)
    //                 });
    //             }
    //             $('#forCenterValidaiton').val('hasService');
    //         } else {
    //             alert('Please select a service.');
    //         }
    //     });
    // }

    if($('#displayCentersServices').length) {
        $(document).on('click', '.serve-delete', function() {
            $('#'+$(this).data('holder')).remove();
            // $("#centers").val('').change();
        });

        $(document).on('click', '.cent-delete', function() {
            $('.'+$(this).data('holder')).remove();
            // $("#centers").val('').change();
        });
    }

    if($('#seniorPWD').length) {
        $('#seniorPWD').on('click', function() {
            if($('input[name="seniorPWD"]:checked').val()) {
                $('.displayIDNo').show();
                $('.seniorPwdID').show();
                $('.seniorPwdIDBack').show();
                $('#idNumber').attr('required','required');
                $('#seniorPwdID').attr('required','required');
                $('#seniorPwdIDBack').attr('required','required');
            }
            else {
                $('.displayIDNo').hide();
                $('.seniorPwdID').hide();
                $('.seniorPwdIDBack').hide();
                $('#idNumber').removeAttr('required');
                $('#seniorPwdID').removeAttr('required');
                $('#seniorPwdIDBack').removeAttr('required');
            }
        });
    }

    // if($('#btnNext').length) {
    //     $('#btnNext').on('click', function() {
    //         alert('next!');
    //     });
    // }

    require('./screening-service.js');
    require('./screening-new.js');
    require('./patient-screening.js');

    if($('.date-pick').length) {
        const year = (new Date).getFullYear();
        $('.date-pick').datepicker( {
            // changeMonth: true,
            // changeYear: true,
            minDate: 0,
            maxDate: new Date(year, 11, 31)
        });
    }

    if($('#cancelBooking').length) {
        $('#cancelBooking').on('click', function() {
            if(confirm('Are you sure you want to cancel this booking?')) {
                window.location.href = $(this).data('link');
            }
        });
    }
});

function centersCategoryDropdown(selectedValue = null) {
    const el = $('#centers');
    const action = el.data('action');

    if(el.length){
        selectedValue = el.data('value') && !selectedValue ? el.data('value') : selectedValue;
        $.ajax({
            type: 'GET',
            url: action,
            data: {
                selectedValue
            }
        }).then(function (data) {
            el.html('<option disabled selected value>-- Select Centers --</option>');
            el.select2({
                data: data,
                allowClear: true,
                placeholder: "-- Select Centers --"
            });
        });
    }
}

function servicesCategoryDropdown(center = null) {
    const el = $('#services');
    const action = el.data('action');

    if(el.length){
        $.ajax({
            type: 'GET',
            url: action,
            data: {
                center
            }
        }).then(function (data) {
            el.html('<option disabled selected value>-- Select Service --</option>');
            el.select2({
                data: data,
                allowClear: true,
                placeholder: "-- Select Service --"
            });
        });
    }
}

function appendCenter(center, service) {
    let newHtml = '';

    let centerCount = $('#displayCentersServices .item-center').length;
    let centerExist = $('#displayCentersServices .ic-'+center[0].id).length;
    let serviceCount = $('#displayCentersServices .ic-'+center[0].id + ' .c-item').length;

    if(centerExist == 0) {
        newHtml += '<div class="col-12 col-md-6 mb-3 item-center ic-'+ center[0].id +'">';
        newHtml += '<ul class="list-group mb-3" id="center-'+ center[0].id +'" data-count="'+ centerCount +'">';

        newHtml += '<li class="list-group-item custom-active d-md-flex justify-content-between align-items-center">';
        newHtml += '<span class="center-title">'+center[0].text+'</span>';
        newHtml += '<input type="hidden" name="centers['+ centerCount +'][center_id]" value="'+ center[0].id +'">';
        newHtml += '<input type="hidden" name="centers['+ centerCount +'][name]" value="'+ center[0].text +'">';
        newHtml += '<span class="center-date">';
        newHtml += '<div class="form-row align-items-center">';
        newHtml += '<div class="col-auto">';
        newHtml += '<input type="text" name="centers['+ centerCount +'][preferred_date]" class="form-control date-pick" placeholder="Preferred Date" required autocomplete="off">';
        newHtml += '</div>';
        newHtml += '<div class="col-auto">';
        newHtml += '<button type="button" class="btn btn-danger btn-sm cent-delete" data-holder="ic-'+ center[0].id +'"><i class="fas fa-trash"></i></button>';
        newHtml += '<i class="fas fa-question-circle popUpNotif" data-toggle="modal" data-target="#exampleModal"></i>';
        newHtml += '</div>';
        newHtml += '</div>';
        newHtml += '</span>';
        newHtml += '</li>';

        newHtml += '<li class="list-group-item c-item d-flex justify-content-between align-items-center" id="service-'+ service[0].id +'">';
        newHtml += service[0].text;
        newHtml += '<input type="hidden" name="centers['+ centerCount +'][service]['+ serviceCount +'][service_id]" value="'+ service[0].id +'">';
        newHtml += '<input type="hidden" name="centers['+ centerCount +'][service]['+ serviceCount +'][name]" value="'+ service[0].text +'">';
        newHtml += '<span>';
        newHtml += '<button type="button" class="btn btn-danger btn-sm serve-delete" data-holder="service-'+ service[0].id +'"><i class="fas fa-trash"></i></button>';
        newHtml += '</span>';
        newHtml += '</li>';

        newHtml += '</ul>';
        newHtml += '</div>';

        $('#displayCentersServices').append(newHtml);
        // $("#centers").val(null).trigger("change");
    } else {
        const serviceExists = $('#center-'+center[0].id+ ' #service-' + service[0].id).length;
        const newCenterCount = $('#center-'+center[0].id).data('count');

        if(serviceExists == 0) {
            let newHtml = '';

            newHtml += '<li class="list-group-item c-item d-flex justify-content-between align-items-center" id="service-'+ service[0].id +'">';
            newHtml += service[0].text;
            newHtml += '<input type="hidden" name="centers['+ newCenterCount +'][service]['+ serviceCount +'][service_id]" value="'+ service[0].id +'">';
            newHtml += '<input type="hidden" name="centers['+ newCenterCount +'][service]['+ serviceCount +'][name]" value="'+ service[0].text +'">';
            newHtml += '<span>';
            newHtml += '<button type="button" class="btn btn-danger btn-sm serve-delete" data-holder="service-'+ service[0].id +'"><i class="fas fa-trash"></i></button>';
            newHtml += '</span>';
            newHtml += '</li>';

            $('#center-'+center[0].id).append(newHtml);
            // $("#centers").val(null).trigger("change");
        } else {
            alert('Service already selected. Please select another.');
        }
    }
}

function provincesCategoryDropdown(selectedValue = null) {
    const el = $('#province');
    const action = el.data('action');

    if(el.length){
        selectedValue = el.data('value') && !selectedValue ? el.data('value') : selectedValue;
        $.ajax({
            type: 'GET',
            url: action,
            data: {
                selectedValue
            }
        }).then(function (data) {
            el.html('<option disabled selected value>-- Select Province --</option>');
            el.select2({
                data: data,
                allowClear: true,
                placeholder: "-- Select Province --"
            });
        });
    }
}

function citiesCategoryDropdown(province = null) {
    const el = $('#city');
    const action = el.data('action');

    if(el.length){
        $.ajax({
            type: 'GET',
            url: action,
            data: {
                province
            }
        }).then(function (data) {
            el.html('<option disabled selected value>-- Select City --</option>');
            el.select2({
                data: data,
                allowClear: true,
                placeholder: "-- Select City --"
            });
        });
    }
}
