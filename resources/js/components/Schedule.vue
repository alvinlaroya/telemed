<style>
a {
    cursor: pointer;
}
.nav-tabs > li {
    float: right;
}
.date-nav {
    text-align: center;
    padding: 5px 0;
    background: #ede9f3;
}
.date-nav > .date {
    display: inline-block;
    padding: 0 12px;
    font-weight: 600;
}
.busydaw {
    margin-bottom: -39px;
    z-index: 2500;
    position: relative;
    color: #1bff25;
}
</style>

<template>
    <div>
        <h2>{{ doctor.first_name }}</h2>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link" href="#week" aria-controls="week" role="tab" data-toggle="tab">Week</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" href="#daily" aria-controls="daily" role="tab" data-toggle="tab">Day</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade" id="daily">
                <daily-schedule v-on:day-change="daySchedChange"
                    :filter-doctor="doctorSelect" 
                    :leaves="leaves"
                    :updates="updateDay">
                </daily-schedule>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="week">
                <weekly-schedule v-on:week-change="weekSchedChange" 
                    :doctor="doctor"  
                    :leaves="leaves"
                    :updates="updateWeek">
                </weekly-schedule>
            </div>
        </div>

    </div>
</template>

<script>
export default {

    mounted: function()  {
        let _self = this
        this.getLeaves();
        this.getDoctors();
        
        setTimeout(function() {
            $('#myTabs a').click(function (e) {
              e.preventDefault()
              $(this).tab('show')
            })
            $('#myTabs a:first').tab('show');
        }, 500)
    },

    props: ['doctor'],

    data: function() {
        return {
            url: '/admin',
            loading: false,
            updateWeek: false,
            updateDay: false,
            leaves: [],
            doctors: [],
            doctorSelect: '',
            shifts: []
        }
    },

    components: {
        'daily-schedule': require('./DailySchedule.vue').default,
        'weekly-schedule': require('./WeekSchedule.vue').default,
    },

    methods: {

        getDoctors: function() {
            // axios.get(this.url + '/branch-employees')
            //     .then(response => {
            //         this.doctors = response.data;
            //     })
            //     .catch(error => {
            //         // this.errored = true;
            //     })
            //     .finally(() => 
            //         this.loading = false
            //     )
        },

        getLeaves: function() {
            axios.get(this.url + '/leaves')
                .then(response => {
                    this.leaves = response.data;
                })
                .catch(error => {
                    // this.errored = true;
                });
        },

        daySchedChange: function() {
            this.updateWeek = true
            console.log('daySchedChange');
            setTimeout(() => this.updateWeek = false)
        },

        weekSchedChange: function() {
            this.updateDay = true
            console.log('weekSchedChange');
            setTimeout(() => this.updateDay = false)
        }

    }

}
</script>
