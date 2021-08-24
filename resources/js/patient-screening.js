const patientScreeningForm = $('.patientScreeningForm');
const validator = patientScreeningForm.length && patientScreeningForm.validate({
    focusInvalid: false,
    invalidHandler: function(form, validator) {

        if (!validator.numberOfInvalids())
            return;

        $('html, body').animate({
            scrollTop: ($(validator.errorList[0].element).offset().top - 100)
        }, 400);

    }
});
const loadingText = 'Please wait...';
const nextText = 'Next';
const saveText = 'Submit';
let redirecting = false;
const btnIntro = patientScreeningForm.find('button.btn-intro');
const btnHasCompanion = patientScreeningForm.find('button.btn-hasCompanion');
const btnCompanionDetails = patientScreeningForm.find('button.btn-companionDetails');
const btnPatientQuestion = patientScreeningForm.find('button.btn-patientQuestion');
const btnSetOne = patientScreeningForm.find('button.btn-setOne');
let wasStable = false;
const btnSetTwo = patientScreeningForm.find('button.btn-setTwo');
const btnSetThree = patientScreeningForm.find('button.btn-setThree');
const questionOne = patientScreeningForm.find('input[name="screening[patient][1][answer]"]');
const respiratorySymptoms = patientScreeningForm.find('input[name="screening[patient][1][child][1][answer][]"]');
const fever38 = patientScreeningForm.find('input[name="screening[patient][1][child][4][answer]"]');
const questionOneChildTwo = patientScreeningForm.find('input[name="screening[patient][1][child][2][answer]"]');

const processBtn = (btn, type = '') => {
    if(type === 'enable'){
        btn.prop('disabled', false).text(nextText);
    }else{
        btn.prop('disabled', true).text(loadingText);
    }
}

const introductionContainer = patientScreeningForm.find('.introduction');
const companionContainer = patientScreeningForm.find('.companion');
const companionDetailsContainer = patientScreeningForm.find('.companion-details');
const patientQuestionsContainer = patientScreeningForm.find('.patient-questions');

btnIntro.on('click', function(){
    processBtn($(this));
    if(validator.form()){
        processBtn($(this), 'enable');
        $(this).hide();
        btnHasCompanion.show();
        introductionContainer.hide();
        companionContainer.show();
        localStorage.removeItem('consult_patient_screening');
    }else{
        processBtn($(this), 'enable');
    }
});

btnHasCompanion.on('click', function(){
    processBtn($(this));
    if(validator.form()){
        const hasCompanion = patientScreeningForm.find('input[name="screening[has_companion]"]:checked');
        processBtn($(this), 'enable');
        $(this).hide();
        if(hasCompanion.val() == 'Yes'){
            btnCompanionDetails.show();
            companionContainer.hide();
            companionDetailsContainer.show();
        }else{
            btnSetOne.show();
            companionContainer.hide();
            patientQuestionsContainer.show();
            questionOne.eq(1).prop('checked', true).trigger('change');
        }
    }else{
        processBtn($(this), 'enable');
    }
});

btnCompanionDetails.on('click', function(){
    processBtn($(this));
    if(validator.form()){
        processBtn($(this), 'enable');
        $(this).hide();
        btnSetOne.show();
        companionDetailsContainer.hide();
        patientQuestionsContainer.show();
        questionOne.eq(1).prop('checked', true).trigger('change');
    }else{
        processBtn($(this), 'enable');
    }
});

const gotoER = (btn = null) => {
    if(redirecting === false){
        redirecting = true;
        const patientForm = $('#patientForm');
        const patientData = patientForm.length ? patientForm.serialize() + '&' : ($('input[name="patient_data"]').length ? $('input[name="patient_data"]').val() + '&' : '');
        const from = $('.appointmentForm').length ? 'appointment' : 'booking';
        window.axios.post(patientScreeningForm.attr('data-save'), patientData + patientScreeningForm.serialize() + `&referralType=ER&from=${from}&center=Emergency Room`)
        .then(resp => {
            if(resp.status === 200){
                const data = resp.data;
                if(data.msg === 'success'){
                    redirecting = false;
                    localStorage.setItem('appointment_patient_screening', data.data);
                    window.location.href = $('#emergencyLink').val();
                }else{
                    console.log('Something went wrong!');
                    // window.location.href = $('#emergencyLink').val();
                }
                // processBtn(btn, 'enable');
            }
        })
        .catch(errors => {
            console.log(errors);
        });
    }
}

