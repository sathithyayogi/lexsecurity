<?php

namespace App\Http\Controllers;

use App\Device;
use Illuminate\Http\Request;
use App\DeviceApi;
use App\Events\DeviceDiagnosticsEvent;
use SebastianBergmann\Environment\Console;
use App\Events\WebsocketDemoEvent;
use App\Events\DeviceDiagnosticShow;
use Carbon\Carbon;
use DB;

class deviceApiController extends Controller
{
    //
    public function devices(){
        return response()->json(DeviceApi::get(), 200);
    }

    public function devicesByID($id){
        return response()->json(DeviceApi::find($id), 200);
    }

    public function devicesSave(Request $request){
        //deviceName, deviceID, mobileNumber must
        $device = Device::create($request->all());
        return response()->json($device, 200);
    }

    public function deviceUpdate(Request $request, DeviceApi $deviceapi){
        $deviceapi->update($request->all());
        return response()->json($deviceapi, 200);
    }


    public function deviceInit(Request $request, $id, Device $device){
        $device = Device::find($id);
        $device->initialized = 1;
        $device->save();
        broadcast(new DeviceDiagnosticShow($device));
        broadcast(new DeviceDiagnosticsEvent($device));
        //Device Initialization
        return response()->json($device, 200);
    }

    public function devicealarmOneStart(Request $request, $id, Device $device){
        $device = Device::find($id);
        $device->alarmRaisedNo++;
        $device->alarmActiveNo = 1;
        $device->alarmOneRunStatus = 1;
        $device->alarmOneTime = Carbon::now('Asia/Kolkata');
        $device->save();

        broadcast(new DeviceDiagnosticShow($device));
        broadcast(new DeviceDiagnosticsEvent($device));
        //Alarm One Start
        return response()->json($device, 200);
    }

    public function devicealarmOneStop(Request $request, $id, Device $device){
        $device = Device::find($id);
        $device->alarmActiveNo = 0;
        $device->alarmOneRunStatus = 0;

        $alarmonetime = DB::table('devices')
        ->where('id', '=', $id)->pluck('created_at');

        $alarmonetimetwo = DB::table('devices')
        ->where('id', '=', $id)->pluck('updated_at');

        $alarmonetottimeprev = DB::table('devices')
        ->where('id', '=', $id)->pluck('alarmonetotTime');

        // $device->alarmonetotTime = 10 + $alarmonetottimeprev[0];

        $device->save();
        broadcast(new DeviceDiagnosticShow($device));
        broadcast(new DeviceDiagnosticsEvent($device));
        //Alarm One Stop

        return response()->json($device, 200);
    }

    public function devicealarmTwoStart(Request $request, $id, Device $device){
        $device = Device::find($id);
        $device->alarmRaisedNo++;
        $device->alarmActiveNo = 2;
        $device->alarmOneRunStatus = 0;
        $device->alarmTwoRunStatus = 1;
        $device->alarmTwoTime = Carbon::now('Asia/Kolkata');
        $device->save();
        //Alarm One Start
        broadcast(new DeviceDiagnosticShow($device));
        broadcast(new DeviceDiagnosticsEvent($device));
        return response()->json($device, 200);
    }

    public function devicealarmTwoStop(Request $request, $id, Device $device){
        $device = Device::find($id);
        $device->alarmActiveNo = 0;
        $device->alarmOneRunStatus = 0;
        $device->alarmTwoRunStatus = 0;
        $device->save();

        //Alarm One Stop
        broadcast(new DeviceDiagnosticShow($device));
        broadcast(new DeviceDiagnosticsEvent($device));
        return response()->json($device, 200);
    }
}
