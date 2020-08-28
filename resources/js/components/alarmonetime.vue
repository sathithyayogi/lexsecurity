<template>
    <div class="container">
        {{ displayDays }} :
        {{ displayHours }} :
        {{ displayMinutes }} :
        {{ displaySeconds }}
    </div>
</template>

<script>
    export default {
        props: ['timestamp', 'addtime', 'deviceID', 'deviceno', 'deviceone', 'devicetwo'],
        mounted() {
            this.showRemaining();
            // var date = new Date(this.TimeSTamp);
            // console.log(date.getMonth() + 1);
            // console.log(date.getFullYear());
            // console.log(date.getDate());
            // console.log(date.getHours());
            // console.log(date.getMinutes());
            // console.log(date.getSeconds());
            // const now = new Date();
            // console.log(now.getHours());
            // console.log('Component mounted.')

        },
        data(){
            return {
                displayDays: 0,
                displayHours: 0,
                displayMinutes: 0,
                displaySeconds: 0,
                TimeSTamp: this.timestamp,
                AddTime: this.addtime,
                dID: this.deviceID,
                dno : this.deviceno
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

            var hms = this.addtime;             // your input string
            var a = hms.split(':');             // split it at the colons

            // minutes are worth 60 seconds. Hours are worth 60 minutes.
            var secondsremain = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]);

                    const now = new Date();
                    // const end = new Date(2020, 4, 22, 10, 10, 10);
                var distance = now.getTime() - this.end.getTime();
                distance = distance + secondsremain * 1000;
                console.log(secondsremain);

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
                    if(this.displayHours == 23 && this.displayMinutes == 59 && this.displaySeconds == 59){
                        if(this.deviceno == 1){
                            this.updateone();
                        }else if(this.deviceno == 2){
                            this.updatetwo();
                        }
                    }
                }, 1000);
            },
            updateone: function() {
                axios.get('/api/devices/update/dayone/'+this.deviceID)
            .then((response) => {
            })
            .catch(function(error) {
                console.log(error);
            });

            },
            updatetwo: function(){
                            axios.get('/api/devices/update/daytwo/'+this.deviceID)
            .then((response) => {
                this.devices = response.data
            })
            .catch(function(error) {
                console.log(error);
            });

            }
        }
    };
</script>