const referToTele = () => {
    if($('.appointmentForm').length){
        enableStep('step3');
    }else{
        if(redirecting === false){
            redirecting = true;
            const patientForm = $('#patientForm');
            const patientData = patientForm.length ? patientForm.serialize() + '&' : ($('input[name="patient_data"]').length ? $('input[name="patient_data"]').val() + '&' : '');
            window.axios.post(patientScreeningForm.attr('data-save'), patientData + patientScreeningForm.serialize() + `&referralType=Teleconsult&from=booking&center=Online Consultation`)
            .then(resp => {
                if(resp.status === 200){
                    const data = resp.data;
                    if(data.msg === 'success'){
                        redirecting = false;
                        localStorage.setItem('consult_patient_screening', data.data);
                        window.location.href = $('#teleConsult').val();
                    }else{
                        console.log('Something went wrong!');
                        // window.location.href = $('#teleConsult').val();
                    }
                    // processBtn(btn, 'enable');
                }
            })
            .catch(errors => {
                console.log(errors);
            });
        }
    }
}

const proceedTo = () => {
    const hasCompanion = patientScreeningForm.find('input[name="screening[has_companion]"]:checked');
    const patientContainer = patientScreeningForm.find('.patient-questions');
    const companionContainer = patientScreeningForm.find('.companion-questions');
    if(hasCompanion.val() == 'Yes'){
        require('./patient-screening-companion.js');
        patientContainer.hide();
        processBtn(btnSetTwo, 'enable');
        btnSetTwo.hide();
        btnSetThree.show();
        companionContainer.show();
        var compaBtn = patientScreeningForm.find('input[name="screening[companion][1][answer]"]');
        compaBtn.eq(1).prop('checked', true).trigger('change');

    }else{
        if($('.appointmentForm').length){
            enableStep('step3');
        }else{
            patientScreeningForm.submit();
        }
    }
}

questionOne.on('change', function(){
    if($(this).val() != 'Yes'){
        btnSetTwo.show();
        btnSetOne.hide();
        $(this).parents('li').eq(0).find('ul input[type="radio"], ul input[type="checkbox"]').attr('disabled', true);
        $(this).parents('li').eq(0).find('ul input').attr('required', false);
        $(this).parents('li').eq(0).find('ul .question').removeClass('required');
        $(this).parents('li').eq(0).find('ul').find('input').prop('checked', false);
        $(this).parents('li').eq(0).find('ul label.error').remove();
        respiratorySymptoms.parents('li').eq(0).next('li').hide();
        $(this).parents('li').eq(0).next('li').show();
    }else{
        btnSetOne.show();
        btnSetTwo.hide();
        $(this).parents('li').eq(0).find('ul input[type="radio"], ul input[type="checkbox"]').attr('disabled', false);
        $(this).parents('li').eq(0).find('ul input').attr('required', true);
        $(`input[name="screening[patient][1][child][1][answer][]"]`).attr('required', false);
        $(`input[name="screening[patient][1][child][3][answer][]"]`).attr('required', false);
        $(this).parents('li').eq(0).find('ul .question').addClass('required');
        $(`input[name="screening[patient][1][child][1][answer][]"]`).parent().parent().removeClass('required');
        $(`input[name="screening[patient][1][child][3][answer][]"]`).parent().parent().removeClass('required');
        $(this).parents('li').eq(0).next('li').hide();
        $(this).parents('li').eq(0).next('li').next('li').hide();
        $(this).parents('li').eq(0).next('li').next('li').next('li').children('.question').eq(0).hide();
        // Reset other questions value
        $(this).parents('li').eq(0).siblings('li').find('ul').find('input').attr('required', false);
        $(this).parents('li').eq(0).siblings('li').find('ul .question').removeClass('required');
        $(this).parents('li').eq(0).siblings('li').find('input').prop('checked', false);
        $(this).parents('li').eq(0).siblings('li').find('ul label.error').remove();
        $(this).parents('li').eq(0).siblings('li').find('.hidden').hide();
    }
});

