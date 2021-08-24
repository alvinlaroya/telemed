$('#btn-ps').on('click', function()  {
    validateQuestion1To3();
})

$('#btn-ps2').on('click', function() {
    validateQuestion4To6();
});

$('#btn-ps3').on('click', function() {
    validateQuestion7To11();
});

$('input[name="swabRTPCR"]').on('change', function() {
    if($(this).val() == 1) {
        $('#covid19-screening').show();
        $('#posCovidRTPCR').show();
        $('#negCovidRTPCR').hide();
    } else {
        $('#covid19-screening').hide();
        $('#posCovidRTPCR').hide();
        $('#negCovidRTPCR').show();
    }
});

$('input[name="hospitalizedPneu"]').on('change', function() {
    if($(this).val() == 1) {
        $('#hadPneumonia').show();
    } else {
        $('#hadPneumonia').hide();
    }
});

function disableRadio(name) {
    return $('input[name="'+name+'"]').attr('disabled', 'disabled');
}

function validateQuestion1To3() {
    const respiratory = $('input[name="respiratory"]:checked').val();
    const fever = $('input[name="fever"]:checked').val();
    const influenza = $('input[name="influenza"]:checked').val();

    if(respiratory && fever && influenza) {
        if(respiratory == 1 && fever == 1 && influenza == 1) {
            // $('#covid19-screening').show();
            // disableRadio('respiratory');
            // disableRadio('fever');
            // disableRadio('influenza');
            // $('#btn-ps1-1').removeClass('d-none');
            window.location.href = $('#emergencyLink').val();
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
        alert('Please select answer(s)');
    }

}

function validateQuestion4To6() {
    const swabRTPCR = $('input[name="swabRTPCR"]:checked').val();
    const covid19Quarantine = $('input[name="covid19Quarantine"]:checked').val();
    const covid19PCR = $('input[name="covid19PCR"]:checked').val();
    const covid19Symptoms = $('input[name="covid19Symptoms"]:checked').val();
    const antiBodyTest = $('input[name="antiBodyTest"]:checked').val();
    const rapidTest = $('input[name="rapidTest"]:checked').val();
    const hospitalizedPneu = $('input[name="hospitalizedPneu"]:checked').val();
    const pneumoniaQuarantine = $('input[name="pneumoniaQuarantine"]:checked').val();
    const pneumoniaPCR = $('input[name="pneumoniaPCR"]:checked').val();
    const pneumoniaSymptoms = $('input[name="pneumoniaSymptoms"]:checked').val();
    const hospitalizedCovid = $('input[name="hospitalizedCovid"]:checked').val();

    const complete14DayQ = $('input[name="complete14DayQ"]:checked').val();
    const negPCRResultsDay14 = $('input[name="negPCRResultsDay14"]:checked').val();
    const noRespSymp = $('input[name="noRespSymp"]:checked').val();

    const negComplete14day = $('input[name="negComplete14day"]:checked').val();
    const negNoRespSymp = $('input[name="negNoRespSymp"]:checked').val();

    if(swabRTPCR && rapidTest && hospitalizedPneu && hospitalizedCovid) {

        if(antiBodyTest == 1) {
            window.location.href = $('#emergencyLink').val();
        }

        if(swabRTPCR == 1) {
            if(covid19PCR && covid19Quarantine && covid19Symptoms) {
                if(covid19PCR == 1 && covid19Quarantine == 1 && covid19Symptoms == 0) {
                    console.log('continue');
                } else {
                    window.location.href = $('#emergencyLink').val();
                }
            } else {
                console.log('Please select answer(s)');
            }
        }

        if(pneumoniaPCR && pneumoniaQuarantine && pneumoniaSymptoms) {
            if(pneumoniaPCR == 1 && pneumoniaQuarantine == 1 && pneumoniaSymptoms == 0) {
                console.log('continue');
            } else {
                alert('hello 1');
                window.location.href = $('#emergencyLink').val();
            }
        }

        if(complete14DayQ && negPCRResultsDay14 && noRespSymp) {
            if(complete14DayQ == 1 && negPCRResultsDay14 == 1 && noRespSymp == 1) {
                console.log('continue');
            } else {
                window.location.href = $('#emergencyLink').val();
            }
        }

        if(negComplete14day && negNoRespSymp) {
            if(negComplete14day == 1 && negNoRespSymp == 1) {
                console.log('continue');
            }
            else {
                window.location.href = $('#emergencyLink').val();
            }
        }

        if(rapidTest == 1 && hospitalizedPneu == 1 && hospitalizedCovid == 1) {
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
    const hhMemSick = $('input[name="hhMemSick"]:checked').val();
    const hhMemDiagnosed = $('input[name="hhMemDiagnosed"]:checked').val();
    const residenceTrans = $('input[name="residenceTrans"]:checked').val();
    const travelled = $('input[name="travelled"]:checked').val();
    const exposure = $('input[name="exposure"]:checked').val();

    if(hhMemSick && hhMemDiagnosed && residenceTrans && travelled && exposure) {
        if(hhMemSick == 1 && hhMemDiagnosed == 1 && residenceTrans == 1 && travelled == 1 && exposure == 1) {
            window.location.href = $('#emergencyLink').val();
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
