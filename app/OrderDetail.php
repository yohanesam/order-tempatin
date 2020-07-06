<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_detail';
    public $primaryKey  = 'id_order_detail';
    protected $guarded = [];
}
