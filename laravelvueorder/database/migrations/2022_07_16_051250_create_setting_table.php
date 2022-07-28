<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->id();
            $table->string('website_name')->nullable();
            $table->string('contact_details')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->text('description')->nullable();
            $table->text('logo')->nullable();
            $table->text('favicon')->nullable();
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
        Schema::dropIfExists('setting');
    }
}
