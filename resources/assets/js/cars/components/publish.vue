<template>
    <div>
        <mt-navbar v-model="selected" :fixed="true">
            <mt-tab-item id="passenger">乘客找车信息</mt-tab-item>
            <mt-tab-item id="driver">司机发车信息</mt-tab-item>
        </mt-navbar>
        <!-- tab-container -->
        <div class="container" style="overflow: scroll;margin-bottom: 2rem;margin-top: 3rem">
        <mt-tab-container v-model="selected">
            <mt-tab-container-item id="passenger">
                <div class="aui-content aui-margin-b-15">
                    <ul class="aui-list aui-list-in">
                        <li class="aui-list-header">
                            乘车人信息
                        </li>
                        <li class="aui-list-item">
                            <div class="aui-list-item-inner">
                                <div class="aui-list-item-label">
                                    姓名
                                </div>
                                <div class="aui-list-item-input">
                                    <input type="text" placeholder="如何称呼您" v-model="passenger.name">
                                </div>
                            </div>
                        </li>
                        <li class="aui-list-item">
                            <div class="aui-list-item-inner">
                                <div class="aui-list-item-label">
                                    性别
                                </div>
                                <div class="aui-list-item-input">
                                    <label>
                                        <input class="aui-radio" type="radio" name="sex" checked> 男士
                                    </label>
                                    <label>
                                        <input class="aui-radio" type="radio" name="sex"> 女士
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li class="aui-list-item">
                            <div class="aui-list-item-inner">
                                <div class="aui-list-item-label">
                                    电话
                                </div>
                                <div class="aui-list-item-input">
                                    <input type="number" placeholder="您的联系方式" v-model="passenger.phone">
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="aui-list aui-list-in">
                        <li class="aui-list-header">
                            拼车信息
                        </li>
                        <li class="aui-list-item">
                            <div class="aui-list-item-inner">
                                <div class="aui-list-item-label">
                                    出发地
                                </div>
                                <div class="aui-list-item-input">
                                    <input type="text" v-model="passenger.from_place">
                                </div>
                            </div>
                        </li>
                        <li class="aui-list-item">
                            <div class="aui-list-item-inner">
                                <div class="aui-list-item-label">
                                    目的地
                                </div>
                                <div class="aui-list-item-input">
                                    <input type="text" v-model="passenger.to_place">
                                </div>
                            </div>
                        </li>
                        <li class="aui-list-item">
                            <div class="aui-list-item-inner aui-list-item-arrow" @click="openDatePicker">
                                <div class="aui-list-item-title">出发日期</div>
                                <div class="aui-list-item-right">{{passenger.date}}</div>
                            </div>
                        </li>
                        <li class="aui-list-item">
                            <div class="aui-list-item-inner aui-list-item-arrow" @click="openTimePicker">
                                <div class="aui-list-item-title">出发时刻</div>
                                <div class="aui-list-item-right">{{passenger.clock}}</div>
                            </div>
                        </li>
                        <li class="aui-list-item">
                            <div class="aui-list-item-inner aui-list-item-arrow" @click="popupVisible=true">
                                <div class="aui-list-item-title">乘车人数</div>
                                <div class="aui-list-item-right">{{passenger.number}}</div>
                            </div>
                        </li>
                    </ul>
                    <mt-button class="aui-col-xs-12" type="primary">提交信息</mt-button>
                </div>
                <mt-popup v-model="popupVisible" :position="position" style="width: 80%">
                    <mt-picker :slots="slots" @change="choiceNum" :visibleItemCount="3">
                        <div class="number">
                        </div>
                    </mt-picker>
                </mt-popup>
                <mt-datetime-picker
                        ref="dateDicker"
                        type="date"
                        v-model="dateValue"
                        @confirm="confirmDate">
                </mt-datetime-picker>
                <mt-datetime-picker
                        ref="timeDicker"
                        type="time"
                        v-model="timeValue"
                        @confirm="confirmTime">
                </mt-datetime-picker>

            </mt-tab-container-item>
            <mt-tab-container-item id="driver">
2
            </mt-tab-container-item>
        </mt-tab-container>
        </div>
        <main-footer v-bind:path="footer">
        </main-footer>
    </div>
</template>
<script>
    import MainFooter from './footer';
    import { Navbar, TabItem, Field, DatetimePicker, Button, Picker, Popup} from 'mint-ui';
    export default {
        components: {
            MainFooter,
            Navbar,
            TabItem,
            Field,
            DatetimePicker,
            'mt-button':Button,
            Picker,
            Popup
        },
        data:function () {
            return {
                footer:'/publish',
                selected:"passenger",
                popupVisible:false,
                position:'bottom',
                passenger:{

                },
                driver:{

                },
                dateValue:'',
                timeValue:'',
                slots:[{
                    values: ['1', '2', '3', '4', '5', '6','7','8'],
                    className:'number'
                }]
            }
        },
        methods:{
            openDatePicker() {
                this.$refs.dateDicker.open();
            },
            openTimePicker() {
                this.$refs.timeDicker.open();
            },
            choiceNum(){

            },
            confirmDate(val){
                var date = this.getformat(val);
                console.log(date);
            },
            confirmTime(val){
                console.log(val);
            },
            getformat(val){
                var year = val.getFullYear();
                var month =val.getMonth() + 1;
                if (month < 10){
                    month = '0' + month;
                }
                var day = val.getDate();
                if (day < 10){
                    day = '0' + day;
                }
                var famatDate = year + '-' + month + '-' + day;
                return famatDate;
            }
        }
    }
</script>
<style>
</style>