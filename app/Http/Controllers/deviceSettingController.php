<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Devicesettings;

class deviceSettingController extends Controller
{
    //
    public function view(){

        $device = Devicesettings::all();
        return view('showmobile')->with('devices', $device);


    }

    public function show($id){
        $device = Devicesettings::find($id);
        return view('deviceset')->with('device', $device);
    }

    public function change(Request $request, $id){
        $device = Devicesettings::find($id);
        $device->mobileNumber = $request->input('mobileNumber');
        $device->save();
        return redirect('/device/mobilenumber')->with('success', 'Number Updated');
    }

    public function create(Request $request){

        return view('addnumber');

    }

    public function stored(Request $request){
        $device = new Devicesettings;
        $device->mobileNumber = $request->input('mobileNumber');
        $device->save();
        return redirect('/device/mobilenumber')->with('success', 'New Number Added');
    }

    public function destroyed($id){
        $device = Devicesettings::find($id);
        $device->delete();
        return redirect('/device/mobilenumber')->with('success', 'Number Deleted');
    }
}

