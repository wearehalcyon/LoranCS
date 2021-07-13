<?php

namespace App\Http\Controllers\myadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardDocumentationController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    public function documentation(){
        return view('myadmin.pages.dashboard-docs');
    }
}
