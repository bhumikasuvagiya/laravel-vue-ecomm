<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'setting';

    protected $primaryKey = 'setting_id';

    protected $fillable = [
        'website_name', 'contact_details','phone','description', 'logo','favicon','creation_datetime','email','address'
    ];
    public $timestamps = false;

}
