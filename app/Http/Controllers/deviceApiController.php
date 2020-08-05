<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeviceApi;

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
        $device = DeviceApi::create($request->all());
        return response()->json($device, 200);
    }

    public function deviceUpdate(Request $request, DeviceApi $deviceapi){
        $deviceapi->update($request->all());
        return response()->json($deviceapi, 200);
    }
}
