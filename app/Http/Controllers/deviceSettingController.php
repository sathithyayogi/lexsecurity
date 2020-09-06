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
        $count = Devicesettings::count();
        if($count >= 3){
            return redirect('/device/mobilenumber')->with('error', 'Max 3 Numbers :: You cant add any more, Edit previous Number');
        }else if($count < 3){
        $device = new Devicesettings;
        $device->mobileNumber = $request->input('mobileNumber');
        $device->save();
        return redirect('/device/mobilenumber')->with('success', 'New Number Added');
    }
    }

    public function destroyed($id){
        $device = Devicesettings::find($id);
        $device->delete();
        return redirect('/device/mobilenumber')->with('success', 'Number Deleted');
    }
}

