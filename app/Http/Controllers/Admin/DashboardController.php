<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Core;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller{
    public function __construct(){
      $this->middleware('auth');
    }

    /**
     * @return
     * Index dashboard
     */
    public function index(){
        $core = Core::class;
        $api = $core::serverAPI();

        return View('admin.pages.dashboard', [
            'version' => $api['version'],
            'build' => $api['build'],
            'codename' => $api['codename'],
            'appname' => $api['appname']
        ]);
    }

    public function coreUpdate(){

        $core = Core::class;
        $api = $core::serverAPI();
        $app = Core::App();

        $api_ver = $api['version'];
        $ver = Core::App()['ver'];

        if (Auth::user()->role == 0 || Auth::user()->role == 1) {
            $view = 'admin.pages.dashboard-core-update';
        } else {
            $view = 'admin.pages.dashboard-404';
        }

        return view($view, [
            'api' => $api,
            'app' => $app
        ]);
    }
}
