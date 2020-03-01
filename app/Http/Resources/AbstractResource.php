<?php

namespace App\Http\Resources;

use App\Traits\SweetlyTimingTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class AbstractResource extends JsonResource
{
    use SweetlyTimingTrait;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}




