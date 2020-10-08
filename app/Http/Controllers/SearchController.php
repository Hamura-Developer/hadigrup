<?php

namespace App\Http\Controllers;

use App\Job;
use App\Landingpage;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request){
        $setting					= Setting::find(1);
           
        $data['situs']				= $setting['nama'];
        $data['logo']				= $setting['logo'];
        $data['favicon']			= $setting['favicon'];
        $data['telp']				= $setting['telepon'];
        $data['email']				= $setting['email_website'];
        $data['alamat']				= $setting['alamat'];
        $data['author'	]			= $setting['pemilik'];
        $data['deskripsi_web']		= $setting['deskripsi_situs'];
        $data['meta_deskripsi']		= $setting['meta_deskripsi'];
        $data['meta_keyword']		= $setting['meta_keyword'];
        $data['website']			= $setting['website'];
        $data['facebook']			= $setting['facebook'];
        $data['instagram']			= $setting['instagram'];
        $data['twitter'	]			= $setting['twitter'];
        $data['youtube']			= $setting['youtube'];
        $data['linkedin']			= $setting['linkedin'];
        
        $fitur						= Landingpage::find(1);
        $data['fitur1']				= $fitur['judulfitur1'];
        $data['fitur2']				= $fitur['judulfitur2'];
        $data['fitur3']				= $fitur['judulfitur3'];
        $data['desk1']				= $fitur['konten1'];
        $data['desk2']				= $fitur['konten2'];
        $data['desk3']				= $fitur['konten3'];

        $key						= $request['keyjob'];
        $data['jobs']				= Job::where('status','=','1')->where('pekerjaan','like','%'.$key.'%')->orderBy('id','DESC')->paginate(8)->appends(['keyjob'=>$key]);
        $data['totalpekerjaan']		= Job::where('status','=','1')->where('pekerjaan','like','%'.$key.'%')->get()->count();
        $data['title']		    	= "Cari Lowongan kerja";
        
        return view('web.result')->with($data);
    
    }
    public function result(){
       
    }
    
}
