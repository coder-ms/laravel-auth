<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    static $level_diff_max = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Se Adimn(1 su is_Admin -> database), visualizziamo tutti i post
        if(Auth::user()->isAdmin()){
            $posts = Post::paginate(4);
        } 
        // Se Utente(0 su is_Admin -> database), visualizziamo solo i propri post
        else {
            $userId = Auth::id();
            $posts = Post::where('user_id', $userId)->paginate(4);
        }
        // dd($posts);
        $ActUserId = Auth::id();
        $isUserAdmin = Auth::user()->isAdmin();
        $lvl_diff_max = PostController::$level_diff_max;
        //dd($ActUserId);
        //dd((Auth::user()->isAdmin()));
        //$posts = Post::all();
        $categories = Category::all();
        return view('admin.posts.index', compact('posts', 'categories', 'ActUserId', 'isUserAdmin', 'lvl_diff_max'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    public function create()
    {
        $lvl_diff_max =  PostController::$level_diff_max;
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'lvl_diff_max', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function store(StorePostRequest $request)
    {
        $userId = Auth::id();
        $data = $request->validated();
        $slug = Post::generateSlug($request->title);
        $data['slug'] = $slug;
        $data['user_id'] = $userId;
        //dd($request);
        $data['category_id'] = $request->category_id;
        $data['link_git'] = $request->link_git;
        $data['lvl_diff'] = $request->lvl_diff;
        if($request->hasFile('cover_image')){
            //$path = Storage::disk('public')->put('post_images', $request->cover_image);
            $path = Storage::put('post_images', $request->cover_image);
            $data['cover_image'] = $path;
        }
        
        //dd($data);
        $new_post = Post::create($data);
        
        if ($request->has('tags')) {
            $new_post->tags()->attach($request->tags);
        }
        return redirect()->route('admin.posts.show', $new_post->slug);
    }

    /**
     * Display the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $lvl_diff_max =  PostController::$level_diff_max;
        return view('admin.posts.show', compact('post', 'lvl_diff_max'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $lvl_diff_max =  PostController::$level_diff_max;
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'lvl_diff_max', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        if(!Auth::user()->isAdmin() && $post->user_id !== Auth::id()){
            abort(403);
        }
        $data = $request->validated();
        $slug = Post::generateSlug($request->title);
        $data['slug'] = $slug;
        $data['category_id'] = $request->category_id;
        $data['link_git'] = $request->link_git;
        $data['lvl_diff'] = $request->lvl_diff;
        //dd($request);
        if($request->hasFile('cover_image')){
            if ($post->cover_image) {
                Storage::delete($post->cover_image);
            }
            //$path = Storage::disk('public')->put('post_images', $request->cover_image);
            $path = Storage::put('post_images', $request->cover_image);
            $data['cover_image'] = $path;
        }
        //dd($data);
 
        $post->update($data);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }
        else {
            $post->tags()->sync([]);
        }

        return redirect()->route('admin.posts.index')->with('message', "$post->title updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * 
     * @param  \App\Models\Post  $post
     * 
     */
    public function destroy(Post $post)
    {
        if(!Auth::user()->isAdmin() && $post->user_id !== Auth::id()){
            abort(403);
        }
        if ($post->cover_image) {
            Storage::delete($post->cover_image);
        }
        $post->delete();
        return redirect()->route('admin.posts.index')->with('message', "$post->title deleted succesfully");
    }
}
