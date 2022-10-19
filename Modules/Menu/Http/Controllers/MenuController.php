<?php

namespace Modules\Menu\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

use Modules\Menu\Entities\Menus;
use Modules\Menu\Entities\MenuItems;
use Modules\Blog\Entities\Category;
use Modules\Pages\Entities\Page;
use Modules\Blog\Entities\Post;

class MenuController extends Controller
{


    public function __construct()
    {
        // check on permissions
        $this->middleware('can:view-menus')->only('index');
        $this->middleware('can:create-menus')->only('createNewMenu');
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        breadcrumb([
            [
                'name' => __('menu::view.menus'),
            ],
        ]);

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('menu::'.$adminTheme.'.pages.menus.index');
    }


    public function createNewMenu()
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $menu = new Menus();
        $menu->name = request()->input("menuname");
        $menu->slug = Str::slug(request()->input("menuname"));
        $menu->place = request()->input("place");
        $menu->save();
        return json_encode(array("resp" => $menu->id));
    }



    public function addMenuItem()
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $ids = request()->input('ids');
        $menu_id = request()->input('menu_id');
        $type = request()->input('type');
        $data_saved = [];
        if ($type == 'category') {
            $categories = Category::select('id', 'name', 'slug')->whereIn('id', $ids)->get();
            foreach ($categories as $category) {
                foreach(get_langauges() as $key => $lang){
                    $title[$key] = $category->getOriginal('name')[$key] ?? '';
                }
                $data_saved[] = [
                    'label' => json_encode($title) ?? '',
                    'link' => $category->slug,
                    'type' => $type,
                    'menu' => $menu_id,
                    'sort' => MenuItems::getNextSortRoot($menu_id),
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        } else if ($type == 'post') {
            $posts = Post::select('id', 'title', 'slug')->whereIn('id', $ids)->get();
            foreach ($posts as $post) {
                foreach(get_langauges() as $key => $lang){
                    $title[$key] = $post->getOriginal('title')[$key] ?? '';
                }
                $data_saved[] = [
                    'label' => json_encode($title) ?? '',
                    'link' => $post->slug,
                    'type' => $type,
                    'menu' => $menu_id,
                    'sort' => MenuItems::getNextSortRoot($menu_id),
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        } 
        else if ($type == 'page') {
            $pages = Page::select('id', 'title', 'slug')->whereIn('id', $ids)->get();
            foreach ($pages as $page) {
                foreach(get_langauges() as $key => $lang){
                    $title[$key] = $page->getOriginal('title')[$key] ?? '';
                }
                $data_saved[] = [
                    'label' => json_encode($title) ?? '',
                    'link' => $page->slug,
                    'type' => $type,
                    'menu' => $menu_id,
                    'sort' => MenuItems::getNextSortRoot($menu_id),
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }
        else if ($type == 'static') {
            $pages = new Page;
            foreach ($ids as $page) {
                $obj   = array_column($pages->staticPages(), null, 'id')[$page] ?? false;
                $title = array();
                foreach (get_langauges() as $key => $lang) {
                    $title[$key] = $obj->title;
                }                
                $data_saved[] = [
                    'label' => json_encode($title) ?? '',
                    'link' => $obj->id,
                    'type' => $type,
                    'menu' => $menu_id,
                    'sort' => MenuItems::getNextSortRoot($menu_id),
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }
        
        if (count($data_saved)) {
            MenuItems::insert($data_saved);
        }
        return response()->json(['message' => 'saved']);
    }

    public function generatemenucontrol()
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }
        
        $menu = Menus::find(request()->input("idmenu"));
        $menu->name = request()->input("menuname");
        $menu->place = request()->input("place");

        $menu->save();
        if (is_array(request()->input("arraydata"))) {
            foreach (request()->input("arraydata") as $value) {

                $menuitem = MenuItems::find($value["id"]);
                $menuitem->parent = $value["parent"];
                $menuitem->sort = $value["sort"];
                $menuitem->depth = $value["depth"];
                if (config('menu.use_roles')) {
                    $menuitem->role_id = request()->input("role_id");
                }
                $menuitem->save();
            }
        }
        echo json_encode(array("resp" => 1));

    }


}
