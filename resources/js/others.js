import Axios from "axios";

$(document).ready(() => {

    if($('#numOfTrans').length) {
        $('#numOfTrans').rCounter({
            duration: 30
        });
    }

    if($('#completeTrans').length) {
        $('#completeTrans').rCounter({
            duration: 30
        });
    }

    if($('#monthTotal').length) {
        $('#monthTotal').rCounter({
            duration: 30
        });
        // animateValue("monthTotal", 1, $('#monthTotal').data('value'), 1500);
    }

    const token = document.head.querySelector('meta[name="csrf-token"]');
    const wyswygUploadImageUrl = document.head.querySelector('meta[name="wyswyg-upload-image"]');

    if($('#filterCenter').length) {
        $('#filterCenter').select2({
            allowClear: true,
            placeholder: "-- Filter Center --"
        });
    }

    if($('#services').length) {
        $('#services').select2({
            allowClear: true,
            placeholder: "-- Select Service --",
            // multiple: true,
        });
    }

    if($('.date-pick').length) {
        const year = (new Date).getFullYear();

        $('.date-pick').datepicker( {
            changeMonth: true,
            changeYear: true,
            maxDate: new Date(year, 11, 31)
        });
    }
    // Initializations
    if(document.querySelector('.wysiwyg')){
        var allEditors = document.querySelectorAll('.wysiwyg');
        for (var i = 0; i < allEditors.length; ++i) {
            ClassicEditor.create( allEditors[i], {
                toolbar: {
					items: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'alignment', 'indent', 'outdent', '|', 'imageUpload', 'blockQuote', 'insertTable', 'mediaEmbed', 'undo', 'redo' ]
				},
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    ]
                },
                image: {
                    toolbar: [ 'imageTextAlternative', '|', 'imageStyle:full', 'imageStyle:side', 'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight' ],
                    styles: [
                        'full', 'side', 'alignLeft', 'alignCenter', 'alignRight'
                    ]
                },
                simpleUpload: {
                    uploadUrl: wyswygUploadImageUrl.content,
                    headers: {
                        'X-CSRF-TOKEN': token.content,
                    }
                }
            } )
            .then( editor => {
            } )
            .catch( error => {
                    console.error( error );
            } );
        }
    }

    if($('#userRolesDropdown').length){
        const centersContainer = $('.toggleCenters');
        if($('#userRolesDropdown').val() === 'centeradmin'){
            centersContainer.show();
        }
        $('#userRolesDropdown').on('change', function(e){
            const value = $(this).val();
            if(value === 'centeradmin'){
                centersContainer.show();
            }else{
                centersContainer.hide();
            }
        });
    }

    // Notifications
    if($('body').hasClass('admin-panel')){
        // getNotifications();
        // setInterval(function(){
        //     getNotifications();
        // }, 15000);
        $('body').on('click', '.notifLink', function(e){
            e.preventDefault();
            const $this = $(this);
            const notifId = $(this).data('id');
            const refId = $(this).data('ref-id');
            const notifEl = $('.notificationDropdown');
            const notificationReadUrl = $(notifEl).data('read-url');
            Axios.put(notificationReadUrl, { notifId, refId }).then(resp => {
                if(resp.status === 200){
                    if(resp.data === 'success'){
                        location.href = $this.attr('href');
                    }
                }
            })
            .catch(error => {
                console.log(error);
            });
        });
    }

    if(document.querySelector('.phone')){
        const phone = [{ "mask": "+63 ###-###-####"}];
        $('.phone').inputmask({
            mask: phone,
            greedy: false,
            definitions: { '#': { validator: "[0-9]", cardinality: 1}},
            removeMaskOnSubmit: false
        });
    }

    const navHasChildrenEl = $('.nav-item.children');
    const navChildrens = navHasChildrenEl.find('.sub-menu').children('.nav-item');
    navChildrens.each(function(){
        if($(this).find('.nav-link').hasClass('active')){
            navHasChildrenEl.addClass('active');
            navHasChildrenEl.find('.sub-menu').show();
        }
    });
    navHasChildrenEl.on('click', function(e){
        var $this = $(this);
        var clickable = $(e.target);
        if(clickable.hasClass('parent')){
            e.preventDefault();
            if($this.hasClass('active')){
                $this.removeClass('active');
                $this.find('.sub-menu').slideUp();
            }else{
                $this.addClass('active');
                $this.find('.sub-menu').slideDown();
            }
        }
    });

    // Specializations
    specializationDropdown();
    $('#specializationModal #specializationForm').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const action = $(this).attr('action');
        const formData = new FormData(form[0]);

        Axios.post(action, formData).then(resp => {
            if(resp.status === 200){
                const data = resp.data.data;
                specializationDropdown(data.id);
                form[0].reset();
                form.find('input').removeClass('is-invalid').find('.invalid-feedback').addClass('d-none');
                form.parents('.modal').eq(0).modal('hide');
            }
        })
        .catch(error => {
            const errors = error.response.data.errors;
            $.each(errors, function(key, val){
                form.find('[name="'+key+'"]').addClass('is-invalid');
                $.each(val, function(childKey, text){
                    form.find('[name="'+key+'"]').next().text(text).removeClass('d-none');
                });
            });
        });
    });

    // HMO Accreditations
    accreditationDropdown();
    $('#accreditationModal #accreditationForm').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const action = $(this).attr('action');
        const formData = new FormData(form[0]);

        Axios.post(action, formData).then(resp => {
            if(resp.status === 200){
                const data = resp.data.data;
                accreditationDropdown(data.id);
                form[0].reset();
                form.find('input').removeClass('is-invalid').find('.invalid-feedback').addClass('d-none');
                form.parents('.modal').eq(0).modal('hide');
            }
        })
        .catch(error => {
            const errors = error.response.data.errors;
            $.each(errors, function(key, val){
                form.find('[name="'+key+'"]').addClass('is-invalid');
                $.each(val, function(childKey, text){
                    form.find('[name="'+key+'"]').next().text(text).removeClass('d-none');
                });
            });
        });
    });

    // Service Categories
    serviceCategoryDropdown();
    $('#serviceCategoryModal #serviceCategoryForm').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const action = $(this).attr('action');
        const formData = new FormData(form[0]);

        Axios.post(action, formData).then(resp => {
            if(resp.status === 200){
                const data = resp.data.data;
                serviceCategoryDropdown(data.id);
                form[0].reset();
                form.find('input').removeClass('is-invalid').find('.invalid-feedback').addClass('d-none');
                form.parents('.modal').eq(0).modal('hide');
            }
        })
        .catch(error => {
            const errors = error.response.data.errors;
            $.each(errors, function(key, val){
                form.find('[name="'+key+'"]').addClass('is-invalid');
                $.each(val, function(childKey, text){
                    form.find('[name="'+key+'"]').next().text(text).removeClass('d-none');
                });
            });
        });
    });

});

