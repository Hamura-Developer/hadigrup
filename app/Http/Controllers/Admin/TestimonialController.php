<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting as ModelsSetting;
use App\Models\Testimonial as ModelsTestimonial;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
        
            $setting                    = ModelsSetting::find(1);
            $data['logo']				= $setting['logo'];
            $data['situs']				= $setting['nama'];
            $data['favicon']			= $setting['favicon'];
            $data['author']				= $setting['pemilik'];
            $data['title']				= 'List Testimoni Klien';

            $data['css']                = view('admin.testimoni.css');
            $data['js']                 = view('admin.testimoni.js');
            $data['script']             = view('admin.testimoni.scripts');
            return view('admin.testimoni.list')->with($data);
        }else{
            return redirect('/appweb');
         }
    }
    public function create()
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
        
            $setting                    = ModelsSetting::find(1);
            $data['logo']				= $setting['logo'];
            $data['situs']				= $setting['nama'];
            $data['favicon']			= $setting['favicon'];
            $data['author']				= $setting['pemilik'];

            $data['id']                 = '';
            $data['namaclient']			= '';
            $data['perusahaan']		    = '';
            $data['image']			    = '';
            $data['testimoni']			= '';


            $data['title']              = 'Tambah Testimoni';

            $data['css']                = view('admin.testimoni.cssform')->with($data);
            $data['js']                 = view('admin.testimoni.jsform')->with($data);
            $data['script']             = view('admin.testimoni.scriptsform')->with($data);
            return view('admin.testimoni.form')->with($data);
        }else{
            return redirect('/appweb');
        }
    }

    public function edit($id)
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
            $query 	                    = ModelsTestimonial::where('id','=',$id)->get();
            if($query->count() > 0){

                foreach($query as $db){
                    $data['id']			= $id;
                    $data['namaclient'] = $db->klien;
                    $data['perusahaan']	= $db->perusahaan;
                    $data['testimoni']  = $db->testimoni;
                    $data['image']	    = $db->gambar;

                }
            }
            else{
                    $data['id']			= $id;
                    $data['namaclient'] = '';
                    $data['perusahaan']	= '';
                    $data['testimoni']  = '';
                    $data['image']	    = '';

            }

            $setting                    = ModelsSetting::find(1);
            $data['logo']				= $setting['logo'];
            $data['situs']				= $setting['nama'];
            $data['favicon']			= $setting['favicon'];
            $data['author']				= $setting['pemilik'];

            $data['title'] 				= 'Edit Testimoni';

            $data['css']                = view('admin.testimoni.cssform')->with($data);
            $data['js']                 = view('admin.testimoni.jsform')->with($data);
            $data['script']             = view('admin.testimoni.scriptsform')->with($data);
            return view('admin.testimoni.form')->with($data);
        }else{
            return redirect('/appweb');
         }
    }
    public function store(Request $request)
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
            
            date_default_timezone_set('Asia/Jakarta');
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=5000,max_height=5000',
            ]);

            $file                       = $request->file('image');
            $imglama	                = $request->imagelama;
            if ($file) {
                $filename               = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
                $path                   = public_path('img');
                $file->move($path, $filename);
                $data = [
                    'klien'	            => $request->namaclient,
                    'perusahaan'		=> $request->perusahaan,
                    'testimoni'         => $request->testimoni,
                    'gambar'  	        => $filename
                ];
                File::delete(public_path('img/'.$imglama));

                $id						= $request->id;
                $d						= ModelsTestimonial::where('id','=',$id);
            }
            else {
                $data = [
                    'klien'	            => $request->namaclient,
                    'perusahaan'		=> $request->perusahaan,
                    'testimoni'         => $request->testimoni,
                    'gambar'  	        => $imglama
                ];
                $id						= $request['id'];
                $d						= ModelsTestimonial::where('id','=',$id);
            }

            if ($d->count() > 0){
                ModelsTestimonial::where('id','=',$id)->update($data);
                return redirect('/appweb/testimoni')->with('SUCCESSMSG','Data Berhasil di Update');
            }
            else{
                ModelsTestimonial::create($data);
                return redirect('/appweb/testimoni')->with('SUCCESSMSG','Data Berhasil di Tambah');
            }
        }else{
            return redirect('/appweb');
        }
    }

    public function destroy(Request $request)
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
            $id                         = $request['id'];
            $testimoni                      = ModelsTestimonial::find($id);
            File::delete(public_path('img/'.$testimoni->gambar.''));
            $testimoni->delete();
            return redirect('/appweb/testimoni')->with('SUCCESSMSG','Data Berhasil di Hapus');
        }else{
            return redirect('/appweb');
         }
    }

    public function show()
	{
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
            $total                      = ModelsTestimonial::get()->count();
            $length                     = intval($_REQUEST['length']);
            $length                     = $length < 0 ? $total: $length;
            $start                      = intval($_REQUEST['start']);
            $draw                       = intval($_REQUEST['draw']);

            $search                     = $_REQUEST['search']["value"];

            $output                     = array();
            $output['data']             = array();

            $end                        = $start + $length;
            $end                        = $end > $total ? $total : $end;

            $query                      = ModelsTestimonial::take($length)->skip($start)->orderBy('id','DESC')->get();

            if($search!=""){
            $query                      = ModelsTestimonial::orWhere('klien','like','%'.$search.'%')->orderBy('id','DESC')->get();
            $output['recordsTotal']     = $output['recordsFiltered']=$query->count();
            }

            $no=$start+1;
            foreach ($query as $testimoni) {
                if(!empty($testimoni['gambar'])){
                    $gambar = "<a href=".url(asset('img/'.$testimoni->gambar.''))." class='fancy-view'>
                            <img src=".url(asset('img/'.$testimoni->gambar.''))." alt='' border='0' class='img-responsive'>";
                }else{
                    $gambar = "<a href=".url(asset('img/no-image.png'))." class='fancy-view'>
                            <img src=".url(asset('img/no-image.png'))." class='img-responsive' alt='' border='0'>";
                }
                $output['data'][]=
                        array(
                            $no,
                            $testimoni->klien,
                            $testimoni->perusahaan,
                            Str::limit($testimoni->testimoni,50),
                            $gambar,
                            "<a class='btn btn-warning btn-sm' type='button' data-toggle='tooltip'  title='Edit'  href=".url('appweb/testimoni/'.$testimoni->id.'/edit')."><i class='fa fa-pencil'></i></a>
                            <a href='javascript:void(0);' onclick='hapusid($testimoni->id)' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> </a>
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
