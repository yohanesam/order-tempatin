<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id_order');
            $table->string('invoice_id');
            $table->integer('user_id');
            $table->integer('room_id');
            $table->integer('form_id');
            $table->integer('setup_id');
            $table->integer('promo_detail_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('method_pay');
            $table->string('cost_total');
            $table->string('status_order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
