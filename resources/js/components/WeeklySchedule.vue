<style>
.timeContext {
    display: none;
    position: absolute;
    padding: 10px;
    border-radius: 4px;
    border: #7c4117;
    width: 374px;
    background: #4f6578;
    color: #fff;
}
.timeContextTarget {
    border-color: #90a9be;
}
.timeContext .input-group-text {
    min-width: 80px;
}
.contextMenu {
    display: none;
    position: absolute;
    min-width: 150px;
    background: #4f6578;
    border: 1px solid #d4d4d4;
    box-shadow: 2px 2px 3px 1px #b3b1b1;
}
.status-choices {
    width: 217px;
}
.status-choices .list-group-item {
    padding: 0.5rem 1rem;
}
</style>
<template>
    <div>
        <div class="row">
            <div class="col-sm-4 my-auto">
                <div class="actions">
                    <button class="btn btn-sm btn-primary" :disabled="checkedDoctors.length == 0" 
                        @click="showModal = true">
                        Copy
                    </button>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="date-nav">
                    <a @click="prevWeek()" class="prev btn btn-xs btn-link">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                    <div class="date">{{startDate | momentDate}} - {{endDate | momentDate}}</div>
                    <a @click="nextWeek()" class="next btn btn-xs btn-link">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="busydaw text-center" v-if="gettingDoctors">
            <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
            <span class="sr-only">Loading...</span>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-sched">
                    <thead class="thead-dark">
                        <tr>
                            <th>
                                <label class="zensoft-checkbox m-0">
                                    <input type="checkbox" id="checkAll" v-model="checkAll">
                                    <span></span>
                                </label>
                            </th>
                            <th></th>
                            <th v-for="date in dates">{{date | momentDate}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="emp in doctors" v-bind:class="{ success: isChecked(emp) }">
                            <template v-if="filterDoctor === ''">
                                <td>
                                    <label class="zensoft-checkbox">
                                        <input type="checkbox" v-model="checkedDoctors" :value="emp.id" :id="'weekcheck'+emp.id" class="bulkSelect">
                                        <span></span>
                                    </label>
                                </td>
                                <td><label :for="'weekcheck'+emp.id">{{emp.first_name}} {{emp.last_name}}</label></td>
                                <td v-for="(date, key) in dates">
                                    <span v-if="getSchedule(emp, date)" >
                                        <button @click="onSchedSelected(emp, date, key)"  class="btn contextTarget timeContextTarget btn-block" :class="{'btn-info':isWorking(emp, date)}"
                                            :data-sched="getSchedule(emp, date).id"
                                            :data-status="getSchedule(emp, date).leave_id"
                                            :style="getStyle(emp, date)"> 
                                            <span v-if="isWorking(emp, date)">
                                                {{getSchedule(emp, date).date_time_in | momentTime}} - {{getSchedule(emp, date).date_time_out | momentTime}}
                                            </span>
                                            <span v-else>{{getStatus(emp, date)}}</span>
                                        </button>
                                    </span>
                                    <span v-else>
                                        <button @click="onSchedSelected(emp, date, key)" class="btn btn-block btn-secondary timeContextTarget  contextTarget" :data-doctor="emp.id" data-status="0" :data-date="date">
                                            Not Set
                                        </button>
                                    </span> 
                                </td>
                            </template>
                            <template v-else>
                                <template v-if="filterDoctor == emp.id">
                                    <td>
                                        <label class="zensoft-checkbox"><input type="checkbox" v-model="checkedDoctors" :value="emp.id" :id="'weekcheck'+emp.id" 
                                            class="bulkSelect">
                                            <span></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label :for="'weekcheck'+emp.id">
                                            {{emp.first_name}} {{emp.last_name}}
                                        </label>
                                    </td>
                                    <td v-for="(date, key) in dates">
                                        <span v-if="getSchedule(emp, date)" >
                                            <button @click="onSchedSelected(emp, date, key)" :class="{'btn-info':isWorking(emp, date)}" 
                                                class="btn  contextTarget timeContextTarget btn-block"
                                                :data-sched="getSchedule(emp, date).id"
                                                :data-status="getSchedule(emp, date).leave_id"
                                                :style="getStyle(emp, date)"> 
                                                <span v-if="isWorking(emp, date)">
                                                    {{getSchedule(emp, date).date_time_in | momentTime}} - {{getSchedule(emp, date).date_time_out | momentTime}}
                                                </span>
                                                <span v-else>{{getStatus(emp, date)}}</span>
                                            </button>
                                        </span>
                                        <span v-else>
                                            <button class="btn btn-block btn-deputize">Not Available</button>
                                        </span>  
                                    </td>
                                </template>
                            </template>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="contextMenu" id="contextMenu">
            <ul class="list-unstyled">
                <li>
                    <a @click="updateStatus()">
                        <span v-show="!statusSelectedId && schedSelectId" class="glyphicon glyphicon-ok-sign">
                        </span> 
                        Working
                    </a>
                </li>
                <li v-for="leave in leaves">
                    <a @click="updateStatus(leave.id)">
                        <span v-show="statusSelectedId == leave.id && schedSelectId" class="glyphicon glyphicon-ok-sign"></span> 
                        {{leave.name}}
                    </a>
                </li>
            </ul>
        </div>
        <div class="timeContext">
            <!-- MANUAL PICK OF DATE & TIME -->
            <div class="pop-normal mb-4" v-show="isWorking && !statusSelectedId">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">From:</span>
                        </div>
                        <select name="checkin" v-model="time_in" class="form-control text-center">
                            <option v-for="timeitem of timeDrop" :value="timeitem.format('HH:mm:ss')">
                                {{timeitem.format('hh:mm A')}}
                            </option>
                        </select>
                    </div>
                    <div class="input-group timeout-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">To:</span>
                        </div>
                        <select name="checkin" v-model="time_out" class="form-control"">
                            <option v-for="timeitem of timeDrop" :value="timeitem.format('HH:mm:ss')">
                                {{timeitem.format('hh:mm A')}}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <span class="input-group-btn">
                        <button @click="updateSched()" class="btn btn-success btn-block">Save</button>
                    </span>
                </div>
            </div>
            <!-- CHANGE STATUS TO OPTIONS -->
            <div class="change-status">
                <label for="change-status" class="align-top">Change status to:</label>
                <div class="list-group status-choices d-inline-block ml-2">
                    <a href="javascript:void(0)" @click="updateStatus()" class="list-group-item list-group-item-action list-group-item-success">
                        <span v-show="!statusSelectedId && schedSelectId" class="glyphicon glyphicon-ok-sign"></span> 
                        Working
                    </a>
                    <a href="javascript:void(0)" v-for="leave in leaves" @click="updateStatus(leave.id)" class="list-group-item list-group-item-action list-group-item-warning">
                        <span v-show="statusSelectedId == leave.id && schedSelectId" 
                            class="glyphicon glyphicon-ok-sign">
                        </span> 
                        {{leave.name}}
                    </a>
                </div> 
            </div>
            <span class="arrow-bottom"></span>
        </div>
        <!-- use the modal component, pass in the prop -->
        <modal v-if="showModal" @close="showModal = false">
          <h3 slot="header">Copy Schedule</h3>
          <div slot="body">
            <div class="radio">
              <label>
                <input type="radio" name="copy_sched" id="copySched" v-model="copyType" value="weeks_forward">
                Copy schedule forward <input type="text" name="num_weeks" v-model="copyNumWeeks" size="8"> weeks
              </label>
            </div>
            <div class="text-center"><strong>OR</strong></div>
            <div class="radio">
              <label>
                <input type="radio" name="copy_sched" id="copyWeeks" v-model="copyType" value="selected_weeks">
                Copy to selected weeks
              </label>
            </div>

            <div class="checkbox">
              <label>
                <input type="checkbox" id="checkAll" v-model="checkAllWeeks" :disabled="copyType != 'selected_weeks'">
                <em>Select all weeks</em>
              </label>
            </div>
            <div class="checkbox" v-for="week in weeks">
              <label>
                <input type="checkbox" v-model="copyWeeks" :value="week" :disabled="copyType != 'selected_weeks'">
                {{week | momentDate}} - {{ weekPair(week) | momentDate }}
              </label>
            </div>
          </div>
          <div slot="footer">
                <button type="button" class="btn btn-primary" @click="copySchedule()">
                    <i v-show="busy" class="fa fa-circle-o-notch fa-spin fa-fw"></i> Submit
                </button>
                <button class="btn btn-secondary ml-1" @click="showModal = false">Cancel</button>
          </div>
        </modal>
    </div>
</template>

<script>
export default {

    mounted: function() {
        if (window.weekDate) {
            this.startDate = moment(window.weekDate).startOf('isoweek');
            this.endDate = moment(window.weekDate).endOf('isoweek');
        }
        this.getDoctors();
    },

    props: ['updates', 'filterDoctor', 'leaves'],

    data: function() {
        return {
            url: '/admin',
            startDate: moment().startOf('isoweek'),
            endDate: moment().endOf('isoweek'),
            checkAll: false,
            doctors: [],
            checkedDoctors: [],
            showModal: false,
            copyWeeks: [],
            copyType: 'weeks_forward',
            copyNumWeeks: null,
            schedSelectId: null,
            dateSelected: null,
            statusSelectedId: null,
            doctorSelected: null,
            doctorSelectId: null,
            isSelectedWorking: false,
            checkAllWeeks: false,
            busy: false,
            time_in: null, 
            time_out: null,
            date_out: null,
            schedSelected: {},
            gettingDoctors: false,
            activeDayKey: null,
            openingTime: null,
            closingTime: null,
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

        checkAllWeeks: function(checked) {
            if (checked) {
                this.copyWeeks = this.weeks
            } else {
                this.copyWeeks = []
            } 
        }, 

        updates: function(update) {
            if (update) {
                console.log('weekly update');
                this.getDoctors();
            }
        },

        workingTime: function() {
            let workingHours = null;
            let momentDate = moment(this.dateSelected);
            let dayOfWeek = momentDate.day();
            if (workingHours && typeof workingHours[dayOfWeek] !== 'undefined') {
                return workingHours[dayOfWeek];
            }
            return null;
        },

        workingHoursDropdown: function() {
            let workingDate = moment(this.dateSelected);
            let workingHour = this.workingTime;
            let start = workingDate.clone().hour(8).minute(0),
                end   = workingDate.clone().hour(21).minute(0);
            if (workingHour) {
                let workingStartTime = moment(workingHour.working_from, ['hh:mm A']);
                let workingEndTime = moment(workingHour.working_to, ['hh:mm A']);
                if (workingStartTime.isBefore(workingEndTime)) {
                    start = workingDate.clone().hour(workingStartTime.hour()).minute(0);
                    end   = workingDate.clone().hour(workingEndTime.hour());
                } else {
                    start = workingDate.clone().hour(workingStartTime.hour()).minute(0);
                    end   = workingDate.clone().endOf('day');
                }
            }
            start.second(0);
            end.second(0);
            let mins = [];
            do {
                mins.push({
                    value: start.clone().format('HH:mm:ss'),
                    label: start.clone().format('hh:mm A')
                });
                start.add(15, 'minutes');
            } while (start.isSameOrBefore(end));
            return mins;
        }

    },

    computed: {

        dates: function() {
            let dates = []
            let running = moment(this.startDate)
            let end = moment(this.endDate)
            do {
                dates.push(running.format('YYYY-MM-DD'))
                running.add(1, 'days')
            } while (running.isBefore(end, 'day') || running.isSame(end, 'day'))

            return dates
        },

        weeks: function() {
            let weeks = []
            let running = moment(this.startDate)
            let count = 0

            do {
                running.add(1, 'weeks')
                weeks.push(running.format('YYYY-MM-DD'))
                count++
            } while (count <= 5)

            return weeks
        },

        startDateFormatted: function() {
            return this.startDate.format('YYYY-MM-DD')
        },

        endDateFormatted: function() {
            return this.endDate.format('YYYY-MM-DD')
        },

        timeInSelected: function() {
            if (!this.schedSelected) return null;
            return moment(this.schedSelected.date_time_in).format('HH:mm:ss')
        },

        timeOutSelected: function() {
            if (!this.schedSelected) return null;
            return moment(this.schedSelected.date_time_out).format('HH:mm:ss')
        },

        timeDrop: function (e) {
            var timeStops = [];
            var endTime = moment().endOf('day');
            var startTime = moment().startOf('day');

            while(startTime <= endTime){
                timeStops.push(new moment(startTime));
                startTime.add('m', 15);
            }

            return timeStops;
        },

    },

    methods: {

        initDatepicker: function (date) {
            let _self = this;
            let element = $('.timeout-datepicker');
            element.datepicker({
                maxViewMode : 0,
                minViewMode : 0,
                autoclose : true,
                format : "D, M dd",
                markerClassName: 'hasDatepicker',
            }).on('changeDate', function (e) {
                let thisDate = moment(e.date);
                _self.date_out = thisDate.format('ddd, MMM D');
            });
            element.datepicker('setStartDate', moment(date).format('YYYY-MM-DD'));
        },

        getDoctors: function() {
            this.gettingDoctors = true;
            axios.get(this.url + `/schedules/weekly?start_date=${this.startDateFormatted}&end_date=${this.endDateFormatted}`)
                .then(response => {
                    this.doctors = response.data;
                    this.weekReady()
                })
                .catch(error => {
                    // this.errored = true;
                })
                .finally(() => 
                    this.gettingDoctors = false
                )
        },

        isChecked: function(emp) {
            return this.checkedDoctors.indexOf(emp.id) >= 0
        },

        weekReady: function() {
            let _self = this
            setTimeout(function() {

                $(document).off('click')
                $(document).click(function(e) {
                    let target = $(e.target)
                    if (false == target.hasClass('contextTarget')
                        && false == target.closest('button').hasClass('contextTarget')
                        && false == target.closest('div').hasClass('timeContext')
                        && false == target.hasClass('statusContext')) {
                        $("#contextMenu").hide()
                        $(".timeContext").hide()
                        //$(".contextTarget").attr("style", '')
                        // for the daily view
                        $(".statusSelectContext").hide()
                        $(".statusContext").attr("style", '')
                    }
                    e.stopPropagation();
                })

                $(".contextTarget").off("contextmenu")
                $(".contextTarget").contextmenu(function(e) {
                    var $this = $(this);
                    e.preventDefault()
                    let offset = $this.offset()
                    let top = $this.outerHeight() + offset.top - 5
                    $("#contextMenu").css('top', top)
                                   .css('left', offset.left - 20)
                                   .show();
                    _self.dateSelected = $this.data('date')
                    _self.schedSelectId = $this.data('sched')
                    _self.doctorSelectId = $this.data('doctor')
                    _self.statusSelectedId = $this.data('status')
                });

                $(".timeContext").off('click')
                $(".timeContext").click(function(e) {
                    e.stopPropagation();
                })

                $(".timeContextTarget").off('click')
                $(document).on('click', '.timeContextTarget', function(e) {
                    var $this = $(this);
                    e.preventDefault()

                    setTimeout(function() {
                        let offset = $this.offset();
                        let docYOff = window.scrollY;

                        let bottom = $this.outerHeight() + offset.bottom - 116 // 16 for caret
                        let top = $this.outerHeight() + offset.top - 116 // 16 for caret
                        let targetWidth = $(".timeContext").outerWidth();
                        let targetHeight = $(".timeContext").outerHeight();
                        let contextWidth = (targetWidth - $this.outerWidth()) / 2
                        let remainings = top - docYOff;

                        if (remainings > targetHeight) {
                            $(".timeContext").css('top', top - targetHeight)
                                .css('left', offset.left - contextWidth - 40)
                                .removeClass('positioned-bottom').show();
                        } else {
                            $(".timeContext").css('top', offset.top - 26)
                                .css('left', offset.left - contextWidth - 40) 
                                .addClass("positioned-bottom").show();
                        }
                    }, 1);
                });
            }, 500)
        },

        weekPair: function(start) {
            let moDate = moment(start)
            return moDate.add(6, 'days').format('YYYY-MM-DD')
        },

        prevWeek: function() {
            let start = moment(this.startDate),
                end = moment(this.endDate);
            this.startDate = start.subtract(1, 'weeks')
            this.endDate = end.subtract(1, 'weeks')
            this.getDoctors()
        },

        nextWeek: function() {
            let start = moment(this.startDate),
                end = moment(this.endDate);
            this.startDate = start.add(1, 'weeks');
            this.endDate = end.add(1, 'weeks');
            this.getDoctors();
        },

        onSchedSelected: function(emp, date, key = null) {
            this.activeDayKey = key;
            let selectedWorkingHr = null;
            let workingHours = null;


            if (this.activeDayKey != null && workingHours) {
                let activeDayKey = this.activeDayKey < 6  ? (this.activeDayKey + 1) : 0; // nasa dulo yung sunday eh hekhek
                selectedWorkingHr = workingHours.find(function(workingHr, key) {
                    if (key == activeDayKey) {
                        return workingHr;
                    }
                });
            }

            if (selectedWorkingHr) {
                let rawStaringTime = selectedWorkingHr.working_from.split(' ');
                let startingTime_ = moment().format('Y-M-DD ')+ rawStaringTime[0] + ':00';

                let rawEndingTime = selectedWorkingHr.working_to.split(' ');
                let endingTime_ = moment().format('Y-M-DD ')+ rawEndingTime[0] + ':00';

                this.openingTime = moment(new Date(startingTime_));
                this.closingTime = rawEndingTime[1] == 'AM' ? moment(new Date(endingTime_)) :  moment(new Date(endingTime_)).add(12, 'hours');
            }

            this.schedSelected = this.getSchedule(emp, date);
            let momentDate = moment(date);

            // check if is working on the day then get time_in and time_out date
            if (this.schedSelected && !this.schedSelected.leave) {
                this.time_in = this.getTimeIn();
                this.time_out = this.getTimeOut();
            }
            this.statusSelectedId = (this.schedSelected && 'leave_id' in this.schedSelected) ? this.schedSelected.leave_id : null;
            this.schedSelectId = (this.schedSelected && 'id' in this.schedSelected) ? this.schedSelected.id : null;
            this.dateSelected = date;
            this.doctorSelected = emp;
            this.doctorSelectId = emp.id;
            this.isSelectedWorking = this.isWorking(emp, date);
        },

        getTimeIn: function() {
            if (!this.schedSelected) return null;
            return moment(this.schedSelected.date_time_in).format('HH:mm:ss')
        },

        getTimeOut: function() {
            if (!this.schedSelected) return null;
            return moment(this.schedSelected.date_time_out).format('HH:mm:ss')
        },

        getTimeOutDate: function (date) {
            if (!this.schedSelected) return null;
            return this.schedSelected.date_out ? moment(this.schedSelected.date_out).format('ddd, MMM D') : moment(date).format('ddd, MMM D');
        },

        getSchedule: function(emp, date) {
            let _self = this;
            let momentDate = moment(date);

			let sched;
            if (emp.schedules) {
				sched = emp.schedules.find((sched) => {
					return momentDate.isSame(moment(sched.date), 'day');
				});
            }

            return sched ? sched : false;
        },

        isWorking: function(emp, date) {
            let momentDate = moment(date)
            let schedule = this.getSchedule(emp, date);

            return (schedule && !schedule.leave) ? true : false
        },

        getStatus: function(emp, date) {
            let momentDate = moment(date)

            let schedule = this.getSchedule(emp, date);

            return (schedule && schedule.leave) ? schedule.leave.name : 'Working';
        },

        getStyle: function(emp, date) {

            let schedule = this.getSchedule(emp, date),
                style = '',
                shiftTimeIn = '',
                shiftTimeOut = '',
                schedTimeIn = '',
                schedTimeOut = '';
            
            if (this.isWorking(emp, date)) {
                // 
            } else {
                style = schedule.leave.color != null ? 'background-color: ' + schedule.leave.color + '; color: #fff;"' : '';
            }
            
            return style;
        },

        updateSched: function() {
            if (!this.schedSelected) {
                this.setUnsetStatus(null);
            } else {
                this.busy = true;
                let formData = {
                    time_in: this.time_in,
                    time_out: this.time_out,
                    date: this.dateSelected,
                    //date_out: this.date_out,
                    start_date: this.startDateFormatted,
                    end_date: this.endDateFormatted,

                }
                axios.post(this.url + `/schedules/${this.schedSelected.id}/update`, formData)
                    .then(response => {
                        this.doctors = response.data;
                        this.weekReady()
                        this.$emit('week-change')
                        $(".timeContext").hide()
                        $.jGrowl("Successfully saved!");
                    })
                    .catch(error => {
                        // this.errored = true;
                    })
                    .finally(() => 
                        this.busy = false
                    )
            }
        },

        updateShift: function (key) {
            this.busy = true;
            let formData = {
                shift_key: key,
                date: this.dateSelected,
                start_date: this.startDateFormatted,
                end_date: this.endDateFormatted,
            }

            axios.post(this.url + `/schedules/employee/${this.doctorSelectId}/set-shift`, formData)
                .then(response => {
                    this.doctors = response.data;
                    this.weekReady()
                    this.$emit('week-change')
                    $.jGrowl("Successfully saved!");
                    $(".timeContext").hide();
                })
                .catch(error => {
                    // this.errored = true;
                })
                .finally(() => 
                    this.busy = false
                )
        },

        updateStatus: function(leaveId = null) {
            if (this.statusSelectedId && this.statusSelectedId == leaveId) return

            let formData = {
                leave_id: leaveId,
                start_date: this.startDateFormatted,
                end_date: this.endDateFormatted,
            }
            if (!this.schedSelectId) {
                return this.setUnsetStatus(leaveId);
            }
            this.busy = true;
            let url = this.url + `/schedules/${this.schedSelectId}/update-status`;
            if (leaveId) {
                url = url + `/${leaveId}`;
            }
            axios.post(url, formData)
                .then(response => {
                    this.doctors = response.data;
                    $(".timeContext").hide();
                    this.$emit('week-change')
                    $.jGrowl("Successfully saved!");
                    this.weekReady()
                })
                .catch(error => {
                    // this.errored = true;
                })
                .finally(() => 
                    this.busy = false
                )
        },

        setUnsetStatus: function(leaveId) {
            this.busy = true;
            let formData = {
                leave_id: leaveId,
                date: this.dateSelected,
                // additional params for manual time from not set - start
                time_in: this.time_in,
                time_out: this.time_out,
                // - end
                date: this.dateSelected,
                //date_out: this.date_out,
                start_date: this.startDateFormatted,
                end_date: this.endDateFormatted,
            }
            axios.post(this.url + `/schedules/${this.doctorSelectId}/set-working`, formData)
                .then(response => {
                    this.doctors = response.data;
                    this.weekReady()
                    this.$emit('week-change')
                    $(".timeContext").hide();
                    $.jGrowl("Successfully saved!");
                })
                .catch(error => {
                    // this.errored = true;
                })
                .finally(() => 
                    this.busy = false
                )
        },

        copySchedule: function() {
            if (this.checkedDoctors.length == 0) return;
            this.busy = true;
            let formData = {
                start_date: this.startDateFormatted,
                end_date: this.endDateFormatted,
                week_copy: this.startDateFormatted,
                copy_type: this.copyType,
                num_weeks: this.copyNumWeeks,
                on_weeks: this.copyWeeks,
                doctors: this.checkedDoctors,
            }
            axios.post(this.url + '/schedules/week-copy', formData)
                .then(response => {
                    this.doctors = response.data;
                    this.showModal = false
                    this.weekReady()
                    this.$emit('week-change')
                    $.jGrowl("Successfully saved!");
                })
                .catch(error => {
                    // this.errored = true;
                })
                .finally(() => 
                    this.busy = false
                )
        },

        newDate: function(date) {
            return new Date(date);
        }

    },

    components: {
        'modal': require('./Modal.vue').default,
    }

}
</script>
