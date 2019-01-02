<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $filable = ['title'];

    public function dates(){

    }

    public function dates_str(){
        return '--даты события--';
    }

    public function scopeLastEvents($query, $count){
        return $query->take($count)->get();
    }

}
