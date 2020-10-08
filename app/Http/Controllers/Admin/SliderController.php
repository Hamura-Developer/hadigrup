<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting as ModelsSetting;
use App\Models\Slider as ModelsSlider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
class SliderController extends Controller
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
            $data['title']				= 'List Slider';

            $data['css']                = view('admin.slider.css');
            $data['js']                 = view('admin.slider.js');
            $data['script']             = view('admin.slider.scripts');
            return view('admin.slider.list')->with($data);
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
            $data['name']			    = '';
            $data['image']			    = '';
            $data['link']			    = '';
            $data['status']		        = '';

            $data['title']              = 'Tambah Slide';
            $data['dd_status']		    = $this->dd_status();
            $data['css']                = view('admin.slider.cssform')->with($data);
            $data['js']                 = view('admin.slider.jsform')->with($data);
            $data['script']             = view('admin.slider.scriptsform')->with($data);
            return view('admin.slider.form')->with($data);
        }else{
            return redirect('/appweb');
         }
    }

    public function edit($id)
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
            
            $query 	                    = ModelsSlider::where('id','=',$id)->get();
            if($query->count() > 0){

                foreach($query as $db){
                    $data['id']			= $id;
                    $data['name']		= $db->judul;
                    $data['link']		= $db->link;
                    $data['status']	    = $db->status;
                    $data['image']	    = $db->gambar;

                }
            }
            else{
                    $data['id']			= $id;
                    $data['name']		= '';
                    $data['link']		= '';
                    $data['status']	    = '';
                    $data['image']	    = '';

            }

            $setting                    = ModelsSetting::find(1);
            $data['logo']				= $setting['logo'];
            $data['situs']				= $setting['nama'];
            $data['favicon']			= $setting['favicon'];
            $data['author']				= $setting['pemilik'];

            $data['title'] 				= 'Edit Slider';

            $data['dd_status']		    = $this->dd_status();
            $data['css']                = view('admin.slider.cssform')->with($data);
            $data['js']                 = view('admin.slider.jsform')->with($data);
            $data['script']             = view('admin.slider.scriptsform')->with($data);
            return view('admin.slider.form')->with($data);
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
                    'judul'	            => $request['name'],
                    'gambar'            => $filename,
                    'link'	            => $request['link'],
                    'status'            => $request['status'],
                ];
                File::delete(public_path('img/'.$imglama));

                $id						= $request->id;
                $d						= ModelsSlider::where('id','=',$id);
            }
            else {
                $data = [
                    'judul'	            => $request['name'],
                    'link'	            => $request['link'],
                    'status'            => $request['status'],
                    'gambar'            => $imglama
                ];
                $id						= $request['id'];
                $d						= ModelsSlider::where('id','=',$id);
            }

            if ($d->count() > 0){
                ModelsSlider::where('id','=',$id)->update($data);
                return redirect('/appweb/sliders')->with('SUCCESSMSG','Data Berhasil di Update');
            }
            else{
                ModelsSlider::create($data);
                return redirect('/appweb/sliders')->with('SUCCESSMSG','Data Berhasil di Tambah');
            }
        }else{
            return redirect('/appweb');
        }
    }

    public function destroy(Request $request)
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
            $id                         = $request['id'];
            $slide                      = ModelsSlider::find($id);
            File::delete(public_path('img/'.$slide->gambar.''));
            $slide->delete();
            return redirect('/appweb/sliders')->with('SUCCESSMSG','Data Berhasil di Hapus');
        }else{
            return redirect('/appweb');
        }
    }

    public function show()
	{
		if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
            
            $total                      = ModelsSlider::get()->count();
            $length                     = intval($_REQUEST['length']);
            $length                     = $length < 0 ? $total: $length;
            $start                      = intval($_REQUEST['start']);
            $draw                       = intval($_REQUEST['draw']);

            $search                     = $_REQUEST['search']["value"];

            $output                     = array();
            $output['data']             = array();

            $end                        = $start + $length;
            $end                        = $end > $total ? $total : $end;

            $query                      = ModelsSlider::take($length)->skip($start)->orderBy('id','DESC')->get();

            if($search!=""){
            $query                      = ModelsSlider::orWhere('nama','like','%'.$search.'%')->orderBy('id','DESC')->get();
            $output['recordsTotal']     = $output['recordsFiltered']=$query->count();
            }

            $no=$start+1;
            foreach ($query as $slide) {
                if(!empty($slide['gambar'])){
                    $gambar = "<a href=".url(asset('img/'.$slide->gambar.''))." class='fancy-view'>
                            <img src=".url(asset('img/'.$slide->gambar.''))." alt='' border='0' class='img-responsive'>";
                }else{
                    $gambar = "<a href=".url(asset('img/no-image.png'))." class='fancy-view'>
                            <img src=".url(asset('img/no-image.png'))." class='img-responsive' alt='' border='0'>";
                }

                $output['data'][]=
                        array(
                            $no,
                            $slide->judul,
                            $slide->status =='1'?'<span class="label label-danger">Not Publish</span>':'<span class="label label-info">Publish</span>',
                            $gambar,
                            "<a class='btn btn-warning btn-sm' type='button' data-toggle='tooltip'  title='Edit'  href=".url('appweb/sliders/'.$slide->id.'/edit')."><i class='fa fa-pencil'></i></a>
                            <a href='javascript:void(0);' onclick='hapusid($slide->id)' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> </a>
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
    function dd_status(){
		$dd['']='---Status---';
        $dd['1']= 'Not Publish';
        $dd['2']= 'Publish';

		return $dd;
	}
}
