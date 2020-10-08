<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner as ModelsPartner;
use App\Models\Setting as ModelsSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if(Auth::user()->role == 1 || Auth::user()->role == 2){
            $setting                    = ModelsSetting::find(1);
            $data['logo']				= $setting['logo'];
            $data['situs']				= $setting['nama'];
            $data['favicon']			= $setting['favicon'];
            $data['author']				= $setting['pemilik'];
            $data['title']				= 'List Partner';

            $data['css']                = view('admin.partner.css');            
            $data['js']                 = view('admin.partner.js');             
            $data['script']             = view('admin.partner.scripts');
            return view('admin.partner.list')->with($data);
        }else{
            return redirect('/appweb');
         }
    }
    public function create()
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2){
            
            $setting                    = ModelsSetting::find(1);
            $data['logo']				= $setting['logo'];
            $data['situs']				= $setting['nama'];
            $data['favicon']			= $setting['favicon'];
            $data['author']				= $setting['pemilik'];

            $data['id']                 = '';
            $data['judul']			    = '';
            $data['image']			    = '';

            $data['title']              = 'Tambah Koleksi';
            $data['css']                = view('admin.partner.cssform')->with($data);
            $data['js']                 = view('admin.partner.jsform')->with($data);
            $data['script']             = view('admin.partner.scriptsform')->with($data);
            return view('admin.partner.form')->with($data);
        }else{
            return redirect('/appweb');
         }
    }

    public function edit($id)
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
            $query 	                    = ModelsPartner::where('id','=',$id)->get();
            if($query->count() > 0){

                foreach($query as $db){
                    $data['id']			= $id;
                    $data['judul']		= $db->judul;
                    $data['image']	    = $db->gambar;

                }
            }
            else{
                    $data['id']			= $id;
                    $data['judul']		= '';
                    $data['image']	    = '';

            }
            $setting                    = ModelsSetting::find(1);
            $data['logo']				= $setting['logo'];
            $data['situs']				= $setting['nama'];
            $data['favicon']			= $setting['favicon'];
            $data['author']				= $setting['pemilik'];
            $data['title'] 				= 'Edit Koleksi Partner';
            $data['css']                = view('admin.partner.cssform')->with($data);
            $data['js']                 = view('admin.partner.jsform')->with($data);
            $data['script']             = view('admin.partner.scriptsform')->with($data);
            return view('admin.partner.form')->with($data);
        }else{
            return redirect('/appweb');
        }
    }

    public function store(Request $request)
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
            date_default_timezone_set('Asia/Jakarta');
            
            $request->validate([
                'image'                 => 'mimes:png,jpg|max:2048px',
            ]);

            $file                       = $request->file('image');
            $imglama	                = $request->imagelama;

            if ($file) {
                $filename               = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
                $path                   = public_path('img');
                $file->move($path, $filename);
                $data = [
                    'judul'	            => $request->judul,
                    'gambar'            => $filename,
                ];
                File::delete(public_path('img/'.$imglama));

                $id						= $request->id;
                $d						= ModelsPartner::where('id','=',$id);
            }
            else {
                $data = [
                    'judul'	            => $request->judul,
                    'gambar'            => $imglama
                ];
                $id						= $request['id'];
                $d						= ModelsPartner::where('id','=',$id);
            }

            if ($d->count() > 0){
                ModelsPartner::where('id','=',$id)->update($data);
                return redirect('/appweb/partner')->with('SUCCESSMSG','Data Berhasil di Update');
            }
            else{
                ModelsPartner::create($data);
                return redirect('/appweb/partner')->with('SUCCESSMSG','Data Berhasil di Tambah');
            }
        }else{
            return redirect('/appweb');
         }
    }

    public function destroy(Request $request)
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2){
            $id                         = $request['id'];
            $slide                      = ModelsPartner::find($id);
            File::delete(public_path('img/'.$slide->gambar.''));
            $slide->delete();
            return redirect('/appweb/partner')->with('SUCCESSMSG','Data Berhasil di Hapus');
        }else{
            return redirect('/appweb');
        }
    }

    public function show()
	{
        if(Auth::user()->role == 1 || Auth::user()->role == 2){
            $total                      = ModelsPartner::get()->count();
            $length                     = intval($_REQUEST['length']);
            $length                     = $length < 0 ? $total: $length;
            $start                      = intval($_REQUEST['start']);
            $draw                       = intval($_REQUEST['draw']);

            $search                     = $_REQUEST['search']["value"];

            $output                     = array();
            $output['data']             = array();

            $end                        = $start + $length;
            $end                        = $end > $total ? $total : $end;

            $query                      = ModelsPartner::take($length)->skip($start)->orderBy('id','DESC')->get();
            
            if($search!=""){
            $query                      = ModelsPartner::orWhere('judul','like','%'.$search.'%')->orderBy('id','DESC')->get();
            $output['recordsTotal']     = $output['recordsFiltered']=$query->count();
            }

            $no=$start+1;
            foreach ($query as $partner) {
                if(!empty($partner['gambar'])){
                    $gambar = "<a href=".url(asset('img/'.$partner->gambar.''))." class='fancy-view'>
                            <img src=".url(asset('img/'.$partner->gambar.''))." alt='' border='0' class='img-responsive'>";
                }else{
                    $gambar = "<a href=".url(asset('img/no-image.png'))." class='fancy-view'>
                            <img src=".url(asset('img/no-image.png'))." class='img-responsive' alt='' border='0'>";
                }
                $output['data'][]=
                        array(
                            $no,
                            $partner->judul,
                            $gambar,
                            "<a class='btn btn-warning btn-sm' type='button' data-toggle='tooltip'  title='Edit'  href=".url('appweb/gallery/'.$partner->id.'/edit')."><i class='fa fa-pencil'></i></a>
                            <a href='javascript:void(0);' onclick='hapusid($partner->id)' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> </a>
                            "
                        );
            $no++;
            }

            $output['draw']             = $draw;
            $output['recordsTotal']     = $total;
            $output['recordsFiltered']  = $total;

            echo json_encode($output);
        }else{
            return redirect('/appweb');
         }
    }
}
