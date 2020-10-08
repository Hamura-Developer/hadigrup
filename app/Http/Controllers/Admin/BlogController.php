<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Blog as ModelsBlog;
use App\Models\Category as ModelsCategory;
use App\Models\Setting as ModelsSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        if(Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 3){
            $setting                    = ModelsSetting::find(1);
            $data['logo']				= $setting['logo'];
            $data['situs']				= $setting['nama'];
            $data['favicon']			= $setting['favicon'];
            $data['author']				= $setting['pemilik'];
            $data['title']				= 'List Halaman';

            $data['css']                = view('admin.blogs.css');
            $data['js']                 = view('admin.blogs.js');
            $data['script']             = view('admin.blogs.scripts');
            return view('admin.blogs.list')->with($data);
        }else{
            return redirect('/appweb');
         }
    }

    public function create()
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 3){
            
            $setting                    = ModelsSetting::find(1);
            $data['logo']				= $setting['logo'];
            $data['situs']				= $setting['nama'];
            $data['favicon']			= $setting['favicon'];
            $data['author']				= $setting['pemilik'];

            $data['id']                 = '';
            $data['judul_blog']			= '';
            $data['kategori']			= '';
            $data['isi_blog']		    = '';
            $data['status']			    = '';
            $data['image']				= '';
            $data['meta_deskripsi']	    = '';
            $data['meta_keyword']		= '';


            $data['title']              = 'Tambah Artikel';
            $data['dd_status']		    = $this->dd_status();
            $data['dd_kategori']        = $this->dd_kategori();
            $data['css']                = view('admin.blogs.cssform')->with($data);
            $data['js']                 = view('admin.blogs.jsform')->with($data);
            $data['script']             = view('admin.blogs.scriptsform')->with($data);
            return view('admin.blogs.form')->with($data);
        }else{
            return redirect('/appweb');
         }    
    }

    public function edit($id)
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 3){
            
            $query 	                    = ModelsBlog::where('id','=',$id)->get();
            if($query->count() > 0){

            foreach($query as $db){
                $data['id']			    = $id;
                $data['judul_blog']		= $db->judul;
                $data['kategori']		= $db->kategori;
                $data['isi_blog']		= $db->konten;
                $data['status']	        = $db->status;
                $data['image']	        = $db->gambar;
                $data['meta_keyword']   = $db->meta_keyword;
                $data['meta_deskripsi']	= $db->meta_deskripsi;

                }
            }
            else{
                $data['id']			    = $id;
                $data['judul_blog']		= '';
                $data['kategori']		= '';
                $data['isi_blog']		= '';
                $data['status']	        = '';
                $data['image']	        = '';
                $data['meta_keyword']   = '';
                $data['meta_deskripsi']	= '';

            }

            $setting                    = ModelsSetting::find(1);
            $data['logo']				= $setting['logo'];
            $data['situs']				= $setting['nama'];
            $data['favicon']			= $setting['favicon'];
            $data['author']				= $setting['pemilik'];

            $data['title'] 				= 'Edit Artikel';

            $data['dd_status']		    = $this->dd_status();
            $data['dd_kategori']        = $this->dd_kategori();
            $data['css']                = view('admin.blogs.cssform')->with($data);
            $data['js']                 = view('admin.blogs.jsform')->with($data);
            $data['script']             = view('admin.blogs.scriptsform')->with($data);
            return view('admin.blogs.form')->with($data);
        }else{
            return redirect('/appweb');
         }
    }

    public function store(Request $request)
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 3){
            
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
                    'judul'	            => $request->judul_blog,
                    'slug'              => Str::slug($request->judul_blog,'-'),
                    'kategori'          => $request->kategori,
                    'konten'			=> $request->isi_blog,
                    'gambar'            => $filename,
                    'penulis'           => Auth::user()->name,
                    'status'	        => $request->status,
                    'meta_keyword'  	=> $request->meta_keyword,
                    'meta_deskripsi'    => $request->meta_deskripsi
                ];
                File::delete(public_path('img/'.$imglama));
                $id						= $request->id;
                $d						= ModelsBlog::where('id','=',$id);
            }
            else{
                $data = [
                    'judul'	            => $request->judul_blog,
                    'slug'              => Str::slug($request->judul_blog,'-'),
                    'kategori'          => $request->kategori,
                    'konten'			=> $request->isi_blog,
                    'gambar'            => $imglama,
                    'penulis'           => Auth::user()->name,
                    'status'	        => $request->status,
                    'meta_keyword'  	=> $request->meta_keyword,
                    'meta_deskripsi'    => $request->meta_deskripsi
                ];
                $id						= $request->id;
                $d						= ModelsBlog::where('id','=',$id);
            }
            if ($d->count() > 0){
                ModelsBlog::where('id','=',$id)->update($data);
                return redirect('/appweb/articles')->with('SUCCESSMSG','Data Berhasil di Update');
            }
            else{
                ModelsBlog::create($data);
                return redirect('/appweb/articles')->with('SUCCESSMSG','Data Berhasil di Tambah');
            }
        }else{
            return redirect('/appweb');
         }
    }

    public function destroy(Request $request)
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 3){
            $id                         = $request['id'];
            $articles                   = ModelsBlog::find($id);
            File::delete(public_path('img/'.$articles->gambar.''));
            $articles->delete();
            return redirect('/appweb/sliders')->with('SUCCESSMSG','Data Berhasil di Hapus');
        }else{
            return redirect('/appweb');
        }
    }

    public function show()
	{
		if(Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 3){
            
            $total                      = ModelsBlog::get()->count();
            $length                     = intval($_REQUEST['length']);
            $length                     = $length < 0 ? $total: $length;
            $start                      = intval($_REQUEST['start']);
            $draw                       = intval($_REQUEST['draw']);

            $search                     = $_REQUEST['search']["value"];

            $output                     = array();
            $output['data']             = array();

            $end                        = $start + $length;
            $end                        = $end > $total ? $total : $end;

            $query                      = ModelsBlog::take($length)->skip($start)->orderBy('id','DESC')->get();

            if($search!=""){
            $query                      = ModelsBlog::orWhere('judul','like','%'.$search.'%')->orderBy('id','DESC')->get();
            $output['recordsTotal']     = $output['recordsFiltered']=$query->count();
            }

            $no=$start+1;
            foreach ($query as $blog) {
                if(!empty($blog->gambar)){
                    $gambar = "<a href=".url(asset('img/'.$blog->gambar.''))." class='fancy-view'>
                            <img src=".url(asset('img/'.$blog->gambar.''))." alt='' border='0' class='img-responsive'>";
                }else{
                    $gambar = "<a href=".url(asset('img/no-image.png'))." class='fancy-view'>
                            <img src=".url(asset('img/no-image.png'))." class='img-responsive' alt='' border='0'>";
                }
                if($blog->status== 2){
                    $status = "<span class='label label-primary'>Aktif</span>";
                }else{
                    $status = "<span class='label label-warning'>Tidak Aktif</span>";
                }
                date_default_timezone_set('Asia/Jakarta');
                $date       = date('d-m-Y',strtotime($blog->created_at));
                $output['data'][]=
                        array(
                            $no,
                            $blog->judul,
                            $blog->penulis,
                            $status,
                            $date,
                            $blog->hits,
                            $gambar,
                            "<a class='btn btn-warning btn-sm' type='button' data-toggle='tooltip'  title='Edit'  href=".url('appweb/articles/'.$blog->id.'/edit')."><i class='fa fa-pencil'></i></a>
                            <a href='javascript:void(0);' onclick='hapusid($blog->id)' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> </a>
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
		$dd['1']= 'Not Publish';
        $dd['2']= 'Publish';

		return $dd;
	}
    function dd_kategori(){
		$query                      = ModelsCategory::where('_parent','=','1')->orderBy('id','ASC')->get();
        $dd['']                     = '---Pilih---';
        if ($query->count() > 0){
            foreach($query as $row){
                $dd[$row->_slug] = $row->kategori;
            }
        }
		return $dd;
    }

}
