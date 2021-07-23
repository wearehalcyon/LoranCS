<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class DashboardMenusController extends Controller{
    /**
     * DashboardThemesController constructor.
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.pages.dashboard-menus');
    }
}
