<?php

namespace App\Traits;

use Carbon\Carbon;

trait FormatDates
{
    function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->translatedFormat('d M,Y');
    }
}