<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Blog as ModelsBlog;
use App\Models\Category as ModelsCategory;
use App\Models\Contact as ModelsContact;
use App\Models\Page as ModelsPage;
use App\Models\Partner as ModelsPartner;
use App\Models\Setting as ModelsSetting;
use App\Models\Testimonial as ModelsTestimonial;

class HomeController extends Controller
{
   
     public function __construct()
     {
         $this->middleware('auth');
     }
   
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data['title']					    = 'Dashboard Administrator';
        $setting                            = ModelsSetting::find(1);
        $data['logo']				        = $setting['logo'];
        $data['situs']				        = $setting['nama'];
        $data['favicon']			        = $setting['favicon'];
        $data['author']				        = $setting['pemilik'];
        $data['totalartikel']               = ModelsBlog::get()->count();
        $data['totalpartner']               = ModelsPartner::get()->count();
        $data['totalpage']                  = ModelsPage::get()->count();
        $data['inbox']                      = ModelsContact::where('status','0')->get()->count();
        $data['kategori']                   = ModelsCategory::where('status','1')->get()->count();
        $data['testimoni']                  = ModelsTestimonial::get()->count();
        $data['lastpostblog']			    = ModelsBlog::orderBy('id','ASC')->take(5)->get();
        $data['topviewblog']			    = ModelsBlog::orderBy('hits','DESC')->take(5)->get();
        
        $data['css']					    =  view('admin.home.css');
        $data['js']						    =  view('admin.home.js');
        return view('admin.home.list')->with($data);
    }
    
}
