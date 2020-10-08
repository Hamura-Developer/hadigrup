<?php

namespace App\Http\Controllers;

use App\About;
use App\Contact;
use App\Landingpage;
use App\Map;
use App\Menuitems;
use App\Page;
use App\Setting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request){
        $cekslug                    = $request->segment(1);
        $slug                       = $request->path();
        $sql						= Menuitems::where('link',$slug)->get();
        if ($sql->count() > 0 ){	
            $setting                = Setting::find(1);
            $page					= Page::where('pages_seo',$slug)->where('status',2)->take(1)->get();
            $url					= Page::find($page[0]['id']);
			$template 				= $this->cari_template($slug); 
            /*---------------PAGE---------------*/
            $data['situs']			= $setting['nama'];
            $data['title']			= $url['nama_laman'];
            $data['konten']			= $url['konten'];
            $data['meta_deskripsi']	= $url['meta_deskripsi'];
            $data['meta_keyword']	= $url['meta_keyword'];
            
            $data['logo']			= $setting['logo'];
            $data['favicon']		= $setting['favicon'];
            $data['deskripsi_web']	= $setting['deskripsi_situs'];
            $data['telp']			= $setting['telepon'];
            $data['email']			= $setting['email_website'];
            $data['alamat']			= $setting['alamat'];
            $data['author']			= $setting['pemilik'];
            $data['website']		= $setting['website'];
            $data['tema']			= $setting['tema'];
            $data['facebook']		= $setting['facebook'];
            $data['instagram']		= $setting['instagram'];
            $data['twitter']		= $setting['twitter'];
            $data['youtube']		= $setting['youtube'];
            $data['linkedin']		= $setting['linkedin'];
            
            $about			        = About::find(1);
            $data['about_deskripsi']= $about['konten1'];
            $data['about_gambar']   = $about['gambar'];
            $data['heading1']       = $about['judul1'];
            $data['teks1']          = $about['teks1'];
            $data['heading2']       = $about['judul2'];
            $data['teks2']          = $about['teks2'];
            $data['heading3']       = $about['judul3'];
            $data['teks3']          = $about['teks3'];

            return view('web.'.$template.'')->with($data);
        }
        else if($cekslug =='public'){
            abort(404);
        }
        else{
            abort(404);
        }
    }
    public function profil(Request $request){
		
		$slug						= $request->path();
		$setting                    = Setting::find(1);
        	
		$data['situs']				= $setting['nama'];
		$template 					= 'profil'; 
		$data['title']				= $slug;
        
        $data['logo']				= $setting['logo'];
        $data['favicon']			= $setting['favicon'];
        $data['telp']				= $setting['telepon'];
		$data['email']				= $setting['email_website'];
		$data['alamat']				= $setting['alamat'];
		$data['author'	]			= $setting['pemilik'];
		$data['deskripsi_web']		= $setting['deskripsi_situs'];
		$data['website']			= $setting['website'];
		$data['tema']				= $setting['tema'];
		$data['facebook']			= $setting['facebook'];
		$data['instagram']			= $setting['instagram'];
		$data['twitter'	]			= $setting['twitter'];
		$data['youtube']			= $setting['youtube'];
        $data['linkedin']			= $setting['linkedin'];
        
        $about			            = About::find(1);
        $data['about_deskripsi']    = $about['konten1'];
        $data['about_gambar']       = $about['gambar'];
        $data['heading1']           = $about['judul1'];
        $data['teks1']              = $about['teks1'];
        $data['heading2']           = $about['judul2'];
        $data['teks2']              = $about['teks2'];
        $data['heading3']           = $about['judul3'];
        $data['teks3']              = $about['teks3'];
        $data['meta_deskripsi']		= $about['meta_deskripsi'];
		$data['meta_keyword']		= $about['meta_keyword'];
		return view('web.'.$template.'')->with($data);
	}
    public function kontak(Request $request){
		
		$slug						= $request->path();
		$setting                    = Setting::find(1);
        	
		$data['situs']				= $setting['nama'];
		$template 					= 'contact'; 
		$data['title']				= $slug;
        
        $data['logo']				= $setting['logo'];
        $data['favicon']			= $setting['favicon'];
        $data['telp']				= $setting['telepon'];
		$data['email']				= $setting['email_website'];
		$data['alamat']				= $setting['alamat'];
		$data['author'	]			= $setting['pemilik'];
		$data['deskripsi_web']		= $setting['deskripsi_situs'];
		$data['website']			= $setting['website'];
		$data['tema']				= $setting['tema'];
		$data['facebook']			= $setting['facebook'];
		$data['instagram']			= $setting['instagram'];
		$data['twitter'	]			= $setting['twitter'];
		$data['youtube']			= $setting['youtube'];
        $data['linkedin']			= $setting['linkedin'];
        $data['meta_deskripsi']		= $setting['meta_deskripsi'];
        $data['meta_keyword']		= $setting['meta_keyword'];
        
        $fitur						= Landingpage::find(1);
        $data['fitur1']				= $fitur['judulfitur1'];
        $data['fitur2']				= $fitur['judulfitur2'];
        $data['fitur3']				= $fitur['judulfitur3'];
        $data['desk1']				= $fitur['konten1'];
        $data['desk2']				= $fitur['konten2'];
        $data['desk3']				= $fitur['konten3'];
        
        $lokasi                     = Map::find(1);
        $data['namalokasi']         = $lokasi['nama'];
        $data['embedmaps']          = $lokasi['embed'];
		$data['caption']            = $lokasi['caption'];
		
		$data['jskontak']           = true;
		return view('web.'.$template.'')->with($data);
	}
    public function kirimpesan(Request $request){
		
		$nama                       = $request->input('name');
		$email                      = $request->input('email');
		$subjek                     = $request->input('subjek');
		$pesan                      = $request->input('pesan');
        
        $kontak                     =Contact::create([
            'nama'                  =>$nama,
            'email'                 =>$email,
            'subjek'                =>$subjek,
            'pesan'                 =>$pesan,
            'status'                =>0,
        ]);
        if($kontak){
            return response()->json([
                'success'=>true,
                'message'=>'Pesan terkirim !'
            ],201);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'Pesan Gagal !'
            ],400);
        }
	}
    public function cari_template($slug){
        $t                          = Page::where('pages_seo',$slug)->get();
        if($t->count() > 0){
			foreach($t as $h){
				$hasil              = $h->layout;
			}
		}else{
			$hasil                  = '';
		}
		return $hasil;
    }
}
