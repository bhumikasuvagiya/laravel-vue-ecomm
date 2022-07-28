<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'category_id', 'subcategory_id','product_name','product_sku', 'description','product_image','amount','status','creation_datetime'
    ];
    public $timestamps = false;
}
