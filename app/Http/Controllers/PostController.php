<?php

namespace App\Http\Controllers;

use App\Models\{Post, User, Category, Tag};
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(6);

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        // Ambil Category yang sama
        $posts = Post::where("category_id", $post->category_id)->where('id','!=', $post->id)->get(); 
        
        // Ambil Tags yang sama
        $query = $post->tags;
        $tagx = Post::whereHas('tags', function($q) use($query){
            return $q->where('name','=', $query->pluck('name'));
        })->where('id', '!=', $post->id)->get();
        
        return view('posts.show',compact('post', 'posts', 'tagx'));
    }

    public function create()
    {
        return view('posts.create',['post' => new Post(), 'categories' => Category::get(), 'tags' => Tag::get()]);
    }

    public function store(PostRequest $request)
    {
        $data                   = $request->all();
        $data['slug']           = \Str::slug($request->title);
        $thumbnail              = request()->file('thumbnail') ? request()->file('thumbnail')->store('images/post') : null;
        $data['thumbnail']      = $request->thumbnail;
        $data['thumbnail']      = $thumbnail;
        $data['category_id']    = $request->category;

        $post = auth()->user()->posts()->create($data);

        $post->tags()->attach($request->tags);

        return redirect('posts')->with(['message'=>'Tambah data!', 'class' => 'success']);

    }

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post, 'categories' => Category::get(), 'tags' => Tag::get()]);

    }

    public function update(PostRequest $request, Post $post)
    {
        

        if(request()->hasFile('thumbnail'))
        {
            \Storage::delete($post->thumbnail);
            $thumbnail  = request()->file('thumbnail') ? request()->file('thumbnail')->store('images/post') : null;

        }else{

            $thumbnail = $post->thumbnail;

        }
        
        $data                   = $request->all();
        $data['thumbnail']      = $request->thumbnail;
        $data['thumbnail']      = $thumbnail;
        $data['category_id']    = $request->category;

        $post->update($data);

        $post->tags()->sync($request->tags);

        return redirect('posts')->with(['message' => 'Update data!', 'class' => 'info']);
    }

    public function destroy(Post $post)
    {
        \Storage::delete($post->thumbnail);
        $post->tags()->detach();
        $post->delete();

        return redirect('posts')->with(['message' => 'Hapus data!', 'class' => 'danger']);
    }
    
}
