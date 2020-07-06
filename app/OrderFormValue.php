<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderFormValue extends Model
{
    protected $table = 'order_form_value';
    public $primaryKey  = 'id_order_form_value';
    protected $guarded = [];
}
