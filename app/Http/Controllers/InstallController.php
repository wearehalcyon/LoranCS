<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Option;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class InstallController extends Controller{
    /**
     * InstallController constructor.
     */
    public function __construct(){
        $this->middleware('guest');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function run(){
        $user = User::where([
            'id' => 1
        ])->first();

        if ( !$user ) {
            return view('core.install.pages.index');
        } else {
            return redirect(route('home'));
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function stepOne(){
        $user = User::where([
            'id' => 1
        ])->first();

        if ( !$user ) {
            // Check .env file if exist
            $env = File::exists($_SERVER['DOCUMENT_ROOT'] . '/.env');
            if ($env) {
                $env_file = '<span class="status-message php-relevant" data-status="approved">File Available</span>';
            } else {
                $env_file = '<span class="status-message php-outofdate" data-status="not-approved">File Not Found</span>';
            }
            // Check PHP version
            if (phpversion() < '7.4') {
                $php = '<span class="status-message php-outofdate" data-status="not-approved">' . phpversion() . '</span>';
            } else {
                $php = '<span class="status-message php-relevant" data-status="approved">' . phpversion() . '</span>';
            }
            // Check RAM memory
            if (str_replace('M', '', ini_get('memory_limit')) < '32') {
                $ram = '<span class="status-message php-outofdate" data-status="not-approved">' . ini_get('memory_limit') . '</span>';
            } else {
                $ram = '<span class="status-message php-relevant" data-status="approved">' . ini_get('memory_limit') . '</span>';
            }
            // Check disk free space
            $size = floor(disk_free_space('/') / 1000000000 * 1024);
            if ( $size < 300 ) {
                if ( $size >= 1024 ) {
                    $size = floor($size / 1000);
                    $dfs = '<span class="status-message php-outofdate" data-status="not-approved">' . $size . 'G</span>';
                } else {
                    $dfs = '<span class="status-message php-outofdate" data-status="not-approved">' . $size . 'M</span>';
                }
            } else {
                if ( $size >= 1024 ) {
                    $size = floor($size / 1000);
                    $dfs = '<span class="status-message php-relevant" data-status="approved">' . $size . 'G</span>';
                } else {
                    $dfs = '<span class="status-message php-relevant" data-status="approved">' . $size . 'M</span>';
                }
            }
            return view('core.install.pages.step-one', [
                'env' => $env_file,
                'php' => $php,
                'ram' => $ram,
                'dfs' => $dfs
            ]);
        } else {
            return redirect(route('home'));
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function stepTwo(){
        $user = User::where([
            'id' => 1
        ])->first();

        if ( !$user ) {
            return view('core.install.pages.step-two');
        } else {
            return redirect(route('home'));
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function createAccount(Request $request){
        // Insert Administrator account
        $user = new User();
        $user->id = 1;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->created_at = date('Y-m-d H:i:s');
        $user->save();

        // Insert category
        $category = [
            [
                'id' => 1,
                'name' => 'Uncategorized',
                'slug' => 'uncategorized',
                'parent' => 0,
                'date' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ]
        ];
        Category::insert($category);

        // Insert post and page
        $posts = [
            [
                'id' => 1,
                'user_id' => 1,
                'title' => 'Hello World!',
                'content' => 'This is the first entry. You can edit it or delete it. In the admin panel, you can also add new ones. You have complete control over content creation. Thank you for choosing HнpeForm Engine!',
                'status' => 'published',
                'comment_status' => 'opened',
                'slug' => 'hello-world',
                'date' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                'parent' => 0,
                'post_type' => 'post',
                'category_id' => 1
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'title' => 'Sample Page',
                'content' => 'This is the first entry. You can edit it or delete it. In the admin panel, you can also add new ones. You have complete control over content creation. Thank you for choosing HнpeForm Engine!',
                'status' => 'published',
                'comment_status' => 'closed',
                'slug' => 'sample-page',
                'date' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                'parent' => 0,
                'post_type' => 'page',
                'category_id' => null
            ],
        ];
        Post::insert($posts);

        // Insert comment
        $comment = [
            [
                'id' => 1,
                'user_id' => 1,
                'post_id' => 1,
                'message' => 'Hi! I am your first comment. You can delet or edit me in admin dashboard area. Good luck and enjoy :)',
                'status' => 'published',
                'date' => date('Y-m-d H:i:s')
            ]
        ];
        Comment::insert($comment);

        // Insert starter options
        if(isset($_SERVER['HTTPS'])){
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        }
        else{
            $protocol = 'http';
        }
        $options = [
            [
                'option_name' => 'siteurl',
                'option_value' => $protocol . "://" . $_SERVER['HTTP_HOST'],
                'force' => 1
            ],
            [
                'option_name' => 'sitename',
                'option_value' => $request->input('sitename'),
                'force' => 1
            ],
            [
                'option_name' => 'sitedesc',
                'option_value' => 'Just another site with HypeForm Engine',
                'force' => 1
            ],
            [
                'option_name' => 'admin_email',
                'option_value' => $request->input('email'),
                'force' => 0
            ],
            [
                'option_name' => 'current_theme',
                'option_value' => 'whitehouse',
                'force' => 1
            ],
            [
                'option_name' => 'registration',
                'option_value' => 'opened',
                'force' => 0
            ],
        ];
        Option::insert($options);

        // Insert menu
        $menu = new Menu();
        $menu->id = 1;
        $menu->menu_name = 'Main Menu';
        $menu->menu_location = 'main_menu';
        $menu->save();

        // Insert menu items
        $menu_items = [
            [
                'menu_id' => 1,
                'title' => 'Home',
                'url' => $protocol . '://' . $_SERVER['HTTP_HOST'] . '/',
                'parent' => 0
            ],
            [
                'menu_id' => 1,
                'title' => 'Hello World!',
                'url' => $protocol . '://' . $_SERVER['HTTP_HOST'] . '/hello-world',
                'parent' => 0
            ],
            [
                'menu_id' => 1,
                'title' => 'Sample Page',
                'url' => $protocol . '://' . $_SERVER['HTTP_HOST'] . '/sample-page',
                'parent' => 0
            ],
            [
                'menu_id' => 1,
                'title' => 'Account',
                'url' => '#',
                'parent' => 0
            ],
            [
                'menu_id' => 1,
                'title' => 'Login',
                'url' => $protocol . '://' . $_SERVER['HTTP_HOST'] . '/login',
                'parent' => 4
            ],
            [
                'menu_id' => 1,
                'title' => 'Register',
                'url' => $protocol . '://' . $_SERVER['HTTP_HOST'] . '/register',
                'parent' => 4
            ],
        ];
        MenuItem::insert($menu_items);

        return redirect(route('einstall-finished'));
    }

    public function finish(){
        $user = User::where([
            'id' => 1
        ])->first();

        if ( $user ) {
            return view('core.install.pages.finish');
        } else {
            return redirect(route('einstall-index'));
        }
    }
}
