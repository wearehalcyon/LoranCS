<?php

namespace App\Http\Controllers\Admin;

use App\Darwin\Core;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardSettingsController extends Controller{
    /**
     * DashboardThemesController constructor.
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        if ( !file_exists(base_path('robots.disallowed.txt')) ) {
            file_put_contents(base_path('robots.disallowed.txt'), "User-agent: *\r\nDisallow: /", LOCK_EX);
        } else {
            $robots_d = fopen(base_path('robots.disallowed.txt'), 'r+');
                fwrite($robots_d, "User-agent: *\r\nDisallow: /");
            fclose($robots_d);
        }

        if ( file_exists(base_path('robots.txt')) ) {
            $robots = fopen(base_path('robots.txt'), 'r+');
        }

        return view('admin.pages.dashboard-general-settings', [
            'robots' => $robots
        ]);
        fclose($robots);
    }
}
