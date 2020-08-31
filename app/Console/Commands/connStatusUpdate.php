<?php

namespace App\Console\Commands;

use App\Device;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Events\DeviceDiagnosticsEvent;
use App\Events\DeviceDiagnosticShow;
use App\Events\WebsocketDemoEvent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
class connStatusUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'conn:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This update the connection status every 4 minute';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // DB::table('devices')
        //       ->update(['connectionStatus' => 0]);
        $count = Device::count();
        // echo $count;
        for ($x = 1; $x <= $count; $x++) {
            $dt = Carbon::now('Asia/Kolkata');
            $timestr = $dt->format('H:i:s');
            $timestr = strtotime($timestr);

            $constatus = DB::table('devices')
            ->where('id', '=', $x)->pluck('connTimeUpdate');
            $constatus = strtotime($constatus);

            // $diff = $timestr - $constatus[0];
            $diff = 60;

            if($diff > 70){
                $device = Device::find($x);
                $device->connectionStatus = 0;
                $device->save();

                $mstatus =  DB::table('devices')
                ->where('id', '=', $x)->pluck('movementStatus');

                if($mstatus[0] == 0){
                    // 2nd start

                    $device = Device::find($x);
                    $device->alarmActiveNo = 0;
                    $device->alarmTwoRunStatus = 0;
                    $device->movementStatus = 2;

                    $alarmtwotime = DB::table('devices')
                    ->where('id', '=', $x)->pluck('alarmTwoTime');

                    $currenttime = Carbon::now('Asia/Kolkata');

                    $alarmtwotottimeprev = DB::table('devices')
                    ->where('id', '=', $x)->pluck('alarmtwototTime');

                    $timeFirst  = strtotime($alarmtwotime[0]);
                    $timeSecond = strtotime($currenttime);
                    $differenceInSeconds = $timeSecond - $timeFirst;


                    $device->alarmtwototTime = (new Carbon($alarmtwotottimeprev[0]))->addSeconds($differenceInSeconds);


                            //conn
                            $constatus = DB::table('devices')
                            ->where('id', '=', $x)->pluck('connectionStatus');

                            if ($constatus[0] == 0) {
                                $device->connectionTime = Carbon::now('Asia/Kolkata');
                                $device->connectionStatus = 1;
                                $device->movementStatus = 2;
                            }elseif ($constatus[0] == 1) {
                                $device->connectionStatus = 1;
                            }
                            $expiresAt = Carbon::now()->addMinutes(3);
                            Cache::put('device-is-connected'.$x, true, $expiresAt);
                            //conn

                    $device->save();


                }else if($mstatus[0] == 1){
                    // 1st starts
                    $device = Device::find($x);
                    $device->alarmActiveNo = 0;
                    $device->alarmOneRunStatus = 0;
                    $device->movementStatus = 2;
                    $alarmonetime = DB::table('devices')
                    ->where('id', '=', $x)->pluck('alarmOneTime');

                    $currenttime = Carbon::now('Asia/Kolkata');

                    $alarmonetottimeprev = DB::table('devices')
                    ->where('id', '=', $x)->pluck('alarmonetotTime');

                    $timeFirst  = strtotime($alarmonetime[0]);
                    $timeSecond = strtotime($currenttime);
                    $differenceInSeconds = $timeSecond - $timeFirst;

                    $device->alarmonetotTime = (new Carbon($alarmonetottimeprev[0]))->addSeconds($differenceInSeconds);

                            //conn
                            $constatus = DB::table('devices')
                            ->where('id', '=', $x)->pluck('connectionStatus');

                            if ($constatus[0] == 0) {
                                $device->connectionTime = Carbon::now('Asia/Kolkata');
                                $device->connectionStatus = 1;
                                $device->movementStatus = 2;
                            }elseif ($constatus[0] == 1) {
                                $device->connectionStatus = 1;
                            }
                            $expiresAt = Carbon::now()->addMinutes(3);
                            Cache::put('device-is-connected'.$x, true, $expiresAt);
                            //conn

                    $device->save();
                }

            }

          }
        // broadcast(new WebsocketDemoEvent("test"));
    }
}
