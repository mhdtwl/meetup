<?php

namespace App\Traits;

use Carbon\Carbon;

trait SweetyTimingTrait
{
    public function getCarbonCreatedAt($data)
    {
        return Carbon::parse($data)->locale(app()->getLocale())->diffForHumans();
    }
    
}