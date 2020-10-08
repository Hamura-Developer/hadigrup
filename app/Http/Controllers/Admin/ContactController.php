<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact as ModelsContact;
use App\Models\Setting as ModelsSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
	{
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
            $data['title']			    = "Kotak Pesan";
            $setting                    = ModelsSetting::find(1);
            $data['logo']				= $setting['logo'];
            $data['situs']				= $setting['nama'];
            $data['favicon']			= $setting['favicon'];
            $data['author']				= $setting['pemilik'];
            $data['datainbox'] 			= ModelsContact::orderBy('id','DESC')->get();
            $data['css']                = view('admin.inbox.css');            
            $data['js']                 = view('admin.inbox.js');             
            $data['script']             = view('admin.inbox.script');
            
            return view('admin.inbox.list')->with($data);
        }else{
            return redirect('/appweb');
         }
    }
    public function show()
	{	
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
        
            $data['datainbox'] 			= ModelsContact::orderBy('id','DESC')->get();
            return view('admin.inbox.inbox')->with($data);
        }else{
            return redirect('/appweb');
        }	
    }
    public function viewinbox(Request $request)
	{	
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
            $id                         = $request->message_id;
            $data['viewinbox'] 			= ModelsContact::where('id','=',$id)->get();
            $this->updateContact($id);
            return view('admin.inbox.view')->with($data);
        }else{
            return redirect('/appweb');
        }
    }
    public function balasinbox(Request $request)
	{	
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
            $id                         = $request->messageid;
            $data['viewinbox'] 			= ModelsContact::where('id','=',$id)->get();
            return view('admin.inbox.reply')->with($data);
        }else{
            return redirect('/appweb');
        }
    }
    public function tulis()
	{	
		if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
            return view('admin.inbox.compose');
		}else{
            return redirect('/appweb');
        }	
    }

    public function sendemail(Request $request){
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
            
            $config = [
                'useragent' 		=> 'Laravel',
                'protocol' 	 	    => 'smtp',
                'mailpath'  		=> '/usr/sbin/smtp',
                'smtp_host' 		=> 'mail.halokerja.id',
                'smtp_user' 		=> 'info@halokerja.id',   
                'smtp_pass' 		=> 'infohalokerja123123',             
                'smtp_port' 		=> 587,
                'smtp_keepalive'    => TRUE,
                'smtp_crypto' 	    => 'SSL',
                'wordwrap'  		=> TRUE,
                'wrapchars' 		=> 80,
                'mailtype' 		    => 'html',
                'charset'   		=> 'utf-8',
                'validate'  		=> TRUE,
                'crlf'      		=> "\r\n",
                'newline'   		=> "\r\n",
            ];

            //$this->email->initialize($config);
        
            $to						= $request->to;
            $cc						= $request->cc;
            $bcc					= $request->bcc; 
            $subject				= $request->subject; 
            $message				= $request->message; 
            $attach					= $request->files; 
            $from					= "info@halokerja.id";
            $name					= "Info@Halokerja.id";
            
            if(!empty($cc)){
                $cc_id = implode(",", $cc);
            }else{
                $cc_id = '';
            }
            if(!empty($bcc)){
                $bcc_id = implode(",", $bcc);
            }else{
                $bcc_id = '';
            }
            
            $this->email->from($from,$name);
            $this->email->to($to);
            $this->email->cc($cc_id);
            $this->email->bcc($bcc_id);
            $this->email->subject($subject);
            $this->email->message($message);
            foreach($attach as $ulang){
                $this->email->attach($ulang);
            }
            if($this->email->send()) {
                return with('SUCCESSMSG','Email berhasil terkirim ke alamat <strong>'.$to.'</strong>');
            }
            else {
                return with('GAGALMSG', 'Terjadi kesalahan. Harap ulangi kembali');
            }
            return redirect('/appweb/inbox');
        }else{
            return redirect('/appweb');
        }
    }
    public function updateContact($id){
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
            $query          = "UPDATE contacts";
            $query_parent   = " SET status = 1";
            $query_ids      = " WHERE id =$id";
            DB::update($query.$query_parent.$query_ids);
        }else{
            return redirect('/appweb');
        }
    }
    public function destroy($id){
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
            $inbox       = ModelsContact::find($id);
            $inbox->delete();
            return redirect ('appweb/inbox')->with('SUCCESSMSG','Pesan Berhasil Di Hapus');
        }else{
            return redirect('/appweb');
        }
	}

}
