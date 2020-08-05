<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use DB;
use Carbon\Carbon;
class deviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return device::all();
        $device = device::all();
        return view('device')->with('devices', $device);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('adddevice');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'deviceName' => 'required',
            'deviceID' => 'required',
            'mobileNumber' => 'required'
        ]);
        // return 123;
        $device = new Device;
        $device->deviceName = $request->input('deviceName');
        $device->deviceID = $request->input('deviceID');
        $device->mobileNumber = $request->input('mobileNumber');
        $device->movementStatus = 0;
        $device->connectionStatus = 0;
        $device->initialized = 0;
        $device->alarmRaisedNo = 0;
        $device->alarmActiveNo = 0;
        $device->save();

        return redirect('/devices')->with('success', 'Device Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $device = Device::find($id);
        return view('editdevice')->with('device', $device);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'deviceName' => 'required',
            'deviceID' => 'required',
            'mobileNumber' => 'required'
        ]);
        // return 123;
        $device = Device::find($id);
        $device->deviceName = $request->input('deviceName');
        $device->deviceID = $request->input('deviceID');
        $device->mobileNumber = $request->input('mobileNumber');
        $device->save();

        return redirect('/devices')->with('success', 'Device Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $device = Device::find($id);
        $device->delete();
        return redirect('/devices')->with('success', 'Device Removed');
    }
}
