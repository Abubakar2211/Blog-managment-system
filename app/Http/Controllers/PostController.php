<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $categories = Category::all();
    
        if(auth()->user()->role->name === 'Admin') 
        {
            $posts = Post::all();
        } else {
            $posts = Post::where('user_id', auth()->id())->get();
        }
        
        return view('admin.all-post', compact('posts', 'categories'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("admin.post",compact('categories'));
    }

  

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id', 
            'status' => 'required|in:draft,published',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'status' => $request->status,
        ]);
    
        $post->categories()->attach($request->category_id);
    
        return redirect()->back()->with('success', 'Post created successfully!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $selectCategories = $post->categories->pluck('id')->toArray();
        return view('admin.post-edit',compact('categories','post','selectCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id',
            'status' => 'required|in:draft,published',
        ]);

        if ($validator->fails()) {
            return redirect('post')->withErrors($validator)->withInput();
        }

        $post->update([
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => Auth::id(),
                'status' => $request->status,
        ]);        
        $post->categories()->sync($request->category_id);
        
        return redirect()->route('post.index')->with('success', 'Post update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Post $post)
    {
        if (auth()->user()->role !== 'admin' && $post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    
        $post->delete();
        return redirect()->route('post.index')->with('success', 'Post deleted successfully!');
    }
}
