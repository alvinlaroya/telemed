let isRedirecting = false;

$('#btn-ps').on('click', function()  {
    validateQuestion1To3();
})

$('#btn-ps2').on('click', function() {
    validateQuestion4To6();
});

$('#btn-ps3').on('click', function() {
    validateQuestion7To11();
});

$('input[name*="swabRTPCR"]').on('change', function() {
    if($(this).val() == 'p') {
        $('#covid19-screening').show();
        $('.posCovidRTPCR').show();
        $('.negCovidRTPCR').hide();
    } else {
        $('#covid19-screening').hide();
        $('.posCovidRTPCR').hide();
        $('.negCovidRTPCR').show();
    }
});

$('input[name*="hospitalizedPneu"]').on('change', function() {
    if($(this).val() == 1) {
        $('#hadPneumonia').show();
    } else {
        $('#hadPneumonia').hide();
    }
});

function disableRadio(name) {
    return $('input[name*="'+name+'"]:not(:checked)').attr('disabled', true);
}

function validateQuestion1To3() {
    const respiratory = $('input[name*="respiratory"]:checked');
    const fever = $('input[name*="fever"]:checked');
    const influenza = $('input[name*="influenza"]:checked');

    if(respiratory.prop('checked') && fever.prop('checked') && influenza.prop('checked')) {
        if(respiratory.val() == 1 && fever.val() == 1 && influenza.val() == 1) {
            // $('#covid19-screening').show();
            // disableRadio('respiratory');
            // disableRadio('fever');
            // disableRadio('influenza');
            // $('#btn-ps1-1').removeClass('d-none');
            emergencyDepartment();
        }
        else {
            disableRadio('respiratory');
            disableRadio('fever');
            disableRadio('influenza');
            $('#covid19-screening').hide();
            $('.question-4-6').show();
            $('#btn-ps2').removeClass('d-none');
        }
        $('#btn-ps').hide();
    } else {
        // console.log($('#screeningForm input[type="radio"]'));
        alert('Please select answer(s)');
    }

}

function validateQuestion4To6() {
    const swabRTPCR = $('input[name*="swabRTPCR"]:checked');
    const covid19Quarantine = $('input[name*="covid19Quarantine"]:checked');
    const covid19PCR = $('input[name*="covid19PCR"]:checked');
    const covid19Symptoms = $('input[name*="covid19Symptoms"]:checked');
    const antiBodyTest = $('input[name*="antiBodyTest"]:checked');
    const rapidTest = $('input[name*="rapidTest"]:checked');
    const hospitalizedPneu = $('input[name*="hospitalizedPneu"]:checked');
    const pneumoniaQuarantine = $('input[name*="pneumoniaQuarantine"]:checked');
    const pneumoniaPCR = $('input[name*="pneumoniaPCR"]:checked');
    const pneumoniaSymptoms = $('input[name*="pneumoniaSymptoms"]:checked');
    const hospitalizedCovid = $('input[name*="hospitalizedCovid"]:checked');

    const complete14DayQ = $('input[name*="complete14DayQ"]:checked');
    const negPCRResultsDay14 = $('input[name*="negPCRResultsDay14"]:checked');
    const noRespSymp = $('input[name*="noRespSymp"]:checked');

    const negComplete14day = $('input[name*="negComplete14day"]:checked');
    const negNoRespSymp = $('input[name*="negNoRespSymp"]:checked');

    if(swabRTPCR.prop('checked') && rapidTest.prop('checked') && hospitalizedPneu.prop('checked') && hospitalizedCovid.prop('checked')) {

        if(antiBodyTest.val() == 1) {
            emergencyDepartment();
        }

        if(swabRTPCR.val() == 'p') {
            if(covid19PCR.prop('checked') && covid19Quarantine.prop('checked') && covid19Symptoms.prop('checked')) {
                if(covid19PCR.val() == 1 && covid19Quarantine.val() == 1 && covid19Symptoms.val() == 0) {
                    console.log('continue');
                } else {
                    emergencyDepartment();
                }
            } else {
                console.log('Please select answer(s)');
            }
        }

        if(pneumoniaPCR.prop('checked') && pneumoniaQuarantine.prop('checked') && pneumoniaSymptoms.prop('checked')) {
            if(pneumoniaPCR.val() == 1 && pneumoniaQuarantine.val() == 1 && pneumoniaSymptoms.val() == 0) {
                console.log('continue');
            } else {
                // alert('hello 1');
                emergencyDepartment();
            }
        }

        if(complete14DayQ.prop('checked') && negPCRResultsDay14.prop('checked') && noRespSymp.prop('checked')) {
            if(complete14DayQ.val() == 1 && negPCRResultsDay14.val() == 1 && noRespSymp.val() == 1) {
                console.log('continue');
            } else {
                emergencyDepartment();
            }
        }

        if(negComplete14day.prop('checked') && negNoRespSymp.prop('checked')) {
            if(negComplete14day.val() == 1 && negNoRespSymp.val() == 1) {
                console.log('continue');
            }
            else {
                emergencyDepartment();
            }
        }

        if(rapidTest.val() == 1 && hospitalizedPneu.val() == 1 && hospitalizedCovid.val() == 1) {
            $('#screening-4-6').show();
            $('.question-7-11').show();
        }
        else {
            $('#screening-4-6').hide();
            $('.question-7-11').show();
        }
        disableRadio('swabRTPCR');
        disableRadio('rapidTest');
        disableRadio('hospitalizedPneu');
        disableRadio('hospitalizedCovid');

        $('#btn-ps2').hide();
        $('#btn-ps3').removeClass('d-none');
    } else {
        alert('Please select answer(s)');
    }

}

function validateQuestion7To11() {
    const hhMemSick = $('input[name*="hhMemSick"]:checked');
    const hhMemDiagnosed = $('input[name*="hhMemDiagnosed"]:checked');
    const residenceTrans = $('input[name*="residenceTrans"]:checked');
    const travelled = $('input[name*="travelled"]:checked');
    const exposure = $('input[name*="exposure"]:checked');

    if(hhMemSick.prop('checked') && hhMemDiagnosed.prop('checked') && residenceTrans.prop('checked') && travelled.prop('checked') && exposure.prop('checked')) {
        if(hhMemSick.val() == 1 && hhMemDiagnosed.val() == 1 && residenceTrans.val() == 1 && travelled.val() == 1 && exposure.val() == 1) {
            emergencyDepartment();
        }
        else {
            // window.location.href = $('#appointmentLink').val();
            enableStep('step3')
        }
        $('#btn-ps3').hide();
    } else {
        alert('Please select answer(s)');
    }
}

function emergencyDepartment()
{
    if(isRedirecting === false){
        isRedirecting = true;
        $('.screeningButtons button').attr('disabled', true).text('Please wait... Redirecting to Emergency Department');
        const patientForm = $('#patientForm');
        const screeningForm = $('#screeningForm');
        window.axios.post(screeningForm.attr('action'), patientForm.serialize() + '&' + screeningForm.serialize())
        .then(resp => {
            if(resp.status === 200){
                const data = resp.data;
                if(data.msg === 'success'){
                    isRedirecting = false;
                    localStorage.setItem('appointment_patient_screening', data.data);
                    window.location.href =$('#emergencyLink').val();
                }else{
                    console.log('Something went wrong!');
                }
            }
        })
        .catch(errors => {
            console.log(errors);
        });
    }
    // window.location = $('#emergencyLink').val();
}
