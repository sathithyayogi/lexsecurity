<template>
<div>
      <div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card text-black mb-4">
            <div class="card-header">
            <div class="">No of Active Alarm : <span class="font-weight-bold">{{ Alarmno }}</span></div>
        </div class="d-flex justify-content-center">
            <!-- <h5 class="d-flex justify-content-center">{{ Alarmno }}</h5> -->
        </div>
    </div>
    </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            // this.loadDevices();
             setInterval(this.loadDevices, 2000);
                //             Echo.channel('DemoChannel')
                // .listen('WebsocketDemoEvent', (e) => {
                // this.loadDevices();
                // console.log("demo channel");
                // });
        },
                methods: {
            loadDevices: function() {
            axios.get('/api/devices/sum/test')
            .then((response) => {
                // console.log(response.data);
                this.Alarmno = response.data;
            })
            .catch(function(error) {
                console.log(error);
            });
            }
        },
              data: function() {
            return {
                Alarmno: ''
            }
        },
    }
</script>
