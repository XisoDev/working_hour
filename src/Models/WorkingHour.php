<?php

namespace XisoDev\WorkingHours\Models;

use Illuminate\Database\Eloquent\Model;

class WorkingHour extends Model
{
    protected $guarded = [];
    protected $casts = [
        'schedule' => 'array',
        'exclusions' => 'array',
    ];

    public function model()
    {
        return $this->morphTo();
    }

    public function getHoursOn($dateOrDay): int
    {
        return $this->model()->first()->getHoursOn($dateOrDay);
    }

    public function getMinutesOn($dateOrDay): int
    {
        return $this->model()->first()->getMinutesOn($dateOrDay);
    }
}
