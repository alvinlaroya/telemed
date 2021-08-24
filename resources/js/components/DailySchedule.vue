<style>
.statusSelectContext {
    display: none;
    position: absolute;
    min-width: 150px;
    background: #f7f7f7;
    border: 1px solid #d4d4d4;
    box-shadow: 2px 2px 3px 1px #b3b1b1;
}
.statusSelectContext a {
    display: block;
    padding: 5px 10px;
}
.statusSelectContext a:hover {
    text-decoration: none;
    background: #d8d8d8;
}
</style>
<template>
    <div class="daily">
        <div class="row mb-3">
            <div class="col-md-4 offset-md-4">
                <div class="date-nav">
                    <a @click="prevDay()" class="prev btn btn-xs btn-purple">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                    <div class="date">{{currDateFormat}}</div>
                    <a @click="nextDay()" class="next btn btn-xs btn-purple">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </div>
            </div>
        </div>
        <div>
            <div class="row action-group mb-2">
                <div class="col-sm-12 form-inline">
                    <div class="form-group">
                        <label for="copySched">Copy schedule forward</label>
                        <div class="input-group ml-2">
                            <input type="number" class="form-control" v-model="numDays">
                            <div class="input-group-append">
                                <span class="input-group-text">Days</span>
                            </div>
                        </div>
                        <button class="btn btn-success ml-2" @click="copySchedule()">
                            <i v-show="copyBusy" class="fa fa-circle-o-notch fa-spin fa-fw"></i> Save
                        </button>
                    </div>
                    <div class="form-group ml-5">
                        <label for="updateStatus">Update status to</label>
                        <div class="form-select ml-2">
                            <select name="status" id="updateStatus" v-model="leave_id" class="form-control zensoft-select">
                                <option value="working">Working</option>
                                <option v-for="leave in leaves" :value="leave.id" :key="leave.id">
                                    {{ leave.name }}
                                </option>
                            </select>
                            <button class="btn btn-warning ml-2" @click="updateStatus()">
                                <i v-show="updateStatusBusy" class="fa fa-circle-o-notch fa-spin fa-fw"></i>
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="busydaw text-center" v-if="gettingDoctors">
                <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
                <span class="sr-only">Loading...</span>
            </div>
            <table class="table table-striped table-sched mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>
                            <label class="zensoft-checkbox m-0">
                                <input type="checkbox" id="checkAll" v-model="checkAll">
                                <span></span>
                            </label>
                        </th>
                        <th>Doctors</th>
                        <th>Time In / Out</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="emp in doctors" v-bind:class="{ success: isChecked(emp) }">
                        <template v-if="filterDoctor === ''">
                            <td>
                                <label class="zensoft-checkbox">
                                    <input type="checkbox" :id="'check'+emp.id" v-model="checkedDoctors" :value="emp.id" class="bulkSelect">
                                    <span></span>
                                </label>
                            </td>
                            <td>
                                <label :for="'check'+emp.id">{{emp.first_name}} {{emp.last_name}}</label>
                            </td>
                            <td>
                                <div class="pop-normal">
                                    <div class="form-inline">
                                        <div class="input-group">
                                        <select name="checkin" v-model="checkins[emp.id]" class="form-control" :disabled="!isChecked(emp)" v-if="openingTime_ < closingTime_">
                                            <option v-for="timeitem of timeDrop" :value="timeitem.format('HH:mm:ss')" :hidden="openingTime_ > timeitem || closingTime_ < timeitem">{{timeitem.format('hh:mm A')}}
                                            </option>
                                        </select>
                                        <span class="input-group-addon font-black px-3 my-auto">To</span>
                                        <!--<input type="time" name="checkout" v-model="checkouts[emp.id]" class="form-control" :disabled="!isChecked(emp)">-->
                                        <select name="checkin" v-model="checkouts[emp.id]" class="form-control" :disabled="!isChecked(emp)" v-if="openingTime_ < closingTime_">
                                            <option v-for="timeitem of timeDrop" :value="timeitem.format('HH:mm:ss')" :hidden="openingTime_ > timeitem || closingTime_ < timeitem">{{timeitem.format('hh:mm A')}}</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div v-if="isScheduleSet(emp)">
                                    <button @click="onSchedSelected(emp)"
                                        class="btn btn-secondary statusContext btn-block"
                                        :data-status="emp.schedules[0].leave_id"
                                        :data-doctor="emp.id"
                                        :class="{'btn-success': isWorking(emp)}">
                                        {{getStatus(emp)}}
                                    </button>
                                </div>
                                <div v-else>
                                    <button class="btn btn-block btn-secondary" @click="setToWorkingStatus(emp)">     Not Set
                                    </button>
                                </div>
                            </td>
                        </template>
                        <template v-else>
                            <template v-if="filterDoctor == emp.id">
                                <td>
                                    <label class="zensoft-checkbox">
                                        <input type="checkbox" :id="'check'+emp.id" v-model="checkedDoctors" :value="emp.id" class="bulkSelect">
                                        <span></span>
                                    </label>
                                </td>
                                <td>
                                    <label :for="'check'+emp.id">{{emp.first_name}} {{emp.last_name}}</label>
                                </td>
                                <td>
                                    <div class="pop-normal">
                                        <div class="form-inline">
                                            <div class="input-group">
                                            <!--<input type="time" name="checkin" v-model="checkins[emp.id]" class="form-control" :disabled="!isChecked(emp)">-->
                                            <select name="checkin" v-model="checkins[emp.id]" class="form-control" :disabled="!isChecked(emp)">
                                                <option v-for="timeitem of timeDrop" :value="timeitem.format('HH:mm:ss')">
                                                    {{timeitem.format('hh:mm A')}}
                                                </option>
                                            </select>
                                            <span class="input-group-addon font-black">To</span>
                                            <select name="checkin" v-model="checkouts[emp.id]"
                                                class="form-control" :disabled="!isChecked(emp)">
                                                <option v-for="timeitem of timeDrop"
                                                    :value="timeitem.format('HH:mm:ss')">
                                                    {{timeitem.format('hh:mm A')}}
                                                </option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div v-if="isScheduleSet(emp)">
                                        <button @click="onSchedSelected(emp)"
                                            class="btn btn-default statusContext btn-block"
                                            :data-status="emp.schedules[0].leave_id"
                                            :data-doctor="emp.id"
                                            :class="{'btn-success': isWorking(emp)}">
                                            {{getStatus(emp)}}
                                        </button>
                                    </div>
                                    <div v-else>
                                        <button class="btn btn-block btn-default"
                                            @click="setToWorkingStatus(emp)">
                                            Not Set
                                        </button>
                                    </div>
                                </td>
                            </template>
                        </template>
                    </tr>
                </tbody>
            </table>
            <div class="row action-group m-0">
                <div class="col-sm-12 bg-light py-2">
                    <button class="btn btn-primary float-right" @click="saveSchedule()">
                        <i v-show="busy" class="fa fa-circle-o-notch fa-spin fa-fw"></i>
                        Save Changes
                    </button>
                </div>
            </div>
        </div>

        <!-- change status -->
        <div class="statusSelectContext">
            <ul class="list-unstyled">
                <li>
                    <a @click="setToWorking()">
                        <span v-show="!statusSelectedId" class="glyphicon glyphicon-ok-sign"></span>
                        Working
                    </a>
                </li>
                <li v-for="leave in leaves">
                    <a @click="updateSchedStatus(leave.id)">
                        <span v-show="statusSelectedId == leave.id" class="glyphicon glyphicon-ok-sign"></span>
                        {{leave.name}}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {

    mounted: function()  {
        setTimeout(() => {
            this.checkAll = true;
        }, 500)
        this.initTimeInOut();
    },

    props: ['updates', 'filterDoctor', 'leaves'],

    data: function() {
        return {
            url: '/admin',
            regCheckin: '08:00:00',
            regCheckout: '17:00:00',
            numDays: null,
            currDateFormat: moment().format('dddd, MMM D'),
            currentDate: moment(),
            checkAll: false,
            checkins: {},
            checkouts: {},
            doctors: [],
            doctor_leaves: {},
            leave_id: null,
            busy: false,
            copyBusy: false,
            updateStatusBusy: false,
            checkedDoctors: [],
            statusSelectedId: null,
            doctorSelectId: null,
            schedSelected: {},
            gettingDoctors: false,
            activeDayKey_: null,
            openingTime_: null,
            closingTime_: null
        }
    },

    computed: {
        timeDrop: function () {
            var timeStops = [];
            var endTime = moment().endOf('day');
            var startTime = moment().startOf('day');

            while(startTime <= endTime){
                timeStops.push(new moment(startTime));
                startTime.add('m', 15);
            }

            return timeStops;
        }
    },

    watch: {

        checkAll: function(checked) {
            if (checked) {
                this.checkedDoctors = this.doctors.map(function(emp) {
                    return emp.id
                })
            } else {
                this.checkedDoctors = []
            }
        },

        updates: function(update) {
            if (update)
                this.getDoctors();
        },

        currentDate: function() {
            this.initTimeInOut();
        },

        filterDoctor: function() {
            this.bindReady();
        }

    },

    methods: {

        initTimeInOut: function() {
            let day = this.currentDate.day();

            let workingHours = null;
            let fromDate = '8:00 AM';
            let toDate = '9:00 PM';

            this.openingTime_ = moment(new Date(moment().format('Y-MM-DD ') + fromDate));
            this.closingTime_ = moment(new Date(moment().format('Y-MM-DD ') + toDate));

            this.regCheckin = moment(new Date('1988-12-14 ' + fromDate)).format('HH:mm:ss');
            this.regCheckout = moment(new Date('1988-12-14 ' + toDate)).format('HH:mm:ss');
            this.getDoctors();
            setTimeout(() => {
                this.$forceUpdate();
            });
        },

        getDoctors: function() {
            this.gettingDoctors = true;
            axios.get(this.url + `/schedules/daily?date=${this.currentDate.format('Y-MM-DD')}`)
                .then(response => {
                    this.doctors = response.data;
                    this.generateModels();
                })
                .catch(error => {
                    // this.errored = true;
                })
                .finally(() =>
                    this.gettingDoctors = false
                )
        },

        bindReady: function() {
            let _self = this
            setTimeout(function() {
                $(".statusContext").off('click');
                $(".statusContext").click(function(e) {
                    console.log('statusContext click');
                    e.preventDefault()
                    $(".statusContext").attr("style", '')
                    $(this).css('background', '#f18a21')
                           .css('border', '1px solid #f18a21');
                    let offset = $(this).offset()
                    let top = $(this).outerHeight() + offset.top - 70
                    $(".statusSelectContext").css('top', top)
                                   .css('left', offset.left - 320)
                                   .show();
                });
            }, 500);
        },

        generateModels: function() {
            this.doctor_leaves = {};
            this.doctors.forEach((emp) => {
                this.checkins[emp.id] = this.getCheckin(emp);
                this.checkouts[emp.id] = this.getCheckout(emp);
                this.doctor_leaves[emp.id] = (emp.schedules.length > 0) ? emp.schedules[0].leave_id : null;
            })
            this.bindReady();
        },

        nextDay: function() {
            this.currentDate.add(1, 'days');
            this.initTimeInOut()
            this.currDateFormat = this.currentDate.format('dddd, MMM D');
        },

        prevDay: function() {
            this.currentDate.subtract(1, 'days')
            this.initTimeInOut()
            this.currDateFormat = this.currentDate.format('dddd, MMM D')
        },

        isChecked: function(emp) {
            return this.checkedDoctors.indexOf(emp.id) >= 0
        },

        isScheduleSet: function(emp) {
            return emp.schedules && emp.schedules.length > 0
        },

        getCheckin: function(emp) {
            return (emp.schedules.length > 0) ? moment(emp.schedules[0].date_time_in).format('HH:mm:ss') : this.regCheckin
        },

        getCheckout: function(emp) {
            return (emp.schedules.length > 0) ? moment(emp.schedules[0].date_time_out).format('HH:mm:ss') : this.regCheckout
        },

        getStatus: function(emp) {
            let thisShift = null
            let _self = this
            let hasShift = false
            return (emp.schedules.length > 0 && emp.schedules[0].leave) ? emp.schedules[0].leave.name : 'Working';
        },

        isWorking: function(emp) {
            return (emp.schedules.length > 0 && !emp.schedules[0].leave) ? true : false
        },

        onSchedSelected: function(emp) {
            this.schedSelected = (emp.schedules.length > 0) ? emp.schedules[0] : {};
            this.statusSelectedId = ('leave_id' in this.schedSelected) ? this.schedSelected.leave_id : null;
            this.doctorSelectId = emp.id;
        },

        checkIfActiveShift: function (emp, shift) {
            if (!shift) return false;
            let shiftFrom = moment(shift.working_from, 'h:mm A');
            let shiftTo = moment(shift.working_to, 'h:mm A');
            let _self = this;
            let schedule = emp ? ((emp.schedules.length > 0) ? emp.schedules[0] : {}) : this.schedSelected;
            if(schedule && schedule.leave_id == null){
                let schedFrom = moment(schedule.time_in, 'HH:mm:ss');
                let schedTo = moment(schedule.time_out, 'HH:mm:ss');
                if (moment(schedFrom).isSame(shiftFrom) && moment(schedTo).isSame(shiftTo)) return true;
            }
            return false;
        },

        setToWorkingStatus: function(doctor) {
            this.busy = true;
            let formData = {
                leave_id: null,
                date: this.currDateFormat,
                day_sched: true,
            }
            axios.post(this.url + `/schedules/${doctor.id}/set-working`, formData)
                .then(response => {
                    this.doctors = response.data
                    this.generateModels();
                    this.$emit('day-change')
                    $.jGrowl("Successfully save!");
                    this.busy = false;
                })
                .catch(error => {
                    // this.errored = true;
                })
                .finally(() =>
                    this.busy = false
                )
        },

        updateSchedStatus: function(leaveId) {
            if (this.statusSelectedId == leaveId) return

            let formData = {
                leave_id: leaveId,
                day_sched: true,
                date: this.currentDate.format('YYYY-MM-DD'),
            }
            this.busy = true;
            axios.post(this.url + `/schedules/${this.schedSelected.id}/update-status/${leaveId}`, formData)
                .then(response => {
                    this.doctors = response.data;
                    this.generateModels();
                    this.$emit('day-change')
                    $.jGrowl("Successfully save!");
                })
                .catch(error => {
                    // this.errored = true;
                })
                .finally(() =>
                    this.busy = false
                )
        },

        updateShift: function (key, doctor) {
            this.busy = true;
            let formData = {
                shift_key: key,
                day_sched: true,
                date: this.currentDate.format('Y-MM-DD'),
                branch_id: this.branch_id,
            }

            axios.post(this.url + `/schedules/employee/${this.doctorSelectId}/set-shift`, formData)
                .then(response => {
                    this.doctors = response.data;
                    this.generateModels();
                    this.$emit('day-change')
                    $.jGrowl("Successfully save!");
                    this.busy = false;
                })
                .catch(error => {
                    // this.errored = true;
                })
                .finally(() =>
                    this.busy = false
                )
        },

        updateStatus: function() {
            let formData = {
                leave_id: this.leave_id,
                date: this.currentDate.format('Y-MM-DD'),
                doctors: this.checkedDoctors,
            }
            this.updateStatusBusy = true;
            axios.post(this.url + '/schedules/bulk-update-status', formData)
                .then(response => {
                    this.doctors = response.data;
                    this.generateModels();
                    this.$emit('day-change')
                    $.jGrowl("Successfully save!");
                    this.updateStatusBusy = false;
                })
                .catch(error => {
                    // this.errored = true;
                })
                .finally(() =>
                    this.updateStatusBusy = false
                )
        },

        setToWorking() {
            let url = this.url + `/schedules/${this.doctorSelectId}/update-status`;
            axios.post(url, {daily: true})
                .then(response => {
                    this.doctors = response.data;
                    this.generateModels();
                    this.$emit('day-change')
                    $.jGrowl("Successfully save!");
                })
                .catch(error => {
                    // this.errored = true;
                })
                .finally(() =>
                    this.busy = false
                )
        },

        saveSchedule: function() {
            if (this.checkedDoctors.length == 0) return;
            this.busy = true;
            let formData = {
                branch_id: this.branch_id,
                date: this.currentDate.format('Y-MM-DD'),
                checkins: this.checkins,
                checkouts: this.checkouts,
                leaves: this.doctor_leaves,
                doctors: this.checkedDoctors,
            }
            axios.post(this.url + '/schedules', formData)
                .then(response => {
                    this.doctors = response.data;
                    this.generateModels();
                    this.$emit('day-change')
                    $.jGrowl("Successfully save!")
                })
                .catch(error => {
                    // this.errored = true;
                })
                .finally(() =>
                    this.busy = false
                )
        },

        copySchedule: function() {
            if (!this.numDays || this.numDays == 0) return;
            if (this.checkedDoctors.length == 0) return;

            let formData = {
                num_days: this.numDays,
                leaves: this.doctor_leaves,
                checkins: this.checkins,
                checkouts: this.checkouts,
                doctors: this.checkedDoctors,
                date: this.currentDate.format('Y-MM-DD'),
            }
            this.copyBusy = true;
            axios.post(this.url + '/schedules/daily-copy', formData)
                .then(response => {
                    this.doctors = response.data;
                    this.$emit('day-change')
                    $.jGrowl("Successfully copied schedule forward!")
                })
                .catch(error => {
                    // this.errored = true;
                })
                .finally(() =>
                    this.copyBusy = false
                )
        },

        newDate: function(date) {
            return new Date(date);
        }

    }

}
</script>
