<template>
    <div class="container">
        <div class="row">
            <select name="dates_select"
                    class="form-control custom-select"
                    v-model="dates_option"
                    @change="changeDatesSelect"
            >
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
                            @selected="calendarSelected"
                >
                </datepicker>
            </div>
            <div class="col-sm-4">
                <button type="button" class="btn btn-secondary btn-block" v-on:click="addDate">Add date</button>
                <button type="button" class="btn btn-secondary btn-block" v-on:click="removeDate">Remove date</button>
            </div>
            <div class="col-sm-4">
                <select name="dates_list"
                        class="form-control"
                        size="8"
                        v-model="dates_list_current"
                        @dblclick="removeDate"
                >
                    <option v-for="one_date in dates_list" :value="one_date">{{one_date}}</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
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
              dates_list: [],
              dates_list_current: "",
              dates_result: [],
              dates_option: 1,
              calendarDate: new Date(),
              calendarFormat: 'yyyy-MM-dd',
              en: en,
              ru: ru,
              calendarTime: {
                  prev: 0,
                  now: 0,
              },
          }
        },
        watch: {
            dates_list: function(val) {
                this.dates_result = [...val];
            }
        },
        mounted() {
            if (JSON.stringify(this.dates) === JSON.stringify(byDemand)){
                this.dates_option = 2;
                this.dates_result = [...byDemand];
            }
            else if (JSON.stringify(this.dates) === JSON.stringify(byComplect)){
                this.dates_option = 3;
                this.dates_result = [...byComplect];
            }
            else {
                this.dates_option = 1;
                this.dates_list = [...this.dates];
            }
            console.log('mounted dates_option: ' + this.dates_option)
        },
        methods: {
            changeDatesSelect: function(target) {
                switch (this.dates_option){
                    case '1':
                        this.dates_result = [...this.dates_list];
                        break;
                    case '2':
                        this.dates_result = [...byDemand];
                        break;
                    case '3':
                        this.dates_result = [...byComplect];
                        break;
                }
            },
            addDate(){
                let formattedDate = moment(this.calendarDate).format('DD.MM.YYYY');
                let index = this.dates_list.indexOf(formattedDate);
                if (index < 0){
                    this.dates_list.push(formattedDate);
                }
            },
            removeDate(){
                if (this.dates_list.length > 0){
                    this.dates_list.splice(this.dates_list.indexOf(this.dates_list_current), 1);
                }
            },
            calendarSelected(){
                this.calendarTime.prev = this.calendarTime.now;
                this.calendarTime.now = new Date().getTime();
                let interval = this.calendarTime.now-this.calendarTime.prev;
                if (interval < 500){
                    this.addDate();
                }
            }
        }
    }
</script>