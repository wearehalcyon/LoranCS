<?php

namespace App\Http\Controllers\myadmin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class DashboardPostsController extends Controller
{
    /**
     * DashboardPostsController constructor.
     */
    public function __construct(){
      $this->middleware('auth');
    }

    /**
     * @return @View
     * All Posts
     */
    public function index(Request $request){
        if ( !$request->query('showposts') ) {
            $showposts = 10;
        } else {
            $showposts = $request->query('showposts');
        }
        $posts = Post::where([
            'post_type' => 'post'
        ])->paginate($showposts);

        $count = Post::where([
            'post_type' => 'post'
        ])->count();

        return View('myadmin.pages.dashboard-posts', [
            'posts' => $posts,
            'count' => $count
        ]);
    }

    /**
     * @return delete post
     * Delete post
     */
    public function deletePost($id){
        $post = Post::where([
            'id' => $id
        ])->first();

        Session::flash('removed', 'Post <strong>' . $post->title . '</strong> was deleted successfully!');

        $post->delete();

        return redirect()->back();
    }

    /**
     * @return create post
     */
    public function createPost(){
        $categories = Category::get();

        // Files
        $images = scandir(public_path('uploads/images'));
        $audios = scandir(public_path('uploads/audio'));
        $videos = scandir(public_path('uploads/video'));
        $documents = scandir(public_path('uploads/documents'));
        $extensions = [
            'images' => [
                'jpeg',
                'jpg',
                'png',
                'bmp',
                'gif'
            ],
            'documents' => [
                'pdf',
                'ppt',
                'pptx',
                'pps',
                'ppsx',
                'doc',
                'docx',
                'odt',
                'xls',
                'xlsx',
                'key',
                'zip',
                'csv',
                'rtf'
            ],
            'audio' => [
                'mp3',
                'm4a',
                'wav',
                'ogg',
            ],
            'video' => [
                'mp4',
                'm4v',
                'mov',
                'wmv',
                'avi',
                'mpg',
                'ogv',
                '3gp',
                '3g2'
            ]
        ];

        return view('myadmin.pages.dashboard-create', [
            'categories' => $categories,
            'images' => $images,
            'audios' => $audios,
            'videos' => $videos,
            'documents' => $documents,
            'extensions' => $extensions
        ]);
    }
    /**
     * Delete file
     */
    public function deleteFile(Request $request){
        $file = public_path('uploads/' . $request->input('filename'));
        if (File::exists($file)) {
            File::delete($file);
        }
    }
}
