<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Map;
use Illuminate\Http\Request;

class MapsController extends Controller
{
    public function maps(){
        return response()->json(Map::get(), 200);
    }
}