respiratorySymptoms.on('change', function(el){
    if($(`input[name="${el.currentTarget.name}"]:checked`).length > 0){
        $(this).parents('li').eq(0).next('li').show();
    }else{
        $(this).parents('li').eq(0).next('li').hide();
    }
});

fever38.on('change', function(el) {
    if($(this).val() != 'Yes') {
        btnSetTwo.show();
        btnSetOne.hide();
        $(`input[name="screening[patient][1][question]"]`).parents('li').eq(0).next('li').show();
    } else {
        btnSetTwo.hide();
        btnSetOne.show();
        $(`input[name="screening[patient][1][question]"]`).parents('li').eq(0).next('li').hide();
    }
});

questionOneChildTwo.on('change', function(){
    if(wasStable){
        if($(this).val() == 'Worsening'){
            $(this).parents('li').eq(1).next('li').hide();
        }
    }
});

btnSetOne.on('click', function(){
    processBtn($(this));
    if(validator.form()){
        const questionOneChildTwoChecked = patientScreeningForm.find('input[name="screening[patient][1][child][2][answer]"]:checked');
        if(questionOneChildTwoChecked.val() == 'Worsening'){
            gotoER($(this));
        }else{
            // wasStable = true;
            // questionOne.parents('li').eq(0).next('li').show();
            referToTele();
            // processBtn($(this), 'enable');
        }
    }else{
        processBtn($(this), 'enable');
        console.log('Please answer all questions!');
    }
});

const questionTwo = patientScreeningForm.find('input[name="screening[patient][2][answer]"]');
const questionTwoChildOne = patientScreeningForm.find('input[name="screening[patient][2][child][1][answer]"]');
const questionTwoChildOneChildOne = patientScreeningForm.find('input[name="screening[patient][2][child][1][child][1][answer]"]');
const questionThree = patientScreeningForm.find('input[name="screening[patient][3][answer]"]');
const questionFour = patientScreeningForm.find('input[name="screening[patient][4][answer]"]');

questionTwo.on('change', function(){
    if($(this).val() != 'Yes'){
        $(this).parents('li').eq(0).find('ul input').attr('required', false);
        $(this).parents('li').eq(0).find('ul .question').removeClass('required');
        $(this).parents('li').eq(0).find('ul').find('input').prop('checked', false);
        $(this).parents('li').eq(0).find('ul label.error').remove();
        $(this).parents('li').eq(0).children('ul').eq(0).hide();
        $(this).parents('li').eq(0).next('li').show();
        $(this).parents('li').eq(0).next('li').next('li').children('.question').eq(0).hide();
        $(this).parents('li').eq(0).next('li').next('li').children('ul').eq(0).hide();
    }else{
        $(this).parents('li').eq(0).find('ul input').attr('required', true);
        $(this).parents('li').eq(0).find('ul .question').addClass('required');
        $(this).parents('li').eq(0).children('ul').eq(0).show().find('ul').eq(0).hide();
        $(this).parents('li').eq(0).next('li').hide();
        $(this).parents('li').eq(0).next('li').next('li').children('.question').eq(0).hide();

        // Reset other questions value
        $(this).parents('li').eq(0).nextAll('li').find('ul').find('input').attr('required', false);
        $(this).parents('li').eq(0).nextAll('li').find('ul .question').removeClass('required');
        $(this).parents('li').eq(0).nextAll('li').find('input').prop('checked', false);
        $(this).parents('li').eq(0).nextAll('li').find('label.error').remove();
        $(this).parents('li').eq(0).nextAll('li').find('.hidden').hide();
    }
});

questionTwoChildOne.on('change', function(){
    const questionFourChilds = $(this).parents('li').eq(1).next('li').next('li').children('ul').eq(0);
    if($(this).val() == 'Yes'){
        questionFourChilds.find('input').attr('required', true);
        questionFourChilds.find('.question').addClass('required');
        questionFourChilds.show();
        $(this).parents('li').eq(1).next('li').hide().children('.question').eq(0).find('input').prop('checked', false);
        $(this).parents('li').eq(1).next('li').next('li').children('.question').eq(0).hide().find('input').prop('checked', false);
        $(this).parents('li').eq(0).children('ul').eq(0).find('input').prop('checked', false);
        $(this).parents('li').eq(0).children('ul').eq(0).hide();
    }else{
        questionFourChilds.hide();
        $(this).parents('li').eq(0).children('ul').eq(0).show();
    }
});

