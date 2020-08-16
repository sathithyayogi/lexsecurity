@extends('layouts.app')

@section('content')
<div class="container-fluid">
      <h1 class="mt-4">Diagnostics</h1>
      <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item"><a href="/diagnostics">Dashboard</a></li>
          <li class="breadcrumb-item active">{{ $device->id }}</li>
      </ol>
    </div>
<diagnostic-show devid="{{ $device->id }}" deviceid="{{ $device->deviceID }}" devicename="{{$device->deviceName}}" connstatus="{{ $device->connectionStatus }}" connstatustime="{{ $device->connectionTime }}" noalarmraised="{{$device->alarmRaisedNo}}" noalarmactive="{{$device->alarmActiveNo}}" timeactivealarmone="{{$device->alarmOneTime}}" timeactivealarmtwo="{{$device->alarmOneTime}}" alarmonetottime="{{$device->alarmonetotTime}}" alarmtwotottime="{{$device->alarmtwototTime}}" alarmonerunstatus = "{{$device->alarmOneRunStatus}}" alarmtworunstatus = "{{$device->alarmTwoRunStatus}}" initialized="{{$device->initialized}}" movementstatus="{{$device->movementStatus}}"></diagnostic-show>
@endsection
