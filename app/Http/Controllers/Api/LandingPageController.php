<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Landingpage;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function landingPage(){
        return response()->json(Landingpage::get(), 200);
    }
}
