<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title'];

    public function dates(){
        return $this->hasMany('App\EventDates', 'event_id');
    }

    public function dates_str(){
        $dates = $this->dates()->get();
        $aDates = [];
        foreach ($dates as $date){
            $aDates[] = $date->event_date->format('d.m.Y');
        }

        $st = implode(", ", $aDates);
        $st = str_replace(['01.01.2500', '01.01.2600'], ['By demand', 'By complectation'], $st);

        return $st;
    }

    public function scopeLastEvents($query, $count){
        return $query->take($count)->get();
    }

}
