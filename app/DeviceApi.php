<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceApi extends Model
{
    //
    protected $table = "devices";

    protected $fillable = [
    'deviceName',
    'deviceID',
    'movementStatus',
    'connectionStatus',
    'mobileNumber',
    'initialized',
    'alarmRaisedNo',
    'alarmActiveNo',
    'connectionTime',
    'alarmOneTime',
    'alarmonetotTime',
    'alarmtwototTime',
    'alarmTwoTime'];
}
