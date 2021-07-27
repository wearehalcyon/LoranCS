<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PostMeta;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
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
        ])->orderBy('date', 'desc')->paginate($showposts);

        $count = Post::where([
            'post_type' => 'post'
        ])->count();

        if (Auth::user()->role == 0 || Auth::user()->role == 1) {
            $view = 'admin.pages.dashboard-posts';
        } else {
            $view = 'admin.pages.dashboard-404';
        }

        return View($view, [
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

        $thumbnail = PostMeta::where([
            'post_id' => $id
        ])->delete();

        Session::flash('post-session', 'Post <strong>' . $post->title . '</strong> was deleted successfully!');

        if (Auth::user()->role == 0 || Auth::user()->role == 1) {
            $post->delete();

            return redirect()->back();
        }
    }

    /**
     * @return create post
     */
    public function createPost(){
        $categories = Category::get();

        $authors = User::get();

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
                'rtf',
                'txt'
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

        if (Auth::user()->role == 0 || Auth::user()->role == 1) {
            $view = 'admin.pages.dashboard-create';
        } else {
            $view = 'admin.pages.dashboard-404';
        }

        return view($view, [
            'categories' => $categories,
            'images' => $images,
            'audios' => $audios,
            'videos' => $videos,
            'documents' => $documents,
            'extensions' => $extensions,
            'authors' => $authors
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

    /**
     * Create post submit form
     */
    public function createPostSubmit(Request $request){

        // Insert new post
        $post = new Post();

        $post->title = $request->input('title') ? $request->input('title') : 'Untitled-' . date('mdyHIs');
        $post->user_id = $request->input('author_id');
        $post->content = $request->input('content');
        $post->excerpt = $request->input('excerpt');
        $post->status = $request->input('status');
        $post->comment_status = $request->input('comment_status');
        $post->slug = $request->input('slug') ? $request->input('slug') : 'untitled-' . date('mdyHIs');
        $post->date = date('Y-m-d H:i:s');
        $post->modified = date('Y-m-d H:i:s');
        $post->parent = 0;
        $post->post_type = 'post';
        $post->category_id = $request->input('category_id');
        $post->save();

        // Insert post thumbnail if available
        if ($request->input('featured_image')) {
            $thumbnail = new PostMeta();

            $thumbnail->post_id = $post->id;
            $thumbnail->meta_key = 'post_thumbnail';
            $thumbnail->meta_value = $request->input('featured_image');
            $thumbnail->date = date('Y-m-d H:i:s');
            $thumbnail->save();
        }

        Session::flash('post-session', 'Post <strong>' . $request->input('title') . '</strong> was created successfully!');

        return redirect(route('my-admin-posts'));
    }

    /**
     * Edit post
     */
    public function editPost($id){
        // Get post
        $post = Post::where([
            'id' => $id
        ])->first();
        // Get categories
        $categories = Category::get();
        // Get users
        $authors = User::get();
        // Get thumbnail
        $thumbnail = PostMeta::where([
            'post_id' => $id,
            'meta_key' => 'post_thumbnail'
        ])->first();
        if ($thumbnail) {
            $thumbnail = asset('public/uploads/' . $thumbnail->meta_value);
        } else {
            $thumbnail = null;
        }

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
                'rtf',
                'txt'
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

        if (Auth::user()->role == 0 || Auth::user()->role == 1) {
            $view = 'admin.pages.dashboard-edit';
        } else {
            $view = 'admin.pages.dashboard-404';
        }

        return view($view, [
            'post' => $post,
            'categories' => $categories,
            'images' => $images,
            'audios' => $audios,
            'videos' => $videos,
            'documents' => $documents,
            'extensions' => $extensions,
            'authors' => $authors,
            'thumbnail' => $thumbnail
        ]);
    }

    /**
     * Create post submit form
     */
    public function updatePostSubmit(Request $request){

        // Insert new post
        $post = Post::where([
            'id' => $request->input('postid')
        ])->first();
        // Get thumbnail
        $thumbnail = PostMeta::where([
            'post_id' => $request->input('postid'),
            'meta_key' => 'post_thumbnail'
        ])->first();
        if ($thumbnail) {
            $thumbnail_val = asset('public/uploads/' . $thumbnail->meta_value);
        } else {
            $thumbnail_val = null;
        }

        $post->title = $request->input('title') ? $request->input('title') : 'Untitled-' . date('mdyHIs');
        $post->user_id = $request->input('author_id');
        $post->content = $request->input('content');
        $post->excerpt = $request->input('excerpt');
        $post->status = $request->input('status');
        $post->comment_status = $request->input('comment_status');
        $post->slug = $request->input('slug') ? $request->input('slug') : 'untitled-' . date('mdyHIs');
        $post->date = $request->input('year') . '-' . $request->input('month') . '-' . $request->input('day') . ' ' . $request->input('hours') . ':' . $request->input('minutes');
        $post->modified = date('Y-m-d H:i:s');
        $post->parent = 0;
        $post->post_type = 'post';
        $post->category_id = $request->input('category_id');
        $post->save();

        // Insert post thumbnail if available
        if ($request->input('featured_image') && !$thumbnail_val) {
            $thumbnail = new PostMeta();

            $thumbnail->post_id = $post->id;
            $thumbnail->meta_key = 'post_thumbnail';
            $thumbnail->meta_value = $request->input('featured_image');
            $thumbnail->date = date('Y-m-d H:i:s');
            $thumbnail->save();
        } elseif (!$request->input('featured_image') && $thumbnail_val) {
            $thumbnail->delete();
        }

        Session::flash('post-session', 'Post <strong>' . $request->input('title') . '</strong> was updated successfully!');

        return redirect()->back();
    }
}
