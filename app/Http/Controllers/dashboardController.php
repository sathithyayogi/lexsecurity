<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use App\Events\WebsocketDemoEvent;
use Illuminate\Support\Facades\Artisan;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    //
    public function index()
    {
        $sum = DB::table('devices')->sum('alarmActiveNo');
        // broadcast(new WebsocketDemoEvent('some data'));
        $devices = device::all();
        return view('dashboard')->with('devices', $devices);
    }
}
