<template>
<div>
    <div class="row">
                <div class="col-xl-6" v-for="device in devices">

                <div class="card mb-4" >
                  <div class="card-header">
                      <div class="row">
                      <div class="col-6"> <i class="fas fa-tachometer-alt mr-1"></i>
                       <!-- <a :href="'/diagnostics/' + device.id"> -->
                       <a >{{device.deviceName}} - {{ device.deviceID }}</a>
                        </div>
                        <div class="col-6 d-flex justify-content-center"  v-if="device.connectionStatus == 1">
                          <div class="circleindicatorsmall red" v-if="device.movementStatus == 0"></div>
                          <div class="circleindicatorsmall yellow" v-else-if="device.movementStatus == 1"></div>
                          <div class="circleindicatorsmall green" v-else-if="device.movementStatus == 2"></div>
                          <div class="circleindicatorsmall grey" v-else-if="device.movementStatus == 3"></div>
                        </div>
                        <div class="col-xl-6" v-else-if="device.connectionStatus == 0">
                          <div class="circleindicatorsmall grey"></div>
                        </div>
                    </div>
                  </div>

                  <div class="card-body" v-if="device.initialized == 0">
                    <h4>Device Not Initialized</h4>
                  </div>

                  <div class="card-body" v-if="device.initialized == 1">

                    <div class="row">
                      <div class="col-6">
                        <span class="badge badge-success" v-if="device.connectionStatus == 1">Connected</span>
                        <span class="badge badge-danger" v-else-if="device.connectionStatus == 0">Not Connected</span>
                      </div>

                      <div class="col-6">
                          <div class="row">
                            <p class="font-weight-bold" v-if="device.connectionStatus == 1">
                                <conn-time :timestamp = device.connectionTime />
                                </p>
                            <p class="font-weight-bold" v-else-if="device.connectionStatus == 0">00:00:00
                            </p>

                            <!-- <a  data-toggle="tooltip" data-placement="right" class="col-2 p-0" title="Elopsed Time">
                            <i class="fas fa-info-circle"></i>
                            </a> -->


                        </div>
                      </div>

                    </div>

                    <div class="row">
                      <div class="col-xl-6 font-weight-bold">No. Of Alarm Raised</div>
                      <div class="col-xl-6 font-weight-bold"></div>
                      <div class="col-xl-6" >{{ device.alarmRaisedNo }}</div>
                      <div class="col-xl-6"></div>
                    </div>

                 <!-- <div class="row">
                        <div class="col-xl-6"> <strong> Alarm 1 Active Time</strong></div>
                        <div class="col-xl-6"> <strong> Alarm 2 Active Time</strong></div>
                        <div class="col-xl-6" v-if="device.alarmOneRunStatus == 1">
                           <alarm-one :timestamp = device.alarmOneTime :addtime = device.alarmonetotTime />
                        </div>
                           <div class="col-xl-6" v-else-if="device.alarmOneRunStatus == 0">{{ device.alarmonetotTime }}</div>

                            <div class="col-xl-6" v-if="device.alarmTwoRunStatus == 1">
                                <alarm-one :timestamp = device.alarmTwoTime :addtime = device.alarmtwototTime />
                            </div>
                           <div class="col-xl-6" v-if="device.alarmTwoRunStatus == 0"> {{ device.alarmtwototTime }} </div>
                    </div> -->

                    <div class="row">
                    <div class="col-6 p-0">
                      <div class="col-xl-12 font-weight-bold">
                          Alarm 1 Active Time</div>
                      <div class="col-xl-0 font-weight-bold"></div>
                          <div class="col-xl-12 p-0" v-if="device.alarmOneRunStatus == 1">
                           <alarm-one :timestamp = device.alarmOneTime :addtime = device.alarmonetotTime :deviceID = device.id :deviceno = 1 :dayone = device.alarmonetimeday :daytwo = device.alarmtwotimeday />
                        </div>
                           <div class="col-xl-6" v-else-if="device.alarmOneRunStatus == 0">{{ device.alarmonetimeday }} {{ device.alarmonetotTime }}</div>
                      <div class="col-xl-0"></div>
                    </div>

                            <div class="col-6 p-0">
                      <div class="col-xl-12 font-weight-bold">Alarm 2 Active Time</div>
                      <div class="col-xl- font-weight-bold"></div>
                          <div class="col-xl-12 p-0" v-if="device.alarmTwoRunStatus == 1">
                                   <alarm-one :timestamp = device.alarmOneTime :addtime = device.alarmonetotTime :deviceID = device.id :deviceno = 2 :dayone = device.alarmonetimeday :daytwo = device.alarmtwotimeday />
                            </div>
                           <div class="col-xl-6" v-if="device.alarmTwoRunStatus == 0">{{ device.alarmtwotimeday }} {{ device.alarmtwototTime }} </div>
                      <div class="col-xl-0"></div>
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
                // this.loadDevices();
                setInterval(this.loadDevices, 2000);
                setInterval(this.connupdate, 60000);
                // Echo.channel('DeviceDiag')
                // .listen('DeviceDiagnosticsEvent', (device) => {
                // this.loadDevices();
                // console.log("success");
                // });
                // Echo.channel('DemoChannel')
                // .listen('WebsocketDemoEvent', (e) => {
                // this.loadDevices();
                // console.log("demo channel");
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
            },

            connupdate: function() {
            axios.get('api/device/connupdate')
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
