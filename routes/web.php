<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::prefix('appweb')->namespace('Admin')->group(function () {
    Route::get('/home', 'HomeController@index');
    Route::post('/home/getchart', 'HomeController@get_chart_data');

    Route::get('/config', 'SettingController@index');
    Route::post('/config', 'SettingController@store');
    Route::get('/config/logo', 'SettingController@logo');
    Route::post('/config/logo', 'SettingController@update');

    Route::get('/modul', 'ModulController@index');
    Route::post('/modul', 'ModulController@show');
    Route::get('/modul/create', 'ModulController@create');
    Route::post('/modul/create', 'ModulController@store')->name('modul.create');
    Route::get('/modul/{id}/edit', 'ModulController@edit');
    Route::delete('/modul', 'ModulController@destroy');

    Route::get('/sliders', 'SliderController@index');
    Route::post('/sliders', 'SliderController@show');
    Route::get('/sliders/create', 'SliderController@create');
    Route::post('/sliders/create', 'SliderController@store')->name('sliders.create');
    Route::get('/sliders/{id}/edit', 'SliderController@edit');
    Route::delete('/sliders', 'SliderController@destroy');

    Route::get('/pages', 'PageController@index');
    Route::post('/pages', 'PageController@show');
    Route::get('/pages/create', 'PageController@create');
    Route::post('/pages/create', 'PageController@store')->name('pages.create');
    Route::get('/pages/{id}/edit', 'PageController@edit');
    Route::delete('/pages', 'PageController@destroy');

    Route::get('/categories', 'CategoryController@index');
    Route::post('/categories', 'CategoryController@show');
    Route::get('/categories/create', 'CategoryController@create');
    Route::post('/categories/create', 'CategoryController@store')->name('categories.create');
    Route::get('/categories/{id}/edit', 'CategoryController@edit');
    Route::delete('/categories', 'CategoryController@destroy');

    Route::get('/articles', 'BlogController@index');
    Route::post('/articles', 'BlogController@show');
    Route::get('/articles/create', 'BlogController@create');
    Route::post('/articles/create', 'BlogController@store')->name('articles.create');
    Route::get('/articles/{id}/edit', 'BlogController@edit');
    Route::delete('/articles', 'BlogController@destroy');

    Route::get('/tags', 'TagController@index');
    Route::post('/tags', 'TagController@show');
    Route::get('/tags/create', 'TagController@create');
    Route::post('/tags/create', 'TagController@store')->name('tags.create');
    Route::get('/tags/{id}/edit', 'TagController@edit');
    Route::delete('/tags', 'TagController@destroy');

    Route::get('/partner', 'PartnerController@index');
    Route::get('/partner', 'PartnerController@index');
    Route::post('/partner', 'PartnerController@show');
    Route::get('/partner/create', 'PartnerController@create');
    Route::post('/partner/create', 'PartnerController@store')->name('partner.create');
    Route::get('/partner/{id}/edit', 'PartnerController@edit');
    Route::delete('/partner', 'PartnerController@destroy');

    Route::get('/testimoni', 'TestimonialController@index');
    Route::get('/testimoni', 'TestimonialController@index');
    Route::post('/testimoni', 'TestimonialController@show');
    Route::get('/testimoni/create', 'TestimonialController@create');
    Route::post('/testimoni/create', 'TestimonialController@store')->name('testimoni.create');
    Route::get('/testimoni/{id}/edit', 'TestimonialController@edit');
    Route::delete('/testimoni', 'TestimonialController@destroy');

    Route::get('/maps', 'MapController@index');
    Route::post('/maps', 'MapController@store');

    Route::get('/abouts', 'AboutController@index');
    Route::post('/abouts', 'AboutController@store');

    Route::get('/linkhome', 'LandingpageController@index');
    Route::post('/linkhome', 'LandingpageController@home');

    Route::get('/linkfeatures', 'LandingpageController@fitur');
    Route::post('/linkfeatures', 'LandingpageController@update');

    Route::get('/visitor', 'StatistikController@index');
    Route::post('/visitor', 'StatistikController@show');

    Route::get('/inbox', 'ContactController@index');
    Route::get('/inbox/show', 'ContactController@show');
    Route::get('/inbox/tulis', 'ContactController@tulis');
    Route::get('/inbox/viewinbox', 'ContactController@viewinbox');
    Route::get('/inbox/balasinbox', 'ContactController@balasinbox');
    Route::delete('/inbox/{id}', 'ContactController@destroy');

    Route::get('/user', 'UserController@index');
    Route::post('/user', 'UserController@show');
    Route::get('/user/create', 'UserController@create');
    Route::post('/user/create', 'UserController@store')->name('user.create');
    Route::get('/user/{id}/edit', 'UserController@edit');
    Route::post('/user/update', 'UserController@update')->name('user.update');
    Route::post('/user/cekemail', 'UserController@cekemail');
    Route::delete('/user', 'UserController@destroy');

    Route::get('/menu', 'MenuController@index');
    Route::post('/menu/addcustommenu','MenuController@addcustommenu')->name('haddcustommenu');
    Route::post('/menu/deleteitemmenu','MenuController@deleteitemmenu')->name('hdeleteitemmenu');
    Route::post('/menu/deletemenug','MenuController@deletemenug')->name('hdeletemenug');
    Route::post('/menu/createnewmenu','MenuController@createnewmenu')->name('hcreatenewmenu');
    Route::post('/menu/generatemenucontrol','MenuController@generatemenucontrol')->name('hgeneratemenucontrol');
    Route::post('/menu/updateitem', 'MenuController@updateitem')->name('hupdateitem');

});

Auth::routes(['register'=>false,'reset'=>false]);
Route::get('/', 'HomeController@index');
