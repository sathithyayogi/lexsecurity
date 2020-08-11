<template>
<div>
    <div class="row">
             <div class="col-xl-3" v-for="device in devices">
        <div class="card xl-3">
          <div class="card-header">
            <div class="row">
              <div class="col-xl-12">
                DeviceOne
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="circleindicator red"></div>
            <div class="row">
              <div class="col-xl-6">
                <span class="badge badge-success">CONNECTED</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</template>

<script>
    export default {
        mounted() {
            this.loadDevices();
                        Echo.channel('DeviceDiag')
.listen('DeviceDiagnosticsEvent', (device) => {
console.log(device.device.alarmRaisedNo);

console.log("pls work");
});
        },
        data: function() {
            return {
                devices: [],
                AlarmRaised: '',
                dID: ''
            }
        },

        methods: {
            loadDevices: function() {
            console.log('Device Loaded.');
            axios.get('/api/devices')
            .then((response) => {
                this.devices = response.data
                console.log(response.data);
            })
            .catch(function(error) {
                console.log(error);
            });
            }
        },
    }
</script>
