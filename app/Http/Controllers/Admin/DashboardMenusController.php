<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardMenusController extends Controller{
    /**
     * DashboardThemesController constructor.
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * @return
     * Menu list
     */
    public function index(){
        $menus = Menu::get();

        if (Auth::user()->role == 0 || Auth::user()->role == 1) {
            $view = 'admin.pages.dashboard-menus';
        } else {
            $view = 'admin.pages.dashboard-404';
        }

        return view($view, [
            'menus' => $menus
        ]);
    }

    /**
     * @param Request $request
     * @return
     * Submit new menu
     */
    public function createMenuSubmit(Request $request){
        $menu = new Menu();
        $menu->menu_name = $request->input('menu_name');
        $menu->menu_location = $request->input('menu_location');
        $menu->save();

        Session::flash('menus-session', 'Menu was added successfully!');

        return redirect()->route('my-admin-edit-menu', [$menu->id]);
    }

    public function editMenu($id){
        $menu = Menu::where([
            'id' => $id
        ])->first();

        // Posts
        $posts = Post::get();

        // Menu items
        $menu_items = MenuItem::where([
            'menu_id' => $id
        ])->get();

        if (Auth::user()->role == 0 || Auth::user()->role == 1) {
            $view = 'admin.pages.dashboard-edit-menu';
        } else {
            $view = 'admin.pages.dashboard-404';
        }

        return view($view, [
            'menu' => $menu,
            'posts' => $posts,
            'menu_items' => $menu_items
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function editMenuSubmit(Request $request){
        $menu = Menu::where([
            'id' => $request->input('menu_id')
        ])->first();
        $menu->menu_name = $request->input('menu_name');
        $menu->menu_location = $request->input('menu_location');
        $menu->save();

        $field_arr = $request->input('menu_item');

        foreach ( $field_arr as $input ) {
            //dump($input);
            $menu_item = MenuItem::where([
                'order' => $input['menu_order']
            ])->first();
            $menu_item_new = new MenuItem();
            //dump($menu_item);
            if ( $menu_item ) {
                $menu_item->menu_id = $request->input('menu_id');
                $menu_item->title = $input['menu_title'];
                $menu_item->url = $input['menu_url'];
                $menu_item->order = $input['menu_order'];
                $menu_item->parent = $input['menu_parent'];
                $menu_item->save();
            } else {
                $menu_item_new->menu_id = $request->input('menu_id');
                $menu_item_new->title = $input['menu_title'];
                $menu_item_new->url = $input['menu_url'];
                $menu_item_new->order = $input['menu_order'];
                $menu_item_new->parent = $input['menu_parent'];
                $menu_item_new->save();
            }
        }

        return redirect()->back();
    }

    public function removeMenuItemSubmit($id){
        MenuItem::where([
            'id' => $id
        ])->delete();
    }

    /**
     * @param $id
     * @return
     * Delete menu
     */
    public function deleteMenu($id){
        $menu = Menu::where([
            'id' => $id
        ])->delete();

        Session::flash('menus-session', 'Menu was deleted successfully!');

        return redirect()->route('my-admin-menus');
    }
}
