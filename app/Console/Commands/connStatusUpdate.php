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
use Illuminate\Support\Facades\Log;

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
        $ids = DB::table('devices')
            ->pluck('id');
        for ($x = 0; $x < $count; $x++) {
            $dt = Carbon::now('Asia/Kolkata');

            $timestr = strtotime($dt);

            $constatus = DB::table('devices')
            ->where('id', '=', $ids[$x])->pluck('connTimeUpdate');
            $constatust = strtotime($constatus[0]);

            $difft = $timestr - $constatust;


            if($difft > 70){
                $device = Device::find($ids[$x]);
                $device->connectionStatus = 0;
                $device->save();

                $mstatus =  DB::table('devices')
                ->where('id', '=', $ids[$x])->pluck('movementStatus');

                if($mstatus[0] == 0){
                    // 2nd start

                    $device = Device::find($ids[$x]);
                    $device->alarmActiveNo = 0;
                    $device->alarmTwoRunStatus = 0;
                    $device->movementStatus = 2;

                    $alarmtwotime = DB::table('devices')
                    ->where('id', '=', $ids[$x])->pluck('alarmTwoTime');

                    $currenttime = Carbon::now('Asia/Kolkata');

                    $alarmtwotottimeprev = DB::table('devices')
                    ->where('id', '=', $ids[$x])->pluck('alarmtwototTime');

                    $timeFirst  = strtotime($alarmtwotime[0]);
                    $timeSecond = strtotime($currenttime);
                    $differenceInSeconds = $timeSecond - $timeFirst;


                    $device->alarmtwototTime = (new Carbon($alarmtwotottimeprev[0]))->addSeconds($differenceInSeconds);


                    $device->save();


                }else if($mstatus[0] == 1){
                    // 1st starts
                    $device = Device::find($ids[$x]);
                    $device->alarmActiveNo = 0;
                    $device->alarmOneRunStatus = 0;
                    $device->movementStatus = 3;
                    $alarmonetime = DB::table('devices')
                    ->where('id', '=', $ids[$x])->pluck('alarmOneTime');

                    $currenttime = Carbon::now('Asia/Kolkata');

                    $alarmonetottimeprev = DB::table('devices')
                    ->where('id', '=', $ids[$x])->pluck('alarmonetotTime');

                    $timeFirst  = strtotime($alarmonetime[0]);
                    $timeSecond = strtotime($currenttime);
                    $differenceInSeconds = $timeSecond - $timeFirst;

                    $device->alarmonetotTime = (new Carbon($alarmonetottimeprev[0]))->addSeconds($differenceInSeconds);



                    $device->save();
                }

            }


          }
    }
}
