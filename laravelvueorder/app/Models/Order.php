<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    public $timestamps = false;
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'customer_name','customer_email','customer_phone_number','shipping_city','shipping_address','shipping_state',
        'shipping_zip','shippping_country','order_total','payment_method_type','creation_datetime'];
}
