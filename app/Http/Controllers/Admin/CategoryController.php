<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category as ModelsCategory;
use App\Models\Setting as ModelsSetting;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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
            $data['title']				= 'List Kategori';

            $data['css']                = view('admin.categories.css');            
            $data['js']                 = view('admin.categories.js');             
            $data['script']             = view('admin.categories.scripts');
            return view('admin.categories.list')->with($data);
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
            
            $data['title']              = 'Tambah Kategori';
            $data['id']				    ='';
            $data['nama']			    ='';
            $data['status']		        ='';
            $data['parent']		        ='';
            $data['dd_parent']		    = $this->dd_parent();
            $data['dd_status']		    = $this->dd_status();
            $data['css']                = view('admin.categories.cssform')->with($data);
            $data['js']                 = view('admin.categories.jsform')->with($data);
            $data['script']             = view('admin.categories.scriptsform')->with($data);
            return view('admin.categories.form')->with($data);
        }else{
            return redirect('/appweb');
        }
    }

    
    public function edit($id)
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 3){
            
            $query 	                    = ModelsCategory::where('id','=',$id)->get();        
            if($query->count() > 0){
                
                foreach($query as $db){
                    $data['id']			= $id;
                    $data['nama']		= $db->kategori;
                    $data['status']	    = $db->status;
                    $data['parent']	    = $db->_parent;
                    
                }
            }
            else{
                $data['id']				= $id;
                $data['nama']		    = '';
                $data['status']	        = '';
                $data['parent']	        = '';
                
            }
            
            $setting                    = ModelsSetting::find(1);
            $data['logo']				= $setting['logo'];
            $data['situs']				= $setting['nama'];
            $data['favicon']			= $setting['favicon'];
            $data['author']				= $setting['pemilik'];
            
            $data['title'] 				= 'Edit Kategori';
            $data['dd_parent']		    = $this->dd_parent();
            $data['dd_status']		    = $this->dd_status();
            $data['css']                = view('admin.categories.cssform')->with($data);
            $data['js']                 = view('admin.categories.jsform')->with($data);
            $data['script']             = view('admin.categories.scriptsform')->with($data);
            return view('admin.categories.form')->with($data);
        }else{
            return redirect('/appweb');
         }
    }

    public function store(Request $request)
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 3){
            date_default_timezone_set('Asia/Jakarta');
            
            $data['kategori']			= $request->nama;
            $data['_parent'] 		    = $request->parent;
            $data['_slug'] 		        = Str::slug($request->nama,'-');
            $data['status'] 		    = $request->status;
            
            $id						    = $request->id;
            $d						    = ModelsCategory::where('id','=',$id);

            if ($d->count() > 0){
                ModelsCategory::where('id','=',$id)->update($data);
                return redirect('/appweb/categories')->with('SUCCESSMSG','Data Berhasil di Update');
            }
            else{
                ModelsCategory::create($data);
                return redirect('/appweb/categories')->with('SUCCESSMSG','Data Berhasil di Tambah');
            }
        }else{
            return redirect('/appweb');
         }
    }

    public function destroy(Request $request)
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 3){
            
            $id                         = $request['id'];
            $categories                 = ModelsCategory::find($id);
            $categories->delete();
            return redirect('/appweb/categories')->with('SUCCESSMSG','Data Berhasil di Hapus');
        }else{
            return redirect('/appweb');
         }
    }

    public function show()
	{
        if(Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 3){
        
            $total                      = ModelsCategory::get()->count();
            $length                     = intval($_REQUEST['length']);
            $length                     = $length < 0 ? $total: $length; 
            $start                      = intval($_REQUEST['start']);
            $draw                       = intval($_REQUEST['draw']);
            
            $search                     = $_REQUEST['search']["value"];
            
            $output                     = array();
            $output['data']             = array();
            
            $end                        = $start + $length;
            $end                        = $end > $total ? $total : $end;

            $query                      = ModelsCategory::take($length)->skip($start)->orderBy('id','DESC')->get();
            
            if($search!=""){
            $query                      = ModelsCategory::orWhere('kategori','like','%'.$search.'%')->orderBy('id','DESC')->get();
            $output['recordsTotal']     = $output['recordsFiltered']=$query->count();
            }

            $no=$start+1;
            foreach ($query as $categories) {
                $date                   = date('d-m-Y',strtotime($categories->created_at));
                $output['data'][]=
                        array(
                            $no,
                            $categories->kategori,
                            $date,
                            $categories->status =='1'?'<span class="label label-danger">Tidak Aktif</span>':'<span class="label label-success">Aktif</span>',
                            "<a href=".url('appweb/categories/'.$categories->id.'/edit')." class='btn btn-sm btn-primary btn-editable'><i class='fa fa-pencil'></i> </a>
                            <a href='javascript:void(0);' onclick='hapusid($categories->id)' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> </a>",
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
    function dd_parent(){
		$dd['1']= 'Blog';
		return $dd;
	}
}