function getNotifications(){
    const notifIcon = $('.notificationIcon');
    const notifEl = $('.notificationDropdown');
    const homeUrl = $(notifEl).data('home-url');
    const notificationFetchUrl = $(notifEl).data('fetch-url');
    window.axios.get(notificationFetchUrl)
        .then(resp => {
            if(resp.status === 200){
                const data = resp.data.data;
                let template = '';
                if(data.length){
                    notifIcon.find('span.count').text(data.length);
                    data.forEach((cData, key) => {
                        const row = cData.data;
                        template += `<a href="${homeUrl}/services-booking/${row.from.booking.id}" data-id="${cData.id}" data-ref-id="${row.from.booking.id}" class="dropdown-item notifLink">
                                        <span class="d-block" style="line-height:1.2">New booking created by ${row.from.patient.first_name} ${row.from.patient.last_name}</span>
                                        <small>${moment(row.from.booking.preferred_date).format('dddd, MMMM D YYYY')}</small>
                                    </a><div class="dropdown-divider"></div>`;
                    });
                }else{
                    template = '<span class="dropdown-item mb-2">No notifications found.</span>';
                }
                notifEl.html(template);
            }
        })
        .catch(error => {
            console.log(error);
        });
}

const displayDate = (start, end) => {
    let date = '';
    let time = '';
    let dateFormatted = '';
    if(moment(start).format('hh:mma') === moment(end).format('hh:mma')){
        time += moment(start).format('h:mma');
    }else{
        time += `${moment(start).format('h:mma')} – ${moment(end).format('h:mma')}`;
    }
    if(moment(start).format('MMM D YYYY') === moment(end).format('MMM D YYYY')){
        date = moment(start).format('dddd, MMMM D');
        if(moment().format('YYYY') !== moment(start).format('YYYY')){
            date = `${date},  ${moment(start).format('YYYY')}`;
        }
        date += `, ${time}`;
    }else{
        date = `${moment(start).format('dddd, MMMM D')}`;
        if(moment().format('YYYY') !== moment(start).format('YYYY')){
            date = `${date}, ${moment(start).format('YYYY')}`;
        }
        date += `, ${moment(start).format('h:mma')}`;
        date += ` – ${moment(end).format('dddd, MMMM D')}`;
        if(moment().format('YYYY') !== moment(end).format('YYYY')){
            date += `, ${moment(start).format('YYYY')}`;
        }
        date += `, ${moment(end).format('h:mma')}`;
    }
    dateFormatted = date;
    return dateFormatted;
}

