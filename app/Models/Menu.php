<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $table = "menus";

    public static function byName($name)
    {
        return self::where('name', '=', $name)->first();
    }

    public function items()
    {
        return $this->hasMany(MenuItems::class,'menu')->with('child')->where('parent', 0)->orderBy('sort', 'ASC');
    }
}
