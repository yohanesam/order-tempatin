<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderSchedule extends Model
{
    protected $table = 'order_schedule';
    public $primaryKey  = 'id_order_schedule';
    protected $guarded = [];
}
