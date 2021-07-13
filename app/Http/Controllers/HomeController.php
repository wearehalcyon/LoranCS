<?php

namespace App\Http\Controllers;

use App\Helpers\Core;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $user = User::where([
            'id' => 1
        ])->first();

        // Make uplodas dirs
        if(!File::isDirectory(public_path('uploads/images'))) {
            File::makeDirectory(public_path('uploads/images'), 0777, true, true);
        }
        if(!File::isDirectory(public_path('uploads/documents'))) {
            File::makeDirectory(public_path('uploads/documents'), 0777, true, true);
        }
        if(!File::isDirectory(public_path('uploads/audio'))) {
            File::makeDirectory(public_path('uploads/audio'), 0777, true, true);
        }
        if(!File::isDirectory(public_path('uploads/video'))) {
            File::makeDirectory(public_path('uploads/video'), 0777, true, true);
        }

        if ($user) {
            return view('themes.' . Core::getOption('current_theme') . '.homepage');
        } else {
            return redirect(route('einstall-index'));
        }
    }
}
