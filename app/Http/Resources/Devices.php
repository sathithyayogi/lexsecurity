<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Validator;

class Devices extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'deviceID' => $this->deviceID,
            'deviceN' => $this->deviceName
        ];
    }

    public function with ($request) {
        return [
            'version' =>'1.0'
        ];
    }
}
