<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting as ModelsSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(Auth::user()->role == 1 ){
            $data['title']              = 'Konfigurasi Website'; 

            $setting                    = ModelsSetting::find(1);
            $data['logo']				= $setting['logo'];
            $data['situs']				= $setting['nama'];
            $data['favicon']			= $setting['favicon'];
            $data['author']				= $setting['pemilik'];
            
            if(empty($setting['id'])){
                $data['id']				= $this->kode_otomatis();
            }
            else{
                $data['id']				= 1;
            }
            
            $data['nama']				= $setting['nama'];
            $data['slog']				= $setting['slogan'];
            $data['deskripsi']          = $setting['deskripsi_situs'];
            $data['telp']		    	= $setting['telepon'];
            $data['almt']				= $setting['alamat'];
            $data['email']		        = $setting['email_website'];
            $data['owner']			    = $setting['pemilik'];
            $data['web']			    = $setting['website'];
            $data['mekeyword']		    = $setting['meta_keyword'];
            $data['medeskripsi']		= $setting['meta_deskripsi'];
            $data['fvc']				= $setting['favicon'];
            $data['facebook']			= $setting['facebook'];
            $data['twitter']			= $setting['twitter'];
            $data['instagram']			= $setting['instagram'];
            $data['linkedin']			= $setting['linkedin'];
            $data['youtube']			= $setting['youtube'];
            $data['css']                = view('admin.setting.cssform');            
            $data['js']                 = view('admin.setting.jsform');             
            $data['script']             = view('admin.setting.scripts');             
            return view('admin.setting.list')->with($data);
        }else{
            return redirect('/appweb');
         }
    }

    public function store (Request $request){
        if(Auth::user()->role == 1 ){
        
            $request->validate([
                'favicon' => 'mimes:png|max:1024',
            ]);

            $file                       = $request->file('favicon');
            $imglama	                = $request->faviconlama;

            if($file){
                $filename               = $file->getClientOriginalName();
                $path                   = public_path('img');
                $file->move($path,$filename);
                $data = [
                    'nama'              => $request['nama'],
                    'slogan'            => $request['slogan'],
                    'deskripsi_situs'   => $request['deskripsi_situs'],
                    'telepon'           => $request['telepon'],
                    'alamat'            => $request['alamat'],
                    'email_website'     => $request['email_website'],
                    'pemilik'           => $request['pemilik'],
                    'website'           => $request['website'],
                    'meta_keyword'      => $request['meta_keyword'],
                    'meta_deskripsi'    => $request['meta_deskripsi'],
                    'facebook'          => $request['facebook'],
                    'twitter'           => $request['twitter'],
                    'instagram'         => $request['instagram'],
                    'linkedin'          => $request['linkedin'],
                    'youtube'           => $request['youtube'],
                    'favicon'           => $filename
                ];
                $id                     = $request['id'];
                $d                      = ModelsSetting::where('id_config','=',$id);

            }
            else {
                $data = [
                    'nama'              => $request['nama'],
                    'slogan'            => $request['slogan'],
                    'deskripsi_situs'   => $request['deskripsi_situs'],
                    'telepon'           => $request['telepon'],
                    'alamat'            => $request['alamat'],
                    'email_website'     => $request['email_website'],
                    'pemilik'           => $request['pemilik'],
                    'website'           => $request['website'],
                    'meta_keyword'      => $request['meta_keyword'],
                    'meta_deskripsi'    => $request['meta_deskripsi'],
                    'facebook'          => $request['facebook'],
                    'twitter'           => $request['twitter'],
                    'instagram'         => $request['instagram'],
                    'linkedin'          => $request['linkedin'],
                    'youtube'           => $request['youtube'],
                    'favicon'           => $imglama
                ];
                $id                     = $request['id'];
                $d                      = ModelsSetting::where('id_config','=',$id);
            }
        
            if ($d->count() > 0){
                ModelsSetting::where('id_config','=',$id)->update($data);
                return redirect('/appweb/config')->with('SUCCESSMSG','Data Berhasil di Update');
            }
            else{
                ModelsSetting::create($data);
                return redirect('/appweb/config')->with('SUCCESSMSG','Data Berhasil di Tambah');
            }
        }else{
            return redirect('/appweb');
         }
    }

    public function logo() 
	{
        if(Auth::user()->role == 1 ){
            $data['title']				= 'Logo';
            
            $setting                    = ModelsSetting::find(1);
            $data['logo']				= $setting['logo'];
            $data['situs']				= $setting['nama'];
            $data['favicon']			= $setting['favicon'];
            $data['author']				= $setting['pemilik'];

            $data['id'] 				= 1;
            $data['lg']					= $setting['logo'];
            
            $data['css']                = view('admin.setting.cssform');            
            $data['js']                 = view('admin.setting.jsform');             
            $data['script']             = view('admin.setting.scripts');  
            return view('admin.setting.logo')->with($data);
        }else{
            return redirect('/appweb');
        }
    }
    
    public function update(Request $request){
        if(Auth::user()->role == 1 ){
            
            $request->validate([
                'logo' => 'mimes:png|max:1024',
            ]);
            $id                         = $request->id;
            $file                       = $request->file('logo');
            $imglama	                = $request->logolama;

            if($file){
                $filename               = $file->getClientOriginalName();
                $path                   = public_path('img');
                $file->move($path,$filename);
                $data = [
                    'logo'              => $filename
                ];
            
            }
            else {
                $data = [
                    'logo'              => $imglama
                ];
            
            }
            ModelsSetting::where('id_config','=',$id)->update($data);
            return redirect('/appweb/config/logo')->with('SUCCESSMSG','Data Berhasil di Update');
        }else{
            return redirect('/appweb');
         }
    }
    function kode_otomatis()
    {
        $query          = ModelsSetting::select(Max('id_config','1'))->get();
        $kd             = "";
        if ($query->count() > 0){
            foreach ($query as $k){
                $tmp = ((int)$k->kode_max)+1;
                $kd = sprintf("%01s", $tmp);
            }
        }
        else
        {
            $kd = "1";
        }
        return $kd;
		
    }
    
}
