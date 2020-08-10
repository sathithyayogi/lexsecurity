@extends('layouts.app')

@section('content')
<main>
    <div class="container-fluid">
      <h1 class="mt-4">Diagnostics</h1>
      <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item active">Diagnostics</li>
      </ol>

      <div class="row">

        @if (count($devices) > 0)
            @foreach ($devices as $device)

            <div class="col-xl-6">
                <div class="card mb-4">
                  <div class="card-header">
                      <div class="row">
                      <div class="col-xl-6"> <i class="fas fa-tachometer-alt mr-1"></i>
                        <a href="/diagnostics/{{ $device->id }}">
                        {{$device->deviceName}} - {{$device->deviceID}}</a></div>
                        <div class="col-xl-6">
                          <div class="circleindicatorsmall red"></div>
                            <!-- <span class="rounded-circle"><i class="fas fa-circle mr-1"></i></span> -->

                        </div>
                    </div>

                  </div>
                  <div class="card-body">
                    <h1></h1>
                    @if ($device->initialized == 0)
                    <h6>Device Not Initalized</h6>
                    @elseif($device->initialized == 1)

                    <div class="row">
                      <div class="col-xl-6">
                        @if ($device->connectionStatus == 0)
                        <span class="badge badge-danger">Not Connected</span>
                        @elseif ($device->connectionStatus == 1)
                        <span class="badge badge-success">Connected</span>
                        @endif

                        <!-- <span class="badge badge-danger">NOT CONNECTED</span> -->
                      </div>

                      <div class="col-xl-6">
                          <div class="row">
                        <p class="font-weight-bold" id="{{$device->deviceID}}">05:45:05</p>
                        <a  data-toggle="tooltip" data-placement="right" title="Elopsed Time">
                            <i class="fas fa-info-circle"></i>
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xl-6 font-weight-bold">No. Of Alarm Raised</div>
                      <div class="col-xl-6 font-weight-bold">No. Of Active Alarm</div>

                      <div class="col-xl-6">{{$device->alarmRaisedNo}}</div>
                      <div class="col-xl-6">{{$device->alarmActiveNo}}</div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6"> <strong> Alarm 1 Active Time</strong></div>
                        <div class="col-xl-6"> <strong> Alarm 2 Active Time</strong></div>
                        <div class="col-xl-6">05:45:10</div>
                        <div class="col-xl-6">05:45:10</div>
                    </div>
                    @endif
                  </div>
                </div>

            </div>
            @endforeach

        @endif


      </div>
    </div>
  </main>
  @endsection

  <script>
    //Define vars to hold time values
let seconds = 0;
let minutes = 0;
let hours = 0;
let day = 0;

//Define vars to hold "display" value
let displaySeconds = 0;
let displayMinutes = 0;
let displayHours = 0;

//Define var to hold setInterval() function
let interval = null;

//Define var to hold stopwatch status
let status = "stopped";

//Stopwatch function (logic to determine when to increment next value, etc.)
function stopWatch(){

    seconds++;

    //Logic to determine when to increment next value
    if(seconds / 60 === 1){
        seconds = 0;
        minutes++;

        if(minutes / 60 === 1){
            minutes = 0;
            hours++;

            if(hours /24 ===1){
                hours = 0;
                day++;
            }
        }
    }

    //If seconds/minutes/hours are only one digit, add a leading 0 to the value
    if(seconds < 10){
        displaySeconds = "0" + seconds.toString();
    }
    else{
        displaySeconds = seconds;
    }

    if(minutes < 10){
        displayMinutes = "0" + minutes.toString();
    }
    else{
        displayMinutes = minutes;
    }

    if(hours < 10){
        displayHours = "0" + hours.toString();
    }
    else{
        displayHours = hours;
    }
    //Display updated time values to user
    if(day == 0){
        document.getElementById("{{$device->deviceID}}").innerHTML = displayHours + ":" + displayMinutes + ":" + displaySeconds;
    }else{
        document.getElementById("{{$device->deviceID}}").innerHTML = day+ "d :"+ displayHours + ":" + displayMinutes + ":" + displaySeconds;
    }
}
window.setInterval(stopWatch, 1000);
console.log("{{$device->deviceID}}");
</script>
