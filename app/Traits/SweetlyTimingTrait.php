<?php

namespace App\Traits;

use Carbon\Carbon;

trait SweetlyTimingTrait
{
    public function getCarbonCreatedAt($data)
    {
        return Carbon::parse($data)->locale(app()->getLocale())->diffForHumans();
    }
    
}