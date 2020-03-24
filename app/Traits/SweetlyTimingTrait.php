<?php

namespace App\Traits;

use Carbon\Carbon;

/**
 * Trait SweetlyTimingTrait
 * @package App\Traits
 */
trait SweetlyTimingTrait
{
    /**
     * @param string $data
     * @return string
     */
    public function getCarbonCreatedAt(string $data)
    {
        return Carbon::parse($data)->locale(app()->getLocale())->diffForHumans();
    }

}