<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use App\Events\WebsocketDemoEvent;
use SebastianBergmann\Environment\Console;

class dashboardController extends Controller
{
    //
    public function index()
    {

        broadcast(new WebsocketDemoEvent('some data'));
        $devices = device::all();
        return view('dashboard')->with('devices', $devices);
    }
}
