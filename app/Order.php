<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    public $primaryKey  = 'id_order';
    protected $guarded = [];

    public function schedule()
    {
        return $this->hasOne('App\OrderSchedule', 'order_id', 'id_order');
    }

    public function form()
    {
        return $this->hasMany('App\OrderFormValue', 'order_id', 'id_order');
    }

    public function review() {
        return $this->hasMany('App\Review', 'order_id', 'id_order');
    }
}
