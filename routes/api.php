<?php

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('about', 'Api\AboutController@about');
Route::get('blog', 'Api\BlogController@blog');
Route::get('category', 'Api\CategoryController@categoty');
Route::get('contact', 'Api\ContactController@contact');
Route::get('landingpage', 'Api\LandingPageController@landingPage');
Route::get('map', 'Api\MapsController@maps');
Route::get('menu', 'Api\MenuController@menu');
Route::get('menuitem', 'Api\MenuItemController@menuitem');
Route::get('modul', 'Api\ModulController@modul');
Route::get('page', 'Api\PageController@page');
Route::get('setting', 'Api\SettingController@setting');
Route::get('slider', 'Api\SliderController@slider');
Route::get('testimonial', 'Api\TestimonialController@testimonial');
