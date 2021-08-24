/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(document).ready(function(){
    // Initializations
    $('.dropdown-toggle').dropdown();

    // Notifications
    if($('body').hasClass('doctor-panel')){
        $(document).on('click', '.allow-focus .dropdown-menu .heading, .allow-focus .dropdown-menu .body', function (e) {
            e.stopPropagation();
        });
        getNotifications();
        setInterval(function(){
            getNotifications();
        }, 15000);
        $('body').on('click', '.notifLink', function(e){
            e.preventDefault();
            const $this = $(this);
            const notifId = $(this).data('id');
            const refId = $(this).data('ref-id');
            const notifEl = $('.notificationDropdown');
            const notificationReadUrl = $(notifEl).data('read-url');
            window.axios.put(notificationReadUrl, { notifId, refId }).then(resp => {
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

    provincesCategoryDropdown();
    if($('#province').length) {
        if($('#province').data('value')){
            citiesCategoryDropdown(null, $('#province').data('value'));
        }
        $('#province').on('change', function () {
            if($(this).val()) {
                $('#city').removeAttr('disabled');
            } else {
                $('#city').attr('disabled', 'disabled');
            }
            citiesCategoryDropdown(null, $(this).val());
        });
    }

    if($('#seniorPWD').length) {
        if($('input[name="seniorPWD"]').prop('checked')) {
            $('.displayIDNo').show();
        }
        $('#seniorPWD').on('click', function() {
            if($('input[name="seniorPWD"]').prop('checked')) {
                $('.displayIDNo').show();
            }
            else {
                $('.displayIDNo').hide();
            }
        });
    }

    // WYSWIG
    // if(document.querySelector( '.wysiwyg' )){
    //     ClassicEditor
    //     .create( document.querySelector( '.wysiwyg' ), {
    //         toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable' ],
    //         heading: {
    //             options: [
    //                 { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
    //                 { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
    //                 { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
    //                 { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
    //                 { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
    //             ]
    //         }
    //     } )
    //     .then( editor => {
    //     } )
    //     .catch( error => {
    //             console.error( error );
    //     } );
    // }

    // Important Promps
    const noticeModal = $('.noticeModal');
    if(noticeModal.length){
        const settingsUrl = noticeModal.data('settings-url');
        if(location.href !== settingsUrl){
            noticeModal.modal('show');
        }
    }

    // Calendar
    const calendarEl = document.getElementById('calendar');
    if(calendarEl){
        const calendarFetchUrl = $(calendarEl).data('url');
        window.axios.get(calendarFetchUrl)
        .then(resp => {
            if(resp.status === 200){
                const data = resp.data.data;
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
                    defaultView: 'timeGridWeek',
                    defaultDate: moment().format('YYYY-MM-DD'),
                    allDaySlot: false,
                    header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridWeek,dayGridMonth,timeGridDay'
                    },
                    events: data,
                    dateClick: info => {
                        const target = info.jsEvent.target;
                        const date = info.date;
                        calendar.gotoDate(date);
                        calendar.changeView('timeGrid');
                    },
                    eventClick: eventInfo => {
                        const event = eventInfo.event;
                        const popup = $('#eventModal');
                        let icon = '';
                        if(event.extendedProps.type == 'walkin'){
                            icon = '<i class="fa fa-walking" style="width:12px"></i>';
                        }else if(event.extendedProps.type == 'online'){
                            icon = '<i class="fa fa-chalkboard-teacher" style="width:22px"></i>';
                        }

                        const template = `<div class="date"><i class="fa fa-calendar" style="width:16px"></i> <strong>${displayDate(event.start, event.end)}</strong> <h5 class="d-inline-block ml-2"><span class="badge badge-secondary ${event.extendedProps.status_normal}">${event.extendedProps.status == "Approved" ? "Requested" : event.extendedProps.status}</span></h5></div>
                                        <span class="email"><i class="fa fa-at" style="width:15px"></i> ${event.extendedProps.email}</span>
                                        <span class="mobile d-inline-block pl-3"><i class="fa fa-mobile" style="width:12px"></i> ${event.extendedProps.mobile}</span>
                                        <span class="type d-inline-block pl-3">${icon} ${event.extendedProps.type_display}</span>
                                        <div class="message mt-4" style="font-size:16px"><i class="fa fa-comment" style="width:20px"></i> ${event.extendedProps.complaint}</div>
                                        ${event.extendedProps.type == 'online' && event.extendedProps.join_url ? `<div class="message mt-3"><i class="fa fa-video" style="width:25px"></i><a href="${event.extendedProps.join_url}" target="_blank">${event.extendedProps.join_url}</a></div>` : ''}`;

                        popup.find('.modal-title .name').html(event.title);
                        popup.find('.content').html(template);
                        popup.find('.view-url').attr('href', event.extendedProps.path);
                        popup.modal('show');
                    },
                    eventRender: eventInfo => {
                        const event = eventInfo.event;
                        let icon = '';
                        if(event.extendedProps.type == 'walkin'){
                            icon = 'walking';
                        }else if(event.extendedProps.type == 'online'){
                            icon = 'chalkboard-teacher';
                        }
                        // this works for Month, Week and Day views
                        const title = $(eventInfo.el).find('.fc-time');
                        // and this is for List view
                        // let title_list = $(eventInfo.el).find('.fc-list-item-title a');

                        if(icon){
                            const micon = "<i class='fas fa-" + icon + "'></i>&nbsp;";
                            title.prepend(micon);
                        }
                  }
                });
                calendar.render();
            }
        })
        .catch(error => {
            console.log(error);
        });
    }

    // Specializations
    specializationDropdown();

    // HMO Accreditations
    accreditationDropdown();

    // Service Categories
    serviceCategoryDropdown();
});

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
                        template += `<a href="${homeUrl}/appointments/${row.from.consultation.id}" data-id="${cData.id}" data-ref-id="${row.from.consultation.id}" class="dropdown-item notifLink">
                                        <span class="d-block" style="line-height:1.2">New appointment created by ${row.from.patient.first_name} ${row.from.patient.last_name}</span>
                                        <small>${displayDate(row.from.consultation.actual_datetime, row.from.consultation.actual_endtime)}</small>
                                    </a><div class="dropdown-divider"></div>`;
                    });
                }else{
                    template = '<span class="dropdown-item mb-2">No notifications found.</span>';
                }
                notifEl.find('.body').html(template);
            }
        })
        .catch(error => {
            console.log(error);
        });
}

// Select2 Dropdowns
function serviceCategoryDropdown(selectedValue = null) {
    const el = $('#serviceCategoryDropdown');
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
            el.html('<option disabled selected value>-- Select Category --</option>');
            el.select2({
                data: data,
                allowClear: true,
                placeholder: "-- Select Category --"
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

function citiesCategoryDropdown(selectedValue = null, province = null) {
    const el = $('#city');
    const action = el.data('action');

    if(el.length){
        selectedValue = el.data('value') && !selectedValue ? el.data('value') : selectedValue;
        $.ajax({
            type: 'GET',
            url: action,
            data: {
                selectedValue,
                province: province
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
