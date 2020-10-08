<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = "pages";

    protected $fillable =['nama_laman','pages_seo','konten','status','posisi','layout','meta_keyword','meta_deskripsi'];
}
