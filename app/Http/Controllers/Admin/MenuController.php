<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu as ModelsMenu;
use App\Models\MenuItems as ModelsMenuItems;
use App\Models\Setting as ModelsSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 
    public function index(){
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
        
            $data['title']			        = "Menu";
            $setting                        = ModelsSetting::find(1);
            $data['logo']				    = $setting['logo'];
            $data['situs']				    = $setting['nama'];
            $data['favicon']			    = $setting['favicon'];
            $data['author']				    = $setting['pemilik'];
            $data['script']                 = view('admin.menu.scripts');

            $menu                           = new ModelsMenu();
            $menuitems                      = new ModelsMenuItems();
            $menulist                       = $menu->select(['id','name'])->get();
            $menulist                       = $menulist->pluck('name', 'id')->prepend('Select menu', 0)->all();
            
            if ((request()->has("action") && empty(request()->input("menu"))) || request()->input("menu") == '0') {
                
                return view('admin.menu.menu',$data)->with("menulist", $menulist);
        
            } else {
            
                $menu                       = ModelsMenu::find(request()->input("menu"));
                $menus                      = $menuitems->getall(request()->input("menu"));

                $d                          = ['menus' => $menus, 'indmenu' => $menu, 'menulist' => $menulist];
                if(false) {
                    $d['roles']             = DB::table('roles')->select('id','name')->get();
                    $d['role_pk']           = 'id';
                    $d['role_title_field']  = 'name';
                }
                return view('admin.menu.menu',$d)->with($data);
            }
        }else{
            return redirect('/appweb');
        }
    }

    public function createnewmenu()
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
        
            $menu = new ModelsMenu();
            $menu->name = request()->input("menuname");
            $menu->save();
            return json_encode(array("resp" => $menu->id));
        }else{
            return redirect('/appweb');
         }
    }

    public function deleteitemmenu()
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
            $menuitem = ModelsMenuItems::find(request()->input("id"));
            $menuitem->delete();
        }else{
            return redirect('/appweb');
        }
    }

    public function deletemenug()
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
    
            $menus = new ModelsMenuItems();
            $getall = $menus->getall(request()->input("id"));
            if (count($getall) == 0) {
                $menudelete = ModelsMenu::find(request()->input("id"));
                $menudelete->delete();

                return json_encode(array("resp" => "you delete this item"));
            } else {
                return json_encode(array("resp" => "You have to delete all items first", "error" => 1));

            }
        }else{
            return redirect('/appweb');
         }
    }

    public function updateitem()
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
            $arraydata = request()->input("arraydata");
            if (is_array($arraydata)) {
                foreach ($arraydata as $value) {
                    $menuitem = ModelsMenuItems::find($value['id']);
                    $menuitem->label = $value['label'];
                    $menuitem->link = $value['link'];
                    $menuitem->class = $value['class'];
                    if (false) {
                        $menuitem->role_id = $value['role_id'] ? $value['role_id'] : 0 ;
                    }
                    $menuitem->save();
                }
            } else {
                $menuitem = ModelsMenuItems::find(request()->input("id"));
                $menuitem->label = request()->input("label");
                $menuitem->link = request()->input("url");
                $menuitem->class = request()->input("clases");
                if (false) {
                    $menuitem->role_id = request()->input("role_id") ? request()->input("role_id") : 0 ;
                }
                $menuitem->save();
            }
        }else{
            return redirect('/appweb');
         }
    }

    public function addcustommenu()
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
            $menuitem = new ModelsMenuItems();
            $menuitem->label = request()->input("labelmenu");
            $menuitem->link = request()->input("linkmenu");
            if (false) {
                $menuitem->role_id = request()->input("rolemenu") ? request()->input("rolemenu")  : 0 ;
            }
            $menuitem->menu = request()->input("idmenu");
            $menuitem->sort = ModelsMenuItems::getNextSortRoot(request()->input("idmenu"));
            $menuitem->save();
        }else{
            return redirect('/appweb');
        }
    }

    public function generatemenucontrol()
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2 ){
        
            $menu = ModelsMenu::find(request()->input("idmenu"));
            $menu->name = request()->input("menuname");

            $menu->save();
            if (is_array(request()->input("arraydata"))) {
                foreach (request()->input("arraydata") as $value) {

                    $menuitem = ModelsMenuItems::find($value["id"]);
                    $menuitem->parent = $value["parent"];
                    $menuitem->sort = $value["sort"];
                    $menuitem->depth = $value["depth"];
                    if (false) {
                        $menuitem->role_id = request()->input("role_id");
                    }
                    $menuitem->save();
                }
            }
            echo json_encode(array("resp" => 1));
        }else{
            return redirect('/appweb');
         }
    }
}
