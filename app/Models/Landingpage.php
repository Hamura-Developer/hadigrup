<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Landingpage extends Model
{
    protected $table = "landingpages";

    protected $fillable = [
        'id',
        'judul',
        'deskripsi',
        'link',
        'text_link'
    ];
}