questionTwoChildOneChildOne.on('change', function(){
    if($(this).val() == 'Yes'){
        $(this).parents('li').eq(2).next('li').show();
    }else{
        $(this).parents('li').eq(2).next('li').hide();
    }
});

questionThree.on('change', function(){
    if($(this).val() != 'Yes'){
        $(this).parents('li').eq(0).find('ul input').attr('required', false);
        $(this).parents('li').eq(0).find('ul .question').removeClass('required');
        $(this).parents('li').eq(0).find('ul').find('input').prop('checked', false);
        $(this).parents('li').eq(0).find('ul label.error').remove();
        $(this).parents('li').eq(0).children('ul').eq(0).hide();
        $(this).parents('li').eq(0).next('li').children('.question').eq(0).show();
    }else{
        $(this).parents('li').eq(0).find('ul input').attr('required', true);
        $(this).parents('li').eq(0).find('ul .question').addClass('required');
        $(this).parents('li').eq(0).children('ul').eq(0).show();
        $(this).parents('li').eq(0).next('li').children('.question').eq(0).hide();

        // Reset other questions value
        $(this).parents('li').eq(0).nextAll('li').find('ul').find('input').attr('required', false);
        $(this).parents('li').eq(0).nextAll('li').find('ul .question').removeClass('required');
        $(this).parents('li').eq(0).nextAll('li').find('input').prop('checked', false);
        $(this).parents('li').eq(0).nextAll('li').find('label.error').remove();
        $(this).parents('li').eq(0).nextAll('li').find('.hidden').hide();
    }
});

const questionFourChildOne = patientScreeningForm.find('input[name="screening[patient][4][child][1][answer]"]');
const questionFourChildOneChildTwo = patientScreeningForm.find('input[name="screening[patient][4][child][1][child][2][answer]"]');
const questionFourChildTwo = patientScreeningForm.find('input[name="screening[patient][4][child][2][answer]"]');
const questionFourChildTwoChildOne = patientScreeningForm.find('input[name="screening[patient][4][child][2][child][1][answer]"]');
const questionFourChildTwoChildOneChildOne = patientScreeningForm.find('input[name="screening[patient][4][child][2][child][1][child][1][answer]"]');

questionFour.on('change', function(){
    if($(this).val() != 'Yes'){
        $(this).parents('li').eq(0).find('input').attr('required', false);
        $(this).parents('li').eq(0).find('ul .question').removeClass('required');
        $(this).parents('li').eq(0).find('ul').find('input').prop('checked', false);
        $(this).parents('li').eq(0).find('ul label.error').remove();
        $(this).parents('li').eq(0).children('ul').eq(0).hide();
    }else{
        $(this).parents('li').eq(0).find('input').attr('required', true);
        $(this).parents('li').eq(0).find('ul .question').addClass('required');
        $(this).parents('li').eq(0).children('ul').eq(0).show();
    }
});

questionFourChildOne.on('change', function(){
    if($(this).val() != 'No'){
        $(this).parents('li').eq(0).children('ul').show();
    }else{
        $(this).parents('li').eq(0).children('ul').hide();
    }
});

questionFourChildOneChildTwo.on('change', function(){
    if($(this).val() != 'Negative'){
        $(this).parents('li').eq(0).children('ul').show();
    }else{
        $(this).parents('li').eq(0).children('ul').hide();
    }
});

questionFourChildTwo.on('change', function(){
    if($(this).val() != 'No'){
        $(this).parents('li').eq(0).children('ul').eq(0).show();
    }else{
        $(this).parents('li').eq(0).children('ul').eq(0).hide();
    }
});

questionFourChildTwoChildOne.on('change', function(){
    if($(this).val() != 'Negative both IgG/IgM'){
        $(this).parents('li').eq(0).children('ul').eq(0).show();
    }else{
        $(this).parents('li').eq(0).children('ul').eq(0).hide();
    }
});

