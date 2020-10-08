<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    protected $table = "moduls";
    protected $fillable = ['nama','url_modul'];
}