// Select2 Dropdowns
function serviceCategoryDropdown(selectedValue = null) {
    const el = $('#serviceCategoryDropdown');
    const action = el.data('action');
    const isMultiple = el.data('multiple');
    if(el.length){
        selectedValue = el.data('value') && !selectedValue ? el.data('value') : selectedValue;
        $.ajax({
            type: 'GET',
            url: action,
            data: {
                selectedValue,
                multiple: isMultiple
            }
        }).then(function (data) {
            if(!isMultiple){
                el.html('<option disabled selected value>-- Select Center --</option>');
            }
            el.select2({
                data: data,
                allowClear: true,
                placeholder: "-- Select Center --"
            });
        });
    }
}
function specializationDropdown(selectedValue = null) {
    const el = $('#specializationDropdown');
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
            // el.html('<option disabled selected value>-- Select Specialization --</option>');
            el.select2({
                data: data,
                allowClear: true,
                multiple: true,
                placeholder: "-- Select Specialization --",
                escapeMarkup: function(markup) {
                    return markup;
                }
            });
        });
    }
}
function accreditationDropdown(selectedValue = null) {
    const el = $('#accreditationDropdown');
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
            // el.html('<option disabled selected value>-- Select HMO Accreditation --</option>');
            el.select2({
                data: data,
                allowClear: true,
                multiple: true,
                placeholder: "-- Select HMO Accreditation --"
            });
        });
    }
}

function animateValue(id, start, end, duration) {
    // assumes integer values for start and end

    var obj = document.getElementById(id);
    var range = end - start;
    // no timer shorter than 50ms (not really visible any way)
    var minTimer = 50;
    // calc step time to show all interediate values
    var stepTime = Math.abs(Math.floor(duration / range));

    // never go below minTimer
    stepTime = Math.max(stepTime, minTimer);

    // get current time and calculate desired end time
    var startTime = new Date().getTime();
    var endTime = startTime + duration;
    var timer;

    function run() {
        var now = new Date().getTime();
        var remaining = Math.max((endTime - now) / duration, 0);
        var value = Math.round(end - (remaining * range));
        obj.innerHTML = value;
        if (value == end) {
            clearInterval(timer);
        }
    }

    timer = setInterval(run, stepTime);
    run();
}
