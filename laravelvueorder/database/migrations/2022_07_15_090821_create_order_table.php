<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->bigInteger('customer_phone_number');
            $table->string('shipping_city');
            $table->string('shipping_address');
            $table->string('shipping_state');
            $table->string('shipping_zip');
            $table->string('shippping_country');
            $table->bigInteger('order_total');
            $table->integer('payment_method_type');
            $table->text('order_note');
            $table->dateTime('creation_datetime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
