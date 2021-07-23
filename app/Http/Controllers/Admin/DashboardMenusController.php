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

    public function index(){
        $menus = Menu::get();
        return view('admin.pages.dashboard-menus', [
            'menus' => $menus
        ]);
    }

    public function deleteMenu($id){
        $menu = Menu::where([
            'id' => $id
        ])->delete();

        Session::flash('menus-session', 'Menu was deleted successfully!');

        return redirect()->back();
    }
}
