<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_item';
    public $timestamps = false;
    protected $primaryKey = 'order_item_id';
    protected $fillable = [
        'order_id','product_id','product_quantity'];
}
