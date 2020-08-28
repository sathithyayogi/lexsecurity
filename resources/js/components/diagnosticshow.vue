<template>
<div>
<div class="container-fluid">
      <div class="row">
              <div class="col-xl-6">
                <div class="card mb-4">
                  <div class="card-header">
                      <div class="row">
                      <div class="col-6"> <i class="fas fa-tachometer-alt mr-1"></i>{{ deviceName }} - {{ deviceID }}</div>
                        <div class="col-6" v-if="conStatus == 1">
                          <div class="circleindicatorsmall red" v-if="MoveStatus == 0"></div>
                          <div class="circleindicatorsmall yellow" v-else-if="MoveStatus == 1"></div>
                          <div class="circleindicatorsmall green" v-else-if="MoveStatus == 2"></div>
                          <div class="circleindicatorsmall grey" v-else-if="MoveStatus == 3"></div>
                        </div>
                        <div class="col-xl-6" v-else-if="conStatus == 0">
                          <div class="circleindicatorsmall grey"></div>
                        </div>
                    </div>
                  </div>


                  <div class="card-body" v-if="Init == 0">
                    <h4>Device Not Initialized</h4>
                  </div>

                  <div class="card-body" v-if="Init == 1">
                    <h1></h1>
                    <div class="row">
                      <div class="col-6">

                        <span class="badge badge-success" v-if="connstatus == 1">Connected</span>
                        <span class="badge badge-danger" v-else-if="connstatus == 0">Disconnected</span>
                      </div>

                      <div class="col-6">
                          <div class="row">
                        <p class="font-weight-bold" v-if="connstatus == 1">
                                   <conn-time :timestamp = conStatusTime />
                        </p>
                        <p class="font-weight-bold" v-else-if="connstatus == 0">00:00:00</p>

                        <!-- <a  data-toggle="tooltip" data-placement="right" title="Elopsed Time">
                            <i class="fas fa-info-circle"></i>
                          </a> -->
                        </div>
                      </div>
                    </div>

                       <div class="row">
                      <div class="col-xl-6 font-weight-bold">No. Of Alarm Raised</div>
                      <div class="col-xl-6 font-weight-bold"></div>
                      <div class="col-xl-6" >{{ AlarmRaised }}</div>
                      <div class="col-xl-6"></div>
                    </div>

                    <!-- <div class="row">
                        <div class="col-xl-6"> <strong> Alarm 1 Active Time</strong></div>
                        <div class="col-xl-6"> <strong> Alarm 2 Active Time</strong></div>
                        <div class="col-xl-6" v-if="AlarmOneRunStatus == 1">
                            <alarm-one
                        :timestamp = timeActiveAlarmOne
                        :addtime = AlarmTotOneTime
                        />
                        </div>
                           <div class="col-xl-6" v-else-if="AlarmOneRunStatus == 0">{{AlarmTotOneTime}} </div>

                            <div class="col-xl-6" v-if="AlarmTwoRunStatus == 1">
                            <alarm-one
                        :timestamp = timeActiveAlarmTwo
                        :addtime = AlarmTotTwoTime
                        />
                        </div>
                           <div class="col-xl-6" v-else-if="AlarmTwoRunStatus == 0">{{AlarmTotTwoTime}} </div>
                    </div> -->



                                     <div class="row">
                    <div class="col-6 p-0">
                      <div class="col-xl-12 font-weight-bold">Alarm 1 Active Time</div>
                      <div class="col-xl-0 font-weight-bold"></div>
                          <div class="col-xl-12 p-0" v-if="AlarmOneRunStatus == 1">
                                  <alarm-one
                        :timestamp = timeActiveAlarmOne
                        :addtime = AlarmTotOneTime
                        />
                        </div>
                           <div class="col-xl-6" v-else-if="AlarmOneRunStatus == 0">{{ AlarmTotOneTime }}</div>
                      <div class="col-xl-0"></div>
                    </div>

                            <div class="col-6 p-0">
                      <div class="col-xl-12 font-weight-bold">Alarm 2 Active Time</div>
                      <div class="col-xl- font-weight-bold"></div>
                          <div class="col-xl-12 p-0" v-if="AlarmTwoRunStatus == 1">

                                        <alarm-one
                        :timestamp = timeActiveAlarmTwo
                        :addtime = AlarmTotTwoTime
                        />
                            </div>
                           <div class="col-xl-6" v-if="AlarmTwoRunStatus == 0"> {{ AlarmTotTwoTime }} </div>
                      <div class="col-xl-0"></div>
                    </div>
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
        props: ['devid', 'deviceid', 'devicename', 'connstatus', 'connstatustime', 'noalarmraised', 'noalarmactive', 'timeactivealarmone', 'timeactivealarmtwo', 'alarmonetottime', 'alarmtwotottime', 'alarmonerunstatus', 'alarmtworunstatus', 'initialized', 'movementstatus'],

        data() {
            return {
                dID: this.devid,
                deviceID: this.deviceid,
                deviceName: this.devicename,
                MoveStatus:this.movementstatus,
                conStatus: this.connstatus,
                conStatusTime: this.connstatustime,
                AlarmRaised: this.noalarmraised,
                AlarmActive: this.noalarmactive,
                timeActiveAlarmOne: this.timeactivealarmone,
                timeActiveAlarmTwo: this.timeactivealarmtwo,
                AlarmTotOneTime: this.alarmonetottime,
                AlarmTotTwoTime: this.alarmtwotottime,
                AlarmOneRunStatus: this.alarmonerunstatus,
                AlarmTwoRunStatus: this.alarmtworunstatus,
                Init: this.initialized
            }
        },

        mounted() {
            Echo.channel('DeviceDiagShow.' + this.devid)
.listen('DeviceDiagnosticShow', (device) => {
    this.dID = device.device.id
    this.deviceID = device.device.deviceID
    this.deviceName = device.device.deviceName
    this.conStatus = device.device.connectionStatus
    this.conStatusTime = device.device.connectionTime
    this.AlarmRaised = device.device.alarmRaisedNo
    this.AlarmActive = device.device.alarmActiveNo
    this.timeActiveAlarmOne = device.device.alarmOneTime
    this.timeActiveAlarmTwo = device.device.alarmTwoTime
    this.AlarmOneRunStatus = device.device.alarmOneRunStatus
    this.AlarmTwoRunStatus = device.device.alarmTwoRunStatus
    this.AlarmTotOneTime = device.device.alarmonetotTime
    this.AlarmTotTwoTime = device.device.alarmtwototTime
    this.Init = device.device.initialized
    this.MoveStatus = device.device.movementStatus
 console.log('success');
 console.log(device);
 console.log(this.connstatustime);
    // this.AlarmActive =
});
            Echo.channel('DemoChannel')
                .listen('WebsocketDemoEvent', (e) => {
                // this.loadDevices();
                console.log("diagnostics Show ");
                });
        }
    }
</script>
