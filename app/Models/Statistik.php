<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistik extends Model
{
    
    protected $fillable   = ['ip','tanggal','hits','online','agents','referer'];
}
