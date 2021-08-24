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
    z-index: 2000;
}
.timeContextTarget {
    border-color: #5c809f;
}
.contextTarget {
    min-width: 120px;
}
.medical-services {
    color: #010d6f;
    background: #6cb2eb;
}
.reliever-btn {
    border: 2px solid #0552b3;
    /*background: #f7dcdb;*/
    /*border-color: #be716f;
    margin-bottom: 5px !important;*/
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
        <!-- <h2>{{doctor.first_name}}</h2> -->
        <div class="row mb-2">
            <div class="col-sm-4 my-auto">
                <div class="actions">
                    <button class="btn btn-sm btn-primary" @click="showModal = true">
                        Copy
                    </button>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="date-nav d-flex-inline d-flex">
                    <a @click="prevWeek()" class="prev btn btn-xs btn-info">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                    <div class="date font-weight-bold m-auto">
                        {{startDate | momentDate}} - {{endDate | momentDate}}
                    </div>
                    <a @click="nextWeek()" class="next btn btn-xs btn-info">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="busydaw text-center" v-if="gettingSchedule">
            <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
            <span class="sr-only">Loading...</span>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-sched table-responsive">
                    <thead class="thead-dark">
                        <tr>
                            <th v-for="date in dates">{{date | momentDate}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td v-for="(date, key) in dates">
                                <span v-if="getSchedule(date)" >
                                    <div v-for="shift in getShifts(date)">
                                        <button @click="onShiftSelect(shift, date)"
                                            class="btn btn-block contextTarget timeContextTarget mb-3"
                                            v-bind:class="{
                                                'reliever-btn': shift.reliever && !shift.leave,
                                                'medical-services': shift.created_by
                                            }"
                                            :data-sched="shift.id"
                                            :data-status="shift.leave_id">
                                            <span v-if="shift.leave">
                                                {{ shift.leave.name }}
                                            </span>
                                            <span v-else>
                                            <i v-if="shift.type == 'online'" class="fas fa-chalkboard-teacher mr-1"></i>
                                            <i v-if="shift.type == 'walkin'" class="fas fa-walking mr-1"></i>
                                            {{ shift.date_time_in | momentTime }} - {{ shift.date_time_out | momentTime }}
                                            </span>
                                        </button>
                                        <!-- <p class="small text-center mt-1 font-italic"
                                            v-if="shift.reliever && !shift.leave">
                                            Reliever
                                        </p> -->
                                    </div>
                                    <div v-if="isWorking(date)">
                                        <hr>
                                        <button @click="newShift(date, key)"
                                            class="btn btn-secondary btn-block contextTarget timeContextTarget">
                                            <i class="fas fa-plus"></i> Shift
                                        </button>
                                    </div>
                                </span>
                                <span v-else>
                                    <button @click="onSchedSelected(date, key)" class="btn btn-block btn-secondary timeContextTarget contextTarget mb-3" data-status="0" :data-date="date">
                                        Not Set
                                    </button>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="legend mt-4 pt-3 border-top">
            <!-- <h5>Legend:</h5> -->
            <button class="btn medical-services">
                <!-- &nbsp; -->
            </button>
            <span>Created by medical services</span>
            <button class="btn ml-3" style="border-color:#5c809f">
            </button>
            <span>Created by doctor / secretary</span>
            <button class="btn ml-3" style="border:2px solid #0552b3">
            </button>
            <span>Reliever doctor</span>
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
            <div class="pop-normal mb-4" v-show="!statusSelectedId">
                <div class="form-group mb-2">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">From:</span>
                        </div>
                        <select name="checkin" v-model="time_in" class="custom-select text-center">
                            <option v-for="timeitem of timeDrop" :value="timeitem.format('HH:mm:ss')">
                                {{timeitem.format('hh:mm A')}}
                            </option>
                        </select>
                    </div>
                    <div class="input-group timeout-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">To:</span>
                        </div>
                        <select name="checkin" v-model="time_out" class="custom-select">
                            <option v-for="timeitem of timeDrop" :value="timeitem.format('HH:mm:ss')">
                                {{timeitem.format('hh:mm A')}}
                            </option>
                        </select>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Type:</span>
                        </div>
                        <select class="custom-select" v-model="type" id="typeSelect">
                            <option v-for="(type, key) in types" :value="key">{{type}}</option>
                        </select>
                    </div>
                </div>
                <div class="custom-control custom-checkbox mb-2">
                    <input class="custom-control-input" v-model="reliever" type="checkbox"
                        value="1" id="relieverCheck"
                        >
                    <label class="custom-control-label" for="relieverCheck">
                        Reliever
                    </label>
                </div>
                <button @click="updateSched()" class="btn btn-success btn-block">Save</button>
                <button v-if="hasShifts(dateSelected) && schedSelected"
                    @click="removeShift(schedSelected)"
                    class="btn btn-danger btn-block mt-2">
                    Remove
                </button>
                <div v-if="errMsg" class="alert alert-danger mt-2" role="alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    {{errMsg}}
                </div>
            </div>
            <!-- CHANGE STATUS TO OPTIONS,
                show only if no schedule yet or only 1 shift -->
            <div class="change-status d-flex" v-if="showChangeStatus(dateSelected)">
                <label for="change-status" class="align-top">Change status to:</label>
                <div class="list-group status-choices d-inline-block ml-2">
                    <a href="javascript:void(0)"
                        @click="updateStatus()"
                        v-if="!isWorking(dateSelected)"
                        class="list-group-item list-group-item-action list-group-item-success">
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
                Copy schedule forward
                <input type="text" name="num_weeks" v-model="copyNumWeeks" size="8"> weeks
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
        this.getWeekSchedule();
        if (this.typeSelected) {
            this.medServices = true;
            // this.type = this.typeSelected;
        }
    },

    props: ['leaves', 'doctor', 'types', 'url', 'typeSelected'],

    data: function() {
        return {
            medServices: false,
            startDate: moment().startOf('week'),
            endDate: moment().endOf('week'),
            checkAll: false,
            schedules: [],
            showModal: false,
            copyWeeks: [],
            copyType: 'weeks_forward',
            copyNumWeeks: null,
            schedSelectId: null,
            dateSelected: null,
            statusSelectedId: null,
            isSelectedWorking: false,
            checkAllWeeks: false,
            busy: false,
            type: '',
            time_in: null,
            time_out: null,
            reliever: false,
            errMsg: '',
            date_out: null,
            schedSelected: {},
            gettingSchedule: false,
            activeDayKey: null,
            openingTime: null,
            closingTime: null,
        }
    },

    watch: {

        checkAllWeeks: function(checked) {
            if (checked) {
                this.copyWeeks = this.weeks
            } else {
                this.copyWeeks = []
            }
        },

        updates: function(update) {
            if (update) {
                this.getWeekSchedule();
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
            let timeStops = [];
            let endTime = moment().endOf('day');
            let startTime = moment().startOf('day');

            let duration = this.doctor.consultation_duration || 5
            while(startTime <= endTime) {
                timeStops.push(new moment(startTime));
                startTime.add('m', duration);
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

        getWeekSchedule: function() {
            axios.get(this.url + `/schedule/weekly?start_date=${this.startDateFormatted}&end_date=${this.endDateFormatted}`)
                .then(response => {
                    this.schedules = response.data;
                    this.weekReady()
                })
                .catch(error => {
                    // this.errored = true;
                })
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

                    if ($this.hasClass('medical-services') && !_self.medServices) {
                        $(".timeContext").hide()
                        alert('Schedule cannot be edited. Please contact medical services to edit this schedule.');
                        return;
                    }

                    setTimeout(function() {
                        let offset = $this.offset();
                        let docYOff = window.scrollY;

                        let bottom = $this.outerHeight() + offset.bottom - 116 // 16 for caret
                        let top = $this.outerHeight() + offset.top - 116 // 16 for caret
                        let targetWidth = $(".timeContext").outerWidth();
                        let targetHeight = $(".timeContext").outerHeight();
                        let contextWidth = (targetWidth - $this.outerWidth()) / 2
                        let remainings = top - docYOff;
                        let docWidth = document.body.clientWidth;
                        let cssLeft = offset.left - contextWidth - 40;
                        let cssTop = offset.top - (targetHeight / 2);

                        if ((offset.left + targetWidth + $this.outerWidth()) > docWidth) {
                            cssLeft = offset.left - targetWidth - $this.outerWidth()
                        }

                        if (remainings > targetHeight) {
                            $(".timeContext").css('top', top - targetHeight)
                                .css('left', cssLeft)
                                .removeClass('positioned-bottom').show();
                        } else {
                            $(".timeContext").css('top', cssTop)
                                .css('left', cssLeft)
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
            this.getWeekSchedule()
        },

        nextWeek: function() {
            let start = moment(this.startDate),
                end = moment(this.endDate);
            this.startDate = start.add(1, 'weeks');
            this.endDate = end.add(1, 'weeks');
            this.getWeekSchedule();
        },

        onSchedSelected: function(date, key = null) {
            this.reliever = false;
            // this.type = this.typeSelected || '';
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

            this.schedSelected = this.getSchedule(date);
            let momentDate = moment(date);

            // check if is working on the day then get time_in and time_out date
            if (this.schedSelected && !this.schedSelected.leave) {
                this.time_in = this.getTimeIn();
                this.time_out = this.getTimeOut();
            }
            this.statusSelectedId = (this.schedSelected && 'leave_id' in this.schedSelected) ? this.schedSelected.leave_id : null;
            this.schedSelectId = (this.schedSelected && 'id' in this.schedSelected) ? this.schedSelected.id : null;
            this.dateSelected = date;
            this.isSelectedWorking = this.isWorking(date);
        },

        onShiftSelect(shift, date) {
            if (!shift.leave) {
                this.type = shift.type || '';
                this.reliever =  shift.reliever
                this.time_in = moment(shift.date_time_in).format('HH:mm:ss')
                this.time_out =  moment(shift.date_time_out).format('HH:mm:ss')
            }
            // else {
            //     this.type = this.typeSelected || '';
            // }
            this.errMsg = '';
            this.dateSelected = date
            this.schedSelected = shift;
            this.schedSelectId = shift.id
            this.statusSelectedId = shift.leave_id
        },

        newShift(date, key = null) {
            this.errMsg = '';
            // this.type = this.typeSelected || '';
            this.reliever = false
            this.dateSelected = date
            this.schedSelected = null;
            this.schedSelectId = null
            this.statusSelectedId = null
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

        getShifts: function(date) {
            let _self = this;
            let momentDate = moment(date);

            return this.schedules.filter((sched) => {
                return momentDate.isSame(moment(sched.date), 'day');
            });
        },

        hasShifts: function(date) {
            return this.getShifts(date).length > 1;
        },

        getSchedule: function(date) {
            let _self = this;
            let momentDate = moment(date);

			let sched= this.schedules.find((sched) => {
				return momentDate.isSame(moment(sched.date), 'day');
			});

            return sched ? sched : false;
        },

        isWorking: function(date) {
            let schedule = this.getSchedule(date);

            return (schedule && !schedule.leave) ? true : false
        },

        showChangeStatus: function(date) {
            let shifts = this.getShifts(date);

            if (shifts.length > 1) return false;

            if (shifts.length === 1 && !this.schedSelected) {
                return false;
            }

            return true
        },

        isWeeklyOff: function(date) {
            let shifts = this.getShifts(date);

            if (shifts.length > 1) return false;

            if (shifts.length === 1) {
                return shifts[0].leave ? true : false
            }

            return true
        },

        getStatus: function(date) {
            let momentDate = moment(date)

            let schedule = this.getSchedule(date);

            return (schedule && schedule.leave) ? schedule.leave.name : 'Working';
        },

        getStyle: function(date) {

            let schedule = this.getSchedule(date),
                style = '',
                shiftTimeIn = '',
                shiftTimeOut = '',
                schedTimeIn = '',
                schedTimeOut = '';

            if (this.isWorking(date)) {
                //
            } else {
                style = schedule.leave.color != null ? 'background-color: ' + schedule.leave.color + '; color: #fff;"' : '';
            }

            return style;
        },

        removeShift(shift) {
            let formData = {
                start_date: this.startDateFormatted,
                end_date: this.endDateFormatted,
            }
            axios.delete(this.url + `/schedule/${shift.id}`, {
                    data: formData
                })
                .then(response => {
                    this.schedules = response.data;
                    this.weekReady()
                    $(".timeContext").hide()
                    this.errMsg = ''
                    // $.jGrowl("Successfully saved!");
                })
                .catch(error => {
                    // this.errored = true;
                })
                .finally(() =>
                    this.busy = false
                )
        },

        updateSched: function() {
            if (!this.schedSelected) {
                this.setUnsetStatus(null);
            } else {
                this.busy = true;
                let formData = {
                    type: this.type,
                    time_in: this.time_in,
                    time_out: this.time_out,
                    date: this.dateSelected,
                    reliever: this.reliever,
                    //date_out: this.date_out,
                    start_date: this.startDateFormatted,
                    end_date: this.endDateFormatted,

                }
                axios.post(this.url + `/schedule/${this.schedSelected.id}/update`, formData)
                    .then(response => {
                        this.schedules = response.data;
                        this.weekReady()
                        this.errMsg = ''
                        // this.$emit('week-change')
                        $(".timeContext").hide()
                        $.jGrowl("Successfully saved!");
                    })
                    .catch(error => {
                        if (error.response) {
                            let err = error.response.data;
                            this.errMsg = err.message
                        }
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
            let url = this.url + `/schedule/${this.schedSelectId}/update-status`;
            if (leaveId) {
                url = url + `/${leaveId}`;
            }
            axios.post(url, formData)
                .then(response => {
                    this.schedules = response.data;
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
                type: this.type,
                date: this.dateSelected,
                time_in: this.time_in,
                time_out: this.time_out,
                reliever: false,
                date: this.dateSelected,
                //date_out: this.date_out,
                start_date: this.startDateFormatted,
                end_date: this.endDateFormatted,
            }
            axios.post(this.url + `/schedule/${this.doctor.id}/set-working`, formData)
                .then(response => {
                    this.schedules = response.data;
                    this.weekReady()
                    this.errMsg = ''
                    // this.$emit('week-change')
                    $(".timeContext").hide();
                    $.jGrowl("Successfully saved!");
                })
                .catch(error => {
                    if (error.response) {
                        let err = error.response.data;
                        this.errMsg = err.message
                    }
                })
                .finally(() =>
                    this.busy = false
                )
        },

        copySchedule: function() {
            this.busy = true;
            let formData = {
                start_date: this.startDateFormatted,
                end_date: this.endDateFormatted,
                week_copy: this.startDateFormatted,
                copy_type: this.copyType,
                num_weeks: this.copyNumWeeks,
                on_weeks: this.copyWeeks,
            }
            axios.post(this.url + '/schedule/week-copy', formData)
                .then(response => {
                    this.schedules = response.data;
                    this.showModal = false
                    this.weekReady()
                    // $.jGrowl("Successfully saved!");
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