questionFourChildTwoChildOneChildOne.on('change', function(){
    if($(this).val() != 'Yes'){
        $(this).parents('li').eq(0).children('ul').show();
    }else{
        $(this).parents('li').eq(0).children('ul').hide();
    }
});

btnSetTwo.on('click', function(){
    processBtn($(this));
    if(validator.form()){
        const questionTwoChildOneChecked = patientScreeningForm.find('input[name="screening[patient][2][child][1][answer]"]:checked');
        const questionTwoChildOneChildOneChecked = patientScreeningForm.find('input[name="screening[patient][2][child][1][child][1][answer]"]:checked');
        const questionThreeChildOneChecked = patientScreeningForm.find('input[name="screening[patient][3][child][1][answer]"]:checked');
        const questionThreeChildTwoChecked = patientScreeningForm.find('input[name="screening[patient][3][child][2][answer]"]:checked');
        const questionFourChecked = patientScreeningForm.find('input[name="screening[patient][4][answer]"]:checked');
        const questionFourChildOneChecked = patientScreeningForm.find('input[name="screening[patient][4][child][1][answer]"]:checked');
        const questionFourChildOneChildTwoChecked = patientScreeningForm.find('input[name="screening[patient][4][child][1][child][2][answer]"]:checked');
        const questionFourChildOneChildTwoChildOneChecked = patientScreeningForm.find('input[name="screening[patient][4][child][1][child][2][child][1][answer]"]:checked');
        const questionFourChildOneChildTwoChildTwoChecked = patientScreeningForm.find('input[name="screening[patient][4][child][1][child][2][child][2][answer]"]:checked');
        const questionFourChildTwoChecked = patientScreeningForm.find('input[name="screening[patient][4][child][2][answer]"]:checked');
        const questionFourChildTwoChildOneChecked = patientScreeningForm.find('input[name="screening[patient][4][child][2][child][1][answer]"]:checked');
        const questionFourChildTwoChildOneChildOneChecked = patientScreeningForm.find('input[name="screening[patient][4][child][2][child][1][child][1][answer]"]:checked');
        const questionFourChildTwoChildOneChildOneChildOneChecked = patientScreeningForm.find('input[name="screening[patient][4][child][2][child][1][child][1][child][1][answer]"]:checked');
        // if(questionTwoChildOneChecked.val() == 'No'){
        //     referToTele();
        // }
        if(questionTwoChildOneChildOneChecked.val() == 'No'){
            referToTele();
        }
        if(questionThreeChildOneChecked.val() == 'Yes' && questionThreeChildTwoChecked.val() == 'Yes'){
            proceedTo();
        }else if(questionThreeChildOneChecked.val() == 'No' || questionThreeChildTwoChecked.val() == 'No'){
            referToTele();
        }
        if(questionFourChecked.val() == 'No'){
            proceedTo();
        }
        if(questionFourChildOneChecked.val() == 'No' && questionFourChildTwoChecked.val() == 'No'){
            proceedTo();
        }
        if(questionFourChildTwoChecked.val() == 'No' && questionFourChildOneChildTwoChecked.val() == 'Negative'){
            proceedTo();
        }
        if(questionFourChildOneChildTwoChildOneChecked.val() == 'Yes' && questionFourChildOneChildTwoChildTwoChecked.val() == 'Yes'){
            proceedTo();
        }else if(questionFourChildOneChildTwoChildOneChecked.val() == 'No' || questionFourChildOneChildTwoChildTwoChecked.val() == 'No'){
            referToTele();
        }
        if(questionFourChildTwoChildOneChecked.val() == 'Negative both IgG/IgM'){
            proceedTo();
        }
        if(questionFourChildTwoChildOneChildOneChecked.val() == 'Yes'){
            proceedTo();
        }
        if(questionFourChildTwoChildOneChildOneChildOneChecked.val() == 'Yes'){
            proceedTo();
        }else if(questionFourChildTwoChildOneChildOneChildOneChecked.val() == 'No'){
            referToTele();
        }
    }else{
        processBtn($(this), 'enable');
        console.log('Please answer all questions!');
    }
});
