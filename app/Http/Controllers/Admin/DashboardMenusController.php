<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
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
        return view('admin.pages.dashboard-menus', [
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
        return view('admin.pages.dashboard-edit-menu', [
            'menu' => $menu
        ]);
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
