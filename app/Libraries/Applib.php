<?php

namespace App\Libraries;

use App\Models\Blog as ModelsBlog;
use App\Models\Category as ModelsCategory;
use App\Models\Contact as ModelsContact;
use App\Models\Menu as ModelsMenu;
use App\Models\MenuItems as ModelsMenuItems;
use App\Models\Modul as ModelsModul;
use App\Models\Page as ModelsPage;
use App\Models\Slider as ModelsSlider;

use Illuminate\Support\Facades\DB;

class Applib {
    //SLIDER
    public static function get_slider_top(){
        $query= ModelsSlider::where('status',2)->where('tipe',1)->orderBy('posisi')->take(5)->get();
        return $query;
	}
	
	public static function get_countsliderTop(){
		$query= ModelsSlider::where('status',3)->where('tipe',1)->orderBy('posisi')->get()->count();
	}
	
    public static function WebMenu($id)
    {
        $menu            = ModelsMenu::where('id',$id)->with('items')->first();
        $public_menu     = $menu->items;
        return $public_menu;
        
    }
    
   public static function listInbox(){
        $query                      = ModelsContact::where('status','=','0')->orderBy('created_at','DESC')->get();
        return $query;
    }
    public static function totalInbox(){
        $totalinbox                 = ModelsContact::where('status','=','0')->get()->count();
        $semua                      = isset($totalinbox) ? $totalinbox : 0;
        return $semua;
    }
   
    public static function getJudulBlog($id){
        $query                      = ModelsBlog::where('id','=',$id)->get();
		if($query->count() > 0){
			foreach($query as $h){
				$hasil = $h->judul;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
    }

	
   public static function expired($id,$selisih) {
        $query          = " UPDATE jobs";
        $query_parent   = " SET expired = 0";
        $query_ids      = " WHERE DATEDIFF(CURDATE(),batas_waktu) > $selisih AND id =$id";
        DB::update($query.$query_parent.$query_ids);
   }
   public static function updatehits($id,$baca) {
        $query          = " UPDATE jobs";
        $query_parent   = " SET hits = $baca + 1";
        $query_ids      = " WHERE id =$id";
        DB::update($query.$query_parent.$query_ids);
   }
   
    public static function select($name = "menu", $menulist = array())
    {
        $html = '<select name="' . $name . '">';

        foreach ($menulist as $key => $val) {
            $active = '';
            if (request()->input('menu') == $key) {
                $active = 'selected="selected"';
            }
            $html .= '<option ' . $active . ' value="' . $key . '">' . $val . '</option>';
        }
        $html .= '</select>';
        return $html;
    }

    public static function getByName($name)
    {
        $menu = ModelsMenu::byName($name);
        return is_null($menu) ? [] : self::get($menu->id);
    }

    public static function get($menu_id)
    {
        $menuItem = new ModelsMenuItems();
        $menu_list = $menuItem->getall($menu_id);

        $roots = $menu_list->where('menu', (integer) $menu_id)->where('parent', 0);

        $items = self::tree($roots, $menu_list);
        return $items;
    }

    private static function tree($items, $all_items)
    {
        $data_arr = array();
        $i = 0;
        foreach ($items as $item) {
            $data_arr[$i] = $item->toArray();
            $find = $all_items->where('parent', $item->id);

            $data_arr[$i]['child'] = array();

            if ($find->count()) {
                $data_arr[$i]['child'] = self::tree($find, $all_items);
            }

            $i++;
        }

        return $data_arr;
    }

    public static function menupage(){
        $querypages     = ModelsPage::orderBy('id','ASC')->get();
        foreach ($querypages as $pages){
        echo "<tbody>
                <td>
                    $pages->nama_laman
                </td>
                <td align='center'>
                    <a  href='#' data-url='$pages->pages_seo' data-title='$pages->nama_laman'class='button-secondary tambahkan-ke-menu right'  >Add <i class='fa fa-sign-out'></i> </a>
                    <span class='spinner' id='spinkategori'></span>
                 </td>
            </tbody>";
        }
    }
    public static function menukategori(){
        $query     = ModelsCategory::where('_parent','=','1')->get();
        foreach ($query as $pages){
        echo "<tbody>
                <td>
                    $pages->kategori
                </td>
                <td align='center'>
                    <a href='#' data-url='blog/$pages->_slug' data-title='$pages->kategori' class='button-secondary tambahkan-ke-menu right'  >Add <i class='fa fa-sign-out'></i> </a>
                    <span class='spinner' id='spinkategori'></span>
                 </td>
            </tbody>";
        }
    }
    public static function menumodul(){
        $query     = ModelsModul::all();
        foreach ($query as $modul){
        echo "<tbody>
                <td>
                    $modul->nama
                </td>
                <td align='center'>
                    <a href='#' data-url='$modul->url_modul' data-title='$modul->nama' class='button-secondary tambahkan-ke-menu right'  >Add <i class='fa fa-sign-out'></i> </a>
                    <span class='spinner' id='spinkategori'></span>
                 </td>
            </tbody>";
        }
    }
}