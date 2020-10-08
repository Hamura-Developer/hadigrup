<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Landingpage;
use App\Setting;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request){
		$setting					= Setting::find(1);
		/*---------------CONFIG---------------*/
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

		$slug						= $request->path();
		$template 					= 'blog'; 
		$data['title']				= $slug;
		
		$data['populer'] 	        = Blog::where('status',2)->orderBy('hits')->take(1)->get();
		$data['populerside']        = Blog::where('status',2)->orderBy('hits')->take(5)->get();
		$data['baru'] 	            = Blog::where('status',2)->orderBy('id','DESC')->take(2)->get();
		$data['blog'] 			    = Blog::paginate(5);
		
		return view('web.'.$template.'')->with($data);
	}
	
	public function category(Request $request){
		$setting					= Setting::find(1);
		/*---------------CONFIG---------------*/
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
		
		$slug						= $request->segment(2);
		$uri						= Blog::where('kategori',$slug)->take(1)->get();
		if($uri->count() > 0 ){
			$url						= Blog::find($uri[0]['id']);
			
			$template 					= 'blog'; 
			$data['title']				= $url['kategori'];
			$data['populer'] 	        = Blog::where('status',2)->orderBy('hits')->take(1)->get();
			$data['populerside']        = Blog::where('status',2)->orderBy('hits')->take(5)->get();
			$data['baru'] 	            = Blog::where('status',2)->orderBy('id','DESC')->take(2)->get();
			$data['blogkategori'] 	    = Blog::paginate(5);
			
			return view('web.'.$template.'')->with($data);
		}else{
			return redirect('blog');
		}
	}
	
	public function detail(Request $request){		
		$slug						= $request->segment(3);
		$uri						= Blog::where('slug',$slug)->take(1)->get();
		if($uri->count() > 0){
			$url						= Blog::find($uri[0]['id']);
			$setting					= Setting::find(1); 		
			
			/*---------------BLOG---------------*/
			$data['title']				= $url['judul'].' - '.$setting['nama'];
			$data['titleblog']			= $url['judul'];
			$data['detail']				= Blog::find($url['id']);
			$data['meta_deskripsi']		= $url['meta_deskripsi'];
			$data['meta_keyword']		= $url['meta_keyword'];
			
			/*---------------CONFIG---------------*/
			$data['situs']				= $setting['nama'];
			$data['logo']				= $setting['logo'];
			$data['favicon']			= $setting['favicon'];
			$data['telp']				= $setting['telepon'];
			$data['email']				= $setting['email_website'];
			$data['alamat']				= $setting['alamat'];
			$data['author'	]			= $setting['pemilik'];
			$data['deskripsi_web']		= $setting['deskripsi_situs'];
			$data['website']			= $setting['website'];
			$data['facebook']			= $setting['facebook'];
			$data['instagram']			= $setting['instagram'];
			$data['twitter'	]			= $setting['twitter'];
			$data['youtube']			= $setting['youtube'];
			$data['linkedin']			= $setting['linkedin'];
			$data['populer'] 	        = Blog::where('status',2)->orderBy('hits')->take(5)->get();

			$fitur						= Landingpage::find(1);
			$data['fitur1']				= $fitur['judulfitur1'];
			$data['fitur2']				= $fitur['judulfitur2'];
			$data['fitur3']				= $fitur['judulfitur3'];
			$data['desk1']				= $fitur['konten1'];
			$data['desk2']				= $fitur['konten2'];
			$data['desk3']				= $fitur['konten3'];
			return view('web.blog-detail')->with($data);
			
		}
		else{
			abort(404);
		}
	}
}
