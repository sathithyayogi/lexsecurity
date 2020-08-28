<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Devicesettings;

class deviceSettingController extends Controller
{
    //

    public function show($id){
        $device = Devicesettings::find($id);
        return view('deviceset')->with('device', $device);
    }

    public function change(Request $request, $id){
        $device = Devicesettings::find($id);
        $device->mobileNumber = $request->input('mobileNumber');
        return redirect('/')->with('success', 'Number Updated');
    }
}
