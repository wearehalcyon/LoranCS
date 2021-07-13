<?php
namespace App\Helpers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Option;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Core {
    public static function App(){
        return [
            'appname' => '<a href="https://loranengine.org/" target="_blank">LoranCS</a>',
            'ver' => '1.0.1',
            'build' => '070621',
            'release' => 'alpha',
            'codename' => 'Neptune',
        ];
    }

    /**
     * @return string
     * HTML Head main core styles
     */
    public static function styles($gfonts = true, $jquery = false){
        $styles = scandir(public_path('/includes/css/'));
        // Google fonts
        if ($gfonts) {
            echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
            echo '<link id="core-style-asset-gfonts" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">';
        }
        // All styles
        foreach ( $styles as $style ) {
            if ( !is_dir($style) ) {
                $id = str_replace('.css', '', $style);
                echo '<link id="core-style-asset-' . $id . '" rel="stylesheet" href="' . asset('public/includes/css/' . $style) . '">';
            }
        }
        // jQuery init
        if ($jquery == true) {
            echo '<script id="core-jquery" src="' . asset('public/includes/js/core/jquery.js') . '"></script>';
        }
    }

    /**
     * @param null $jquery
     * HTML Footer main core scripts
     */
    public static function scripts($jquery = true){
        $scripts = scandir(public_path('/includes/js/'));
        // jQuery core
        if ($jquery) {
            echo '<script id="core-jquery" src="' . asset('public/includes/js/core/jquery.js') . '"></script>';
        }
        // All scripts
        foreach ( $scripts as $script ) {
            if ( !is_dir($script) && $script != 'core' ) {
                $id = str_replace('.js', '', $script);
                echo '<script id="core-asset-script-' . $id . '" src="' . asset('public/includes/js/' . $script) . '"></script>';
            }
        }
    }

    /**
     * @param null $class
     * HTML Body classes markup
     */
    public static function bodyClass($class = null){
        $install = str_replace('/install-engine', 'engine-installation', Route::getCurrentRoute()->getPrefix());
        if ($install) {
            $install_class = ' engine-installation';
        } else {
            $install_class = '';
        }
        if ( $class ) {
            echo ' class="core-ui body-class ' . Route::currentRouteName() . $install_class . ' ' . $class . '"';
        } else {
            echo ' class="core-ui body-class ' . Route::currentRouteName() . $install_class . '"';
        }
    }

    /**
     * @param $location
     */
    public static function getMenu($location){
        $menu = Menu::where([
            'menu_location' => $location
        ])->first();
        if ($menu) {
            $menu_items = MenuItem::where([
                'menu_id' => $menu->id,
                'parent' => 0
            ])->get();
            echo '<ul class="menu-' . $location . '">';
                foreach( $menu_items as $menu_item ) {
                    echo '<li class="menu-item menu-item-id-' . $menu_item->id . '">';
                        echo '<a href="' . $menu_item->url . '">' . $menu_item->title . '</a>';
                        $submenus = MenuItem::where([
                            'parent' => $menu_item->id
                        ])->get();
                        if (!$submenus->isEmpty()) {
                            echo '<ul class="sub-menu">';
                                foreach( $submenus as $submenu ) {
                                    echo '<li class="menu-item menu-item-id-' . $submenu->id . '">';
                                        echo '<a href="' . $submenu->url . '">' . $submenu->title . '</a>';
                                    echo '</li>';
                                }
                            echo '</ul>';
                        }
                    echo '</li>';
                }
            echo '</ul>';
        }
    }

    /**
     * @param null $name
     * @return false
     */
    public static function getOption($name = null){
        $option = Option::where([
            'option_name' => $name
        ])->first();
        if ($option) {
            return $option->option_value;
        }
        return false;
    }

    /**
     * Return list of styles
     */
    public static function enqueueStyles(){
        if (file_exists(resource_path('views/themes/' . Core::getOption('current_theme') . '/functions.php'))) {
            require_once resource_path('views/themes/' . Core::getOption('current_theme') . '/functions.php');
        }
        if (function_exists('init_styles')) {
            $styles = init_styles();
            // Echo core styles
            echo '<link id="style-core-iconfont" rel="stylesheet" href="' . asset('public/includes/admin/css/icofont.min.css') . '">';
            // Show theme styles
            foreach ($styles as $style) {
                echo '<link id="style-' . str_replace('.css', '', basename($style)) . '" rel="stylesheet" href="' . asset('public/themes/' . Core::getOption('current_theme') . $style) . '">';
            }
        }
    }

    /**
     * Return list of scripts
     */
    public static function enqueueScripts($adminbar = true){
        // Init admin bar
        if ( $adminbar == true && Auth::user() ) {
            require_once resource_path('views/core/front/admin-bar.blade.php');
            // Show core styles
            echo '<link id="style-admin-bar" rel="stylesheet" href="' . asset('public/includes/front/css/admin-bar.css') . '">';
        }
        // Scripts
        if (file_exists(resource_path('views/themes/' . Core::getOption('current_theme') . '/functions.php'))) {
            require_once resource_path('views/themes/' . Core::getOption('current_theme') . '/functions.php');
        }
        // Show theme scripts
        if (function_exists('init_scripts')) {
            $scripts = init_scripts();
            foreach ($scripts as $script) {
                echo '<script id="script-' . str_replace('.js', '', basename($script)) . '" src="' . asset('public/themes/' . Core::getOption('current_theme') . $script) . '"></script>';
            }
        }
        // Show core scripts
        echo '<script id="script-front-core" src="' . asset('public/includes/front/js/app.js') . '"></script>';
    }

    /**
     * @param null $request
     * @return string
     */
    public static function getHomeUrl($request = null){
        if ($request) {
            return asset($request);
        }
        return asset('');
    }

    /**
     * @param string $type
     * @return false
     */
    public static function getPosts($type = 'post'){
        $posts = Post::where([
            'post_type' => $type
        ])->get();
        if ($posts) {
            return $posts;
        }
        return false;
    }

    /**
     * @param null $id
     * @return false
     */
    public static function getAuthor($id = null){
        $author = User::where([
            'id' => $id
        ])->first();
        if ($author) {
            return $author;
        }
        return false;
    }

    /**
     * @param null $format
     * @param null $date
     * @return false|string
     */
    public static function getTime($format = null, $date = null){
        return date($format, strtotime($date));
    }

    /**
     * @param null $content
     * @param null $end
     * @return string
     */
    public static function trimWords($content = null, $limit = null, $end = null){
        return Str::limit($content, $limit, $end);
    }

    /**
     * @param null $id
     * @return mixed
     */
    public static function getPostCategory($id = null){
        $category = Category::where([
            'id' => $id
        ])->first();
        return $category;
    }

    public static function getComments($field = 'post_id', $id = null){
        if ( $field == 'user_id' ) {
            $comments = Comment::where([
                'user_id' => $id
            ]);
        } else {
            $comments = Comment::where([
                'post_id' => $id
            ]);
        }
        return $comments;
    }
}
