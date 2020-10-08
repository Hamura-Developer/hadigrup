<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $table = "maps";

    protected $fillable =['nama','caption','status','embed'];
}
