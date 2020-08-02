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
                        {{$device->deviceName}} - {{$device->deviceID}}</div>
                        <div class="col-xl-6"> 
                            <!-- <span class="rounded-circle"><i class="fas fa-circle mr-1"></i></span> -->
                         
                        </div>
                    </div>
                    
                  </div>
                  <div class="card-body">
                    <h1></h1>
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
                        <p class="font-weight-bold">05:45:05</p>
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
      
                  </div>
                </div>
              
            </div>
                
            @endforeach
            
        @endif
     
        
      </div>
    </div>
  </main>
  @endsection