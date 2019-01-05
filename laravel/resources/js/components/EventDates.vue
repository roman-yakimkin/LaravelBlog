<template>
    <div class="container">
        <div class="row">
            <select name="dates_select" class="form-control custom-select" v-model="dates_option">
                <option value="1">Выбрать даты</option>
                <option value="2">По заявке</option>
                <option value="3">По мере комплектования группы</option>
            </select>
            <input type="hidden" name="dates_result" :value="dates_result" />
        </div>
        <div class="row" v-show="dates_option == 1">
            <div class="col-sm-4">
                <datepicker v-model="calendarDate"
                            name="date_calendar"
                            :inline="true"
                            :language="ru"
                            @selected="elSelected"
                >
                </datepicker>
            </div>
            <div class="col-sm-4">
                <button type="button" class="btn btn-secondary btn-block" v-on:click="addDate">Add date</button>
                <button type="button" class="btn btn-secondary btn-block" v-on:click="removeDate">Remove date</button>
            </div>
            <div class="col-sm-4">
                <select name="dates_list" class="form-control" size="8">
                    <option></option>
                </select>
            </div>
        </div>
        <div class="row">
            <span>{{dates_result}}</span>
        </div>
    </div>
</template>

<script>
    // import FunctionalCalendar from 'vue-functional-calendar';
    // import DatePick from 'vue-date-pick';
    // import 'vue-date-pick/dist/vueDatePick.css';
    import Datepicker from 'vuejs-datepicker';
    import moment from 'moment';
    import {en, ru} from 'vuejs-datepicker/dist/locale'

    let byDemand = ['01.01.2500'];
    let byComplect = ['01.01.2600'];

    export default {
        components: {Datepicker},
        props: [
          'dates'
        ],
        data: function(){
          return {
              dates_result: this.dates,
              dates_option: 1,
              calendarDate: new Date(),
              calendarFormat: 'yyyy-MM-dd',
              calendarConfigs: {
                  sundayStart: false,
                  dateFormat: 'dd.mm.yyyy',
                  placeholder: true,
                  isDatePicker: true,
                  isDateRange: false,
                  monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                  dayNames: ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
                  ondblclick: function(){
                      console.log('!!!!!!');
                  },
              },
              en: en,
              ru: ru,
              calendarTime: {
                  prev: 0,
                  now: 0,
              }
          }
        },
        mounted() {
            console.log("EventDates mounted");
            // console.log([...this.dates]);
            // console.log([...byDemand]);
            // console.log(JSON.stringify(this.dates));
            // console.log(JSON.stringify(byDemand));

            if (JSON.stringify(this.dates) === JSON.stringify(byDemand)){
                this.dates_option = 2;
            }
            else if (JSON.stringify(this.dates) === JSON.stringify(byComplect)){
                this.dates_option = 3;
            }
            else {
                this.dates_option = 1;
                this.dates_list = [...this.dates];
            }


//            this.dates_result = [...this.dates_result, '01.01.2500'];
//            this.dates_option = 2;
//            console.log(this.dates_option);
        },
        methods: {
            setDatesList: function(){
                return 'test'
            },
            changeDatesSelect: function(target) {
                console.log('dates_option: ' + this.dates_option)
                switch (dates_option){
                    case 1:
                        this.dates_result = [...this.dates_list];
                        break;
                    case 2:
                        this.dates_result = [...byDemand];
                        break;
                    case 3:
                        this.dates_result = [...byComplect];
                        break;
                }
            },
            addDate(){
                let formattedDate = moment(this.calendarDate).format('DD.MM.YYYY');
                console.log(formattedDate);
                console.log('Date Added !!!');
            },
            removeDate(){
                console.log('Date removed !!!');
            },
            elSelected(){
                let formattedDate = moment(this.calendarDate).format('DD.MM.YYYY');
                this.calendarTime.prev = this.calendarTime.now;
                this.calendarTime.now = new Date().getTime();
                let interval = this.calendarTime.now-this.calendarTime.prev;
                if (interval < 500){
                    console.log(interval);
                    console.log(formattedDate);
                }
            }
        }
    }
</script>