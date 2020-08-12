<template>
<div>
    <div class="row">
                <div class="col-xl-6">

                <div class="card mb-4" v-for="device in devices">
                  <div class="card-header">
                      <div class="row">
                      <div class="col-xl-6"> <i class="fas fa-tachometer-alt mr-1"></i>
                       <a :href="'/diagnostics/' + device.id">
                            {{device.deviceName}} - {{ device.deviceID }}
                        </a></div>
                        <div class="col-xl-6">
                          <div class="circleindicatorsmall red"></div>
                        </div>
                    </div>
                  </div>

                  <div class="card-body" v-if="device.initialized == 0">
                    <h4>Device Not Initialized</h4>
                  </div>

                  <div class="card-body" v-if="device.initialized == 1">

                    <div class="row">
                      <div class="col-xl-6">
                        <span class="badge badge-success" v-if="device.connectionStatus == 1">Connected</span>
                        <span class="badge badge-danger" v-else-if="device.connectionStatus == 0">Not Connected</span>
                      </div>

                      <div class="col-xl-6">
                          <div class="row">
                            <p class="font-weight-bold" v-if="device.connectionStatus == 1">{{device.connectionTime}}</p>
                            <p class="font-weight-bold" v-else-if="device.connectionStatus == 0">00:00:00</p>

                            <a  data-toggle="tooltip" data-placement="right" title="Elopsed Time">
                            <i class="fas fa-info-circle"></i>

                            </a>
                        </div>
                      </div>

                    </div>

                    <div class="row">
                      <div class="col-xl-6 font-weight-bold">No. Of Alarm Raised</div>
                      <div class="col-xl-6 font-weight-bold">No. Of Active Alarm</div>
                      <div class="col-xl-6" >{{ device.alarmRaisedNo }}</div>
                      <div class="col-xl-6">{{ device.alarmActiveNo }}</div>
                    </div>

                 <div class="row">
                        <div class="col-xl-6"> <strong> Alarm 1 Active Time</strong></div>
                        <div class="col-xl-6"> <strong> Alarm 2 Active Time</strong></div>
                        <div class="col-xl-6" v-if="device.alarmOneRunStatus == 1">
                            <alarm-one :timestamp = device.alarmOneTime :addtime = device.alarmonetotTime /></div>
                           <div class="col-xl-6" v-else-if="device.alarmOneRunStatus == 0">{{ device.alarmonetotTime }}</div>

                            <div class="col-xl-6" v-if="device.alarmTwoRunStatus == 1">
                            <alarm-one :timestamp = device.alarmTwoTime :addtime = device.alarmtwototTime /></div>
                           <div class="col-xl-6" v-if="device.alarmTwoRunStatus == 0"> {{ device.alarmtwototTime }} </div>
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
                this.loadDevices();
                console.log("success");
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
            })
            .catch(function(error) {
                console.log(error);
            });
            }
        },
    }
</script>
