require('./bootstrap');

$(document).ready(function(){
    // Initializations
    $('.dropdown-toggle').dropdown();

    // Notifications
    if($('body').hasClass('center-panel')){
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

    if($('#bookingDetails').length > 0) {
        $('#bookingDetails .date-picks').each(function(e) {
            const year = (new Date).getFullYear();
            // const today = new Date();
            // const dateValue = new Date($(this).data('value'));
            // const difference = dateValue.getTime() - today.getTime();
            // var days = Math.ceil(difference / (1000 * 3600 * 24));
            $(this).datepicker( {
                minDate: 0,
                maxDate: new Date(year, 11, 31)
            });
        })

        $('.time-picks').timepicker({
            timeFormat: 'h:mm p',
            interval: 15,
            minTime: '6:00am',
            maxTime: '6:00pm',
            startTime: '6:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true,
            zindex: 9999999
        })
    }
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
                        if(row.action === 'pay'){
                            template += `<a href="${homeUrl}/bookings/${row.from.booking.id}" data-id="${cData.id}" data-ref-id="${row.from.booking.id}" class="dropdown-item notifLink">
                            <span class="d-block" style="line-height:1.2">${row.ref.title}</span>
                            <small>${moment(cData.created_at).format('MMM-D-YYYY, h:mm a')}</small>
                            </a><div class="dropdown-divider"></div>`;
                        }else{
                            template += `<a href="${homeUrl}/bookings/${row.from.booking.id}" data-id="${cData.id}" data-ref-id="${row.from.booking.id}" class="dropdown-item notifLink">
                                            <span class="d-block" style="line-height:1.2">New booking created by ${row.from.patient.first_name} ${row.from.patient.last_name}</span>
                                            <small>${moment(cData.created_at).format('MMM-D-YYYY, h:mm a')}</small>
                                        </a><div class="dropdown-divider"></div>`;
                        }
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
