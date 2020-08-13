<template>
    <div class="container">
        {{ displayDays }}
        {{ displayHours }}
        {{ displayMinutes }}
        {{ displaySeconds }}
    </div>
</template>

<script>
    export default {
        props: ['timestamp'],
        mounted() {

            this.showRemaining();


        },
        data(){
            return {
                displayDays: 0,
                displayHours: 0,
                displayMinutes: 0,
                displaySeconds: 0,
                TimeSTamp: this.timestamp,
            }
        },
        computed: {
            _seconds: () => 1000,
            _minutes() {
                return this._seconds * 60
            },
            _hours() {
                return this._minutes * 60
            },
            _days() {
                return this._hours * 24
            },
            end() {
                var date = new Date(this.TimeSTamp);
                return new Date(
                    this.year =date.getFullYear(),
                    this.month = date.getMonth(),
                    this.date = date.getDate(),
                    this.hour = date.getHours(),
                    this.minute = date.getMinutes(),
                    this.second = date.getSeconds(),
                    this.millisecond = 0
                );
            }
        },
        methods: {
            formatNum: num => (num < 10 ? "0" + num : num),

            showRemaining() {
                const timer = setInterval(()=> {


                    const now = new Date();
                    // const end = new Date(2020, 4, 22, 10, 10, 10);
                var distance = now.getTime() - this.end.getTime();

                    if(distance < 0){
                        clearInterval(timer);
                            return;
                    }

                    const days = Math.floor((distance / this._days));
                    const hours = Math.floor((distance % this._days) / this._hours);
                    const minutes = Math.floor((distance % this._hours) / this._minutes);
                    const seconds = Math.floor((distance % this._minutes) / this._seconds);
                    this.displayMinutes = this.formatNum(minutes);
                    this.displaySeconds = this.formatNum(seconds);
                    this.displayHours = this.formatNum(hours);
                    this.displayDays = this.formatNum(days);
                }, 1000);
            }
        }
    };
</script>
