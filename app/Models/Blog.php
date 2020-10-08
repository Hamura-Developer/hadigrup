<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = "blogs";
    protected $fillable = ['judul','slug','kategori','konten','penulis','status','gambar','meta_deksripsi','meta_keyword'];
}
