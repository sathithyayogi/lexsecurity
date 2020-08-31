<?php

namespace App\Http\Controllers;

use App\Device;
use Illuminate\Http\Request;
use App\DeviceApi;
use App\Events\DeviceDiagnosticsEvent;
use App\Events\DeviceDiagnosticShow;
use SebastianBergmann\Environment\Console;
use App\Events\WebsocketDemoEvent;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Cache;

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
        $device->connectionStatus = 1;
        $device->movementStatus = 2;
        $device->connectionTime = Carbon::now('Asia/Kolkata');
        $device->save();

        // broadcast(new DeviceDiagnosticShow($device));
        // broadcast(new DeviceDiagnosticsEvent($device));
        // broadcast(new WebsocketDemoEvent("test"));

        //Device Initialization
        return response()->json($device, 200);
    }

    public function connect(Request $request, $id, Device $device) {
        $device = Device::find($id);

        $constatus = DB::table('devices')
        ->where('id', '=', $id)->pluck('connectionStatus');

        if ($constatus[0] == 0) {
            $device->connectionTime = Carbon::now('Asia/Kolkata');
            $device->connectionStatus = 1;
            $device->movementStatus = 2;
        }elseif ($constatus[0] == 1) {
            $device->connectionStatus = 1;
        }
        $expiresAt = Carbon::now()->addMinutes(3);
        Cache::put('device-is-connected'.$id, true, $expiresAt);
        $device->save();

        // broadcast(new DeviceDiagnosticShow($device));
        // broadcast(new DeviceDiagnosticsEvent($device));
        // broadcast(new WebsocketDemoEvent("test"));
        return response()->json($device, 200);
    }

    public function devicealarmOneStart(Request $request, $id, Device $device){
        $device = Device::find($id);
        $device->alarmRaisedNo++;
        $device->alarmActiveNo = 1;
        $device->alarmOneRunStatus = 1;
        $device->movementStatus = 1;
        $device->alarmOneTime = Carbon::now('Asia/Kolkata');

        $dt = Carbon::now('Asia/Kolkata');
        $timestr = $dt->format('H:i:s');
        $device->connTimeUpdate = $timestr;


        //conn
        $constatus = DB::table('devices')
        ->where('id', '=', $id)->pluck('connectionStatus');

        if ($constatus[0] == 0) {
            $device->connectionTime = Carbon::now('Asia/Kolkata');
            $device->connectionStatus = 1;
            // $device->movementStatus = 2;
            $device->movementStatus = 1;
        }elseif ($constatus[0] == 1) {
            $device->connectionStatus = 1;
        }
        $expiresAt = Carbon::now()->addMinutes(3);
        Cache::put('device-is-connected'.$id, true, $expiresAt);
        //conn
        $device->save();

        $contactNumber = DB::table('devicesetting')
        ->where('id', '=', $id)->pluck('mobileNumber');

        $devicename = DB::table('devices')
        ->where('id', '=', $id)->pluck('deviceID');

        $response = file_get_contents('https://api-mapper.clicksend.com/http/v2/send.php?method=http&username=sathithyayogi@spearfox.com&key=193C3686-57B6-966F-4EA1-6BFEFB7CC8E4&to='.$contactNumber[0].'&message=Device '.$devicename[0].' stationary for 30 seconds');


        // broadcast(new DeviceDiagnosticShow($device));
        // broadcast(new DeviceDiagnosticsEvent($device));
        // broadcast(new WebsocketDemoEvent("test"));
        //Alarm One Start
        return response()->json($device, 200);
    }

    public function devicealarmOneStop(Request $request, $id, Device $device){
        $device = Device::find($id);
        $device->alarmActiveNo = 0;
        $device->alarmOneRunStatus = 0;
        $device->movementStatus = 2;
        $alarmonetime = DB::table('devices')
        ->where('id', '=', $id)->pluck('alarmOneTime');

        $currenttime = Carbon::now('Asia/Kolkata');

        $alarmonetottimeprev = DB::table('devices')
        ->where('id', '=', $id)->pluck('alarmonetotTime');

        $timeFirst  = strtotime($alarmonetime[0]);
        $timeSecond = strtotime($currenttime);
        $differenceInSeconds = $timeSecond - $timeFirst;

        $dt = Carbon::now('Asia/Kolkata');
        $timestr = $dt->format('H:i:s');
        $device->connTimeUpdate = $timestr;

        $device->alarmonetotTime = (new Carbon($alarmonetottimeprev[0]))->addSeconds($differenceInSeconds);

                //conn
                $constatus = DB::table('devices')
                ->where('id', '=', $id)->pluck('connectionStatus');

                if ($constatus[0] == 0) {
                    $device->connectionTime = Carbon::now('Asia/Kolkata');
                    $device->connectionStatus = 1;
                    $device->movementStatus = 2;
                }elseif ($constatus[0] == 1) {
                    $device->connectionStatus = 1;
                }
                $expiresAt = Carbon::now()->addMinutes(3);
                Cache::put('device-is-connected'.$id, true, $expiresAt);
                //conn

        $device->save();

        // broadcast(new DeviceDiagnosticShow($device));
        // broadcast(new DeviceDiagnosticsEvent($device));
        // broadcast(new WebsocketDemoEvent("test"));
        //Alarm One Stop
        // return $differenceInSeconds;
        // return $alarmonetime[0] ." ". $currenttime . " ". (new Carbon($alarmonetottimeprev[0]))->addSeconds(61);
        return response()->json($device, 200);
    }

    public function devicealarmTwoStart(Request $request, $id, Device $device){
        $device = Device::find($id);
        $device->alarmRaisedNo++;
        $device->alarmActiveNo = 1;
        $device->movementStatus = 0;
        $device->alarmTwoRunStatus = 1;
        $device->alarmTwoTime = Carbon::now('Asia/Kolkata');

        $dt = Carbon::now('Asia/Kolkata');
        $timestr = $dt->format('H:i:s');
        $device->connTimeUpdate = $timestr;

        $alarmonestatus = DB::table('devices')
        ->where('id', '=', $id)->pluck('alarmOneTime');

            $device->alarmOneRunStatus = 0;

            $alarmonetime = DB::table('devices')
            ->where('id', '=', $id)->pluck('alarmOneTime');

            $currenttime = Carbon::now('Asia/Kolkata');

            $alarmonetottimeprev = DB::table('devices')
            ->where('id', '=', $id)->pluck('alarmonetotTime');

            $timeFirst  = strtotime($alarmonetime[0]);
            $timeSecond = strtotime($currenttime);
            $differenceInSeconds = $timeSecond - $timeFirst;

            $device->alarmonetotTime = (new Carbon($alarmonetottimeprev[0]))->addSeconds($differenceInSeconds);

                    //conn
        $constatus = DB::table('devices')
        ->where('id', '=', $id)->pluck('connectionStatus');

        if ($constatus[0] == 0) {
            $device->connectionTime = Carbon::now('Asia/Kolkata');
            $device->connectionStatus = 1;
            $device->movementStatus = 0;
        }elseif ($constatus[0] == 1) {
            $device->connectionStatus = 1;
        }
        $expiresAt = Carbon::now()->addMinutes(3);
        Cache::put('device-is-connected'.$id, true, $expiresAt);
        //conn


        $device->save();

        $contactNumber = DB::table('devicesetting')
        ->where('id', '=', $id)->pluck('mobileNumber');

        $devicename = DB::table('devices')
        ->where('id', '=', $id)->pluck('deviceID');

        $response = file_get_contents('https://api-mapper.clicksend.com/http/v2/send.php?method=http&username=sathithyayogi@spearfox.com&key=193C3686-57B6-966F-4EA1-6BFEFB7CC8E4&to='.$contactNumber[0].'&message=Device '.$devicename[0].' stationary for 60 seconds');

        //Alarm One Start
        // broadcast(new DeviceDiagnosticShow($device));
        // broadcast(new DeviceDiagnosticsEvent($device));
        // broadcast(new WebsocketDemoEvent("test"));
        return response()->json($device, 200);
    }

    public function devicealarmTwoStop(Request $request, $id, Device $device){
        $device = Device::find($id);
        $device->alarmActiveNo = 0;
        $device->alarmTwoRunStatus = 0;
        $device->movementStatus = 2;

        $dt = Carbon::now('Asia/Kolkata');
        $timestr = $dt->format('H:i:s');
        $device->connTimeUpdate = $timestr;

        $alarmtwotime = DB::table('devices')
        ->where('id', '=', $id)->pluck('alarmTwoTime');

        $currenttime = Carbon::now('Asia/Kolkata');

        $alarmtwotottimeprev = DB::table('devices')
        ->where('id', '=', $id)->pluck('alarmtwototTime');

        $timeFirst  = strtotime($alarmtwotime[0]);
        $timeSecond = strtotime($currenttime);
        $differenceInSeconds = $timeSecond - $timeFirst;


        $device->alarmtwototTime = (new Carbon($alarmtwotottimeprev[0]))->addSeconds($differenceInSeconds);


                //conn
                $constatus = DB::table('devices')
                ->where('id', '=', $id)->pluck('connectionStatus');

                if ($constatus[0] == 0) {
                    $device->connectionTime = Carbon::now('Asia/Kolkata');
                    $device->connectionStatus = 1;
                    $device->movementStatus = 2;
                }elseif ($constatus[0] == 1) {
                    $device->connectionStatus = 1;
                }
                $expiresAt = Carbon::now()->addMinutes(3);
                Cache::put('device-is-connected'.$id, true, $expiresAt);
                //conn

        $device->save();





        //Alarm One Stop
        // broadcast(new DeviceDiagnosticShow($device));
        // broadcast(new DeviceDiagnosticsEvent($device));
        // broadcast(new WebsocketDemoEvent("test"));
        // return $response;
        return response()->json($device, 200);
    }

    public function devicessum()
    {
        $sum = DB::table('devices')->sum('alarmActiveNo');
        return $sum;
    }

    public function deviceupdateoneday($id){

        $device = Device::find($id);
        $device->alarmonetimeday++;
        $device->save();
        return response()->json($device, 200);
    }


    public function deviceupdatetwoday($id){

        $device = Device::find($id);
        $device->alarmtwotimeday++;
        $device->save();
        return response()->json($device, 200);
    }

}
