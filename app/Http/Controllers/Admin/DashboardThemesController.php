<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Core;
use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class DashboardThemesController extends Controller{
    /**
     * DashboardThemesController constructor.
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * @return
     * Theme index page
     */
    public function index(){
        // Get all themes - RESOURCES
        $themes_res = scandir(resource_path('views/themes'));
        // Get all themes - PUBLIC
        //$themes_pub = scandir(public_path('themes'));
        // Get current theme
        $theme_curr = Core::getOption('current_theme');
        $theme_info = file_get_contents(resource_path('views/themes/' . $theme_curr . '/themeinfo.json'));
        $theme_info = json_decode($theme_info, true);
        //dd($theme_info);

        return view('admin.pages.dashboard-themes', [
            'themes_res' => $themes_res,
            //'themes_pub' => $themes_pub,
            'theme_curr' => $theme_curr,
            'theme_info' => $theme_info
        ]);
    }

    /**
     * @param $name
     * @return
     * Apply theme
     */
    public function applyTheme($name){
        $theme = Option::where([
            'option_name' => 'current_theme'
        ])->first();
        $theme->option_value = $name;
        $theme->save();

        Session::flash('theme-action-message', 'Theme was successfully applied!');

        return redirect()->back();
    }

    /**
     * @param $name
     * @return
     * Remove Theme
     */
    public function removeTheme($name){
        $theme_pub = public_path('themes/' . $name);
        $theme_res = resource_path('views/themes/' . $name);
        if (File::exists($theme_pub) || File::exists($theme_res)) {
            File::deleteDirectory($theme_pub);
            File::deleteDirectory($theme_res);
        }

        Session::flash('theme-action-message', 'Theme was deleted successfully!');

        return redirect()->back();
    }

    public function uploadTheme(Request $request){

        $theme = $request->file('theme_file');
        $extension = $theme->extension();
        $temp = base_path('temp');
        $filename = 'temp-themeinstallator-' . time() . '.zip';

        if ($theme) {
            if ($extension == 'zip') {
                $theme->move($temp, $filename);
                if (File::exists($temp . '/' . $filename)) {
                    Session::flash('theme-action-message', 'Theme uploaded successfully!');
                } else {
                    Session::flash('theme-action-message', 'Oops! Something went wrong and theme was not uploaded. Try again please.');
                    Session::flash('error');
                }
            } else {
                Session::flash('theme-action-message', 'This file is not theme archive. Please choose correct file with .zip extension.');
                Session::flash('error');
            }
        } else {
            //Session::flash('theme-action-message', 'This archive does not have a theme file in it, or it is damaged.');
            Session::flash('theme-action-message', 'Please choose theme archive!');
            Session::flash('error');
        }

        return redirect()->back();
    }
}
