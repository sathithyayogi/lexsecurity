<template>
<div>
    <div class="row">
             <div class="col-xl-3 full mt-2" v-for="device in devices">
        <div class="card xl-3">
          <div class="card-header">
            <div class="row">
              <div class="col-xl-12">
                {{device.deviceName}} - {{ device.deviceID }}
              </div>
            </div>
          </div>
              <div class="card-body" v-if="device.initialized == 0">
                    <h4>Device Not Initialized</h4>
                  </div>
          <div class="card-body" v-if="device.initialized == 1">
              <div v-if="device.connectionStatus == 1">
            <div class="circleindicator red" v-if="device.movementStatus == 0"></div>
            <div class="circleindicator yellow" v-else-if="device.movementStatus == 1"></div>
            <div class="circleindicator green" v-else-if="device.movementStatus == 2"></div>
            </div>
            <div v-else-if="device.connectionStatus == 0">
            <div class="circleindicator grey"></div>
            </div>

            <div class="row">
              <div class="col-xl-6 mt-3">
                <span class="badge badge-success" v-if="device.connectionStatus == 1">Connected</span>
                <span class="badge badge-danger" v-else-if="device.connectionStatus == 0">Not Connected</span>
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
             setInterval(this.loadDevices, 2000);
            // this.loadDevices();
//             Echo.channel('DeviceDiag')
// .listen('DeviceDiagnosticsEvent', (device) => {
//     this.loadDevices();
// });
// Echo.channel('DemoChannel')
// .listen('WebsocketDemoEvent', (e) => {
//       this.loadDevices();
//       console.log("demo channel");
// });

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
            axios.get('/api/devices')
            .then((response) => {
                this.devices = response.data
            })
            .catch(function(error) {
                console.log(error);
            });
            }
        },
    }
</script>
