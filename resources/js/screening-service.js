const serviceScreeningForm = $('.serviceScreeningForm');
const fallriskScreeningForm = $('.fallriskScreeningForm');

$('.serviceScreeningForm .btn-s1').on('click', function(){
    serviceScreening($(this));
});

$('.serviceScreeningForm .btn-s2').on('click', function(){
    serviceScreening2($(this));
});

$('.fallriskScreeningForm button[type="submit"]').on('click', function(e){
    fallriskScreening(e);
});

function disableRadio(name) {
    return $('input[name*="'+name+'"]:not(:checked)').attr('disabled', true);
}

function serviceScreening(btn){
    const q1 = serviceScreeningForm.find('input[name="screening[0][answer]"]:checked');
    if(q1.prop('checked')){
        if(q1.val() == '1'){
            window.location.href = $('#emergencyLink').val();
        }else{
            btn.hide();
            disableRadio('screening[0][answer]');
            serviceScreeningForm.find('.service-q-2-3').show();
            serviceScreeningForm.find('.btn-s2').removeClass('d-none');
        }
    }else{
        alert('Please select answer(s)');
    }
}

function serviceScreening2(btn){
    const q2 = serviceScreeningForm.find('input[name="screening[1][answer]"]:checked');
    const q3 = serviceScreeningForm.find('input[name="screening[2][answer]"]:checked');

    if(q2.prop('checked') && q3.prop('checked')){
        disableRadio('screening[1][answer]');
        disableRadio('screening[2][answer]');
        btn.hide();
        serviceScreeningForm.find('.btn-submit').removeClass('d-none');
        if(q2.val() == '1' || q3.val() == '1'){
            serviceScreeningForm.find('.service-yes').show();
        }else if(q2.val() == '0' && q3.val() == '0'){
            serviceScreeningForm.find('.service-no').show();
        }
    }else{
        alert('Please select answer(s)');
    }
}

function fallriskScreening(event){
    const q1 = fallriskScreeningForm.find('input[name="fallrisk[0][answer]"]:checked');
    const q2 = fallriskScreeningForm.find('input[name="fallrisk[1][answer]"]:checked');
    const q3 = fallriskScreeningForm.find('input[name="fallrisk[2][answer]"]:checked');

    if(!q1.prop('checked') || !q2.prop('checked') || !q3.prop('checked')){
        event.preventDefault();
        alert('Please select answer(s)');
    }
}
