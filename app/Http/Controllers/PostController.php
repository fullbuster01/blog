<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('pages.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.posts.create', [
            'post' => new Post(),
            'categories' => Category::get(),
            'tags' => Tag::get()
        ]);  //seperti ini karna untuk membedakan pada bagian form
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        if (request()->file('thumbnail')) {
            $thumbnail = request()->file('thumbnail')->store("images/posts");
        } else {
            $thumbnail = null;
        }
        
        $params = $request->except('_token');
        $slug = Str::slug($params['title']);
        $params['slug'] = $slug;
        $params['category_id'] = request('category');
        $params['user_id'] = auth()->id();
        $params['thumbnail'] = $thumbnail;

        $post = auth()->user()->posts()->create($params); //ini ada di model user dan ini untuk menyimpan karna lebih aman

        $post->tags()->attach(request('tag')); // ini relasi dan untuk menyimpan tag ke database

        session()->flash('success', 'The post was created');

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $posts = Post::where('category_id', $post->category_id)->latest()->limit(6)->get();
        return view('pages.posts.show', compact('post', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // model binding
        return view('pages.posts.edit', [
            'post' => $post,
            'categories' => Category::get(),
            'tags' => Tag::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post); //ini policy

        // validasi untuk menghapus gambar yg sebelumnya jika diupdate
        if (request()->file('thumbnail')) {
            Storage::delete($post->thumbnail);
            $thumbnail = request()->file('thumbnail')->store("images/posts");
        }
        else {
            $thumbnail = $post->thumbnail;
        }

        $params = $request->except('_token');
        $params['category_id'] = request('category');
        $params['thumbnail'] = $thumbnail;

        $post->update($params);
        $post->tags()->sync(request('tag'));

        session()->flash('success', 'The post was updated');

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post); //ini policy
        $post->tags()->detach(); // ini ditambhkan ketika mendapatkan error {{ Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key constraint fails (`blog-parsinta`.`post_tag`, CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`)) }}

        Storage::delete($post->thumbnail);
        $post->delete();

        session()->flash('success', 'The post was deleted');

        return redirect()->route('posts.index');
    }
}
