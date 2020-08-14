<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Device extends Model
{
    //
    protected $table = 'devices';
    // protected $fillable = ['deviceID', 'deviceName', 'mobileNumber', 'initialized'];

    public function isConn()
    {
        return Cache::has('device-is-connected'.$this->id);
    }

}
