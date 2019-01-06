<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventDates extends Model
{
    protected $table = 'event_dates';
    protected $fillable = ['event_date'];

    protected $dates = ['event_date'];

    public $timestamps = false;


}
