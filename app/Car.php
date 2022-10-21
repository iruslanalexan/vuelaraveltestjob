<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'cars';
    public $timestamps = false;

    public function colors()
    {
        return $this->belongsToMany('App\CarColor', 'cars_colors', 'car_id', 'color_id');
    }
    
}
