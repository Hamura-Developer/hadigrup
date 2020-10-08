<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting as ModelsSetting;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index(){
        if(Auth::user()->role == 1){
            $setting                    = ModelsSetting::find(1);
            $data['logo']				= $setting['logo'];
            $data['situs']				= $setting['nama'];
            $data['favicon']			= $setting['favicon'];
            $data['author']				= $setting['pemilik'];
            $data['title']				= 'List User';

            $data['css']                = view('admin.user.css');            
            $data['js']                 = view('admin.user.js');             
            $data['script']             = view('admin.user.scripts');
            return view('admin.user.list')->with($data);
        }else{
            return redirect('/appweb');
        }
    }

    public function create()
    {
        if(Auth::user()->role == 1){
            $setting                    = ModelsSetting::find(1);
            $data['logo']				= $setting['logo'];
            $data['situs']				= $setting['nama'];
            $data['favicon']			= $setting['favicon'];
            $data['author']				= $setting['pemilik'];
            
            $data['title']              = 'Tambah Pengguna';
            $data['id']		            = $this->kode_otomatis();
            $data['password']		    = '';
            $data['email']			    = '';
            $data['role']			    = '';
            $data['name']			    = '';
            
            $data['dd_role']            = $this->dd_role();
            $data['css']                = view('admin.user.cssform')->with($data);
            $data['js']                 = view('admin.user.jsform')->with($data);
            $data['script']             = view('admin.user.scriptsform')->with($data);
            return view('admin.user.create')->with($data);
        }else{
            return redirect('/appweb');
        }
    }

    public function store(Request $request)
    {
        $data =[ 
            'name'  		        => $request->name,
            'email' 			    => $request->email,
            'role'   			    => $request->role,
            'password'	    		=> Hash::make($request->password)
        ];
        ModelsUser::create($data);
        return redirect('/appweb/user')->with('SUCCESSMSG','Data Berhasil di Tambah');
        
    }

    public function edit($id)
    {
        if(Auth::user()->role == 1){
            $query 	                    = ModelsUser::where('id','=',$id)->get();
            if($query->count() > 0){
                
                foreach($query as $db){
                    $data['id']			= $id;
                    $data['name']		= $db->name;
                    $data['email']	    = $db->email;
                    $data['role']	    = $db->id;
                    
                }
            }
            else{
                $data['id']				= $id;
                $data['name']			= '';
                $data['email']		    = '';
                $data['role']		    = '';
                
            }
            
            $setting                    = ModelsSetting::find(1);
            $data['logo']				= $setting['logo'];
            $data['situs']				= $setting['nama'];
            $data['favicon']			= $setting['favicon'];
            $data['author']				= $setting['pemilik'];
            
            $data['title'] 				= 'Edit Pengguna';
            $data['dd_role']            = $this->dd_role();
            $data['css']                = view('admin.user.cssform')->with($data);
            $data['js']                 = view('admin.user.jsform')->with($data);
            $data['script']             = view('admin.user.scriptsforms')->with($data);
            return view('admin.user.edit')->with($data);
        }else{
            return redirect('/appweb');
        }
    }

    public function update(Request $request)
    {
        if(Auth::user()->role == 1){
            $data =[ 
                'name'  		        => $request->name,
                'email' 			    => $request->email,
                'role'  			    => $request->role,
                'password'	    		=> Hash::make($request->password)
            ];
            $id						    = $request->id;
        

            if(empty($request->password)){
                ModelsUser::where('id','=',$id)->update(array('email'=>$request->email,'name'=>$request->name,'role'=>$request->role));
                return redirect('/appweb/user')->with('SUCCESSMSG','Data Berhasil di Update');
            }else{
                ModelsUser::where('id','=',$id)->update($data);
                return redirect('/appweb/user')->with('SUCCESSMSG','Data Berhasil di Update');
            }
        }else{
            return redirect('/appweb');
        }
    }

    public function destroy(Request $request)
    {
        if(Auth::user()->role == 1){
            $id                         = $request->id;
            $user                       = ModelsUser::find($id);
            $user->delete();
            return redirect('/appweb/user')->with('SUCCESSMSG','Data Berhasil di Hapus');
        }else{
            return redirect('/appweb');
        }
    }

    public function show()
	{
        if(Auth::user()->role == 1){
            $total                      = ModelsUser::get()->count();
            $length                     = intval($_REQUEST['length']);
            $length                     = $length < 0 ? $total: $length; 
            $start                      = intval($_REQUEST['start']);
            $draw                       = intval($_REQUEST['draw']);
            
            $search                     = $_REQUEST['search']["value"];
            
            $output                     = array();
            $output['data']             = array();
            
            $end                        = $start + $length;
            $end                        = $end > $total ? $total : $end;

            $query                      = ModelsUser::take($length)->skip($start)->orderBy('id','DESC')->get();
            
            if($search!=""){
            $query                      = ModelsUser::orWhere('name','like','%'.$search.'%')->orderBy('id','DESC')->get();
            $output['recordsTotal']     = $output['recordsFiltered']=$query->count();
            }

            $no=$start+1;
            foreach ($query as $user) {
                if ($user->id == 1 ){
                    $cek = "<a class='btn btn-warning btn-sm' type='button' data-toggle='tooltip'  title='Edit'  href=".url('appweb/user/'.$user->id.'/edit')."><i class='fa fa-pencil'></i></a>
                    ";
                }else{
                    $cek= "<a class='btn btn-warning btn-sm' type='button' data-toggle='tooltip'  title='Edit'  href=".url('appweb/user/'.$user->id.'/edit')."><i class='fa fa-pencil'></i></a>
                                <a href='javascript:void(0);' onclick='hapusid($user->id)' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> </a>
                                ";
                }
                if ($user->role == 1 ){
                        $role = "Superadmin";
                }elseif ($user->role == 2) {
                    $role = "Admin";
                }else{
                    $role = "User";
                }
            $output['data'][]=
                        array(
                            $no,
                            $user->email,
                            $user->name,
                            $role,
                            $cek
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
    function kode_otomatis()
    {
        $query          = ModelsUser::select(DB::raw('MAX(RIGHT(id,1)) as kode_max'))->get();
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
    public function cekemail(Request $request)
	{
		$email          = $request->email;
		$cek            = ModelsUser::select('email')->where('email',$email)->get();
		if($cek->count() == 0)
		{
			echo "true";
		
		}
		else
		{
			echo "false";
		}
    }
    function dd_role(){
		$dd['1']= 'Superadmin';
        $dd['2']= 'Admin';
        $dd['3']= 'User';

		return $dd;
	}
}
