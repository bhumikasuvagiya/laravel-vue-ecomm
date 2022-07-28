<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOldFileNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_item', function(Blueprint $table) {
            $table->renameColumn('id', 'order_item_id');
        });
        Schema::table('order', function(Blueprint $table) {
            $table->renameColumn('id', 'order_id');
        });
        Schema::table('product', function(Blueprint $table) {
            $table->renameColumn('id', 'product_id');
        });
        Schema::table('category', function(Blueprint $table) {
            $table->renameColumn('id', 'category_id');
        });
        Schema::table('subcategory', function(Blueprint $table) {
            $table->renameColumn('id', 'subcategory_id');
        });
        Schema::table('setting', function(Blueprint $table) {
            $table->renameColumn('id', 'setting_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_item', function(Blueprint $table) {
            $table->renameColumn('order_item_id', 'id');
        });
        Schema::table('order', function(Blueprint $table) {
            $table->renameColumn('order_id', 'id');
        });
        Schema::table('product', function(Blueprint $table) {
            $table->renameColumn('product_id', 'id');
        });
        Schema::table('category', function(Blueprint $table) {
            $table->renameColumn('category_id', 'id');
        });
        Schema::table('subcategory', function(Blueprint $table) {
            $table->renameColumn('subcategory_id', 'id');
        });
        Schema::table('setting', function(Blueprint $table) {
            $table->renameColumn('setting_id', 'id');
        });
    }
}
