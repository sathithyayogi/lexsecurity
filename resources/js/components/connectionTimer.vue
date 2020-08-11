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
        props: ['year', 'month', 'date', 'hour', 'minute', 'second', 'millisecond'],
        mounted() {
            this.showRemaining();
            console.log('Component mounted.')
        },
        data(){
            return {
                displayDays: 0,
                displayHours: 0,
                displayMinutes: 0,
                displaySeconds: 0
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
                return new Date(
                    this.year,
                    this.month,
                    this.date,
                    this.hour,
                    this.minute,
                    this.second,
                    this.millisecond
                );
            }
        },
        methods: {
            formatNum: num => (num < 10 ? "0" + num : num),

            showRemaining() {
                const timer = setInterval(()=> {
                    const now = new Date();
                    // const end = new Date(2020, 4, 22, 10, 10, 10);
                    const distance = now.getTime() - this.end.getTime();

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
