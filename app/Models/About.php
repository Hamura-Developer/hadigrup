<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = "abouts";
    protected $fillable = ['konten1','konten2','judul1','judul2','judul3','teks1','teks2','teks3','meta_keyword','meta_deskripsi','gambar'];
}
