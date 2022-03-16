<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blogs.blog')
        ->with('posts',Post::orderBy('created_at','DESC')->paginate(6));
    }

    public function create()
    {
        return view(('blogs.create'));
    }

    public function store(Request $request)
    {
        $request ->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048',
            'short'=>'required'
        ]);

        $newImageName = time() . '-' . $request->title . '.' . $request->image->extension();
        $path = 'assets/images/blog/';
        $request->image->move(public_path($path), $newImageName);
        Post::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image_path' => $newImageName,
            'short'=>$request->input('short')
        ]);
        return redirect()->route('blogs.blog')->with('message', 'Your post has been added!');
    }

    public function show(Post $post)
    {

        return view('blogs.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('blogs.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request ->validate([
            'title' => 'required',
            'description' => 'required',
            'short'=>'required'
        ]);

        Post::update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'short'=>$request->input('short')
        ]);
        return redirect()->route('blogs.blog')->with('message', 'Your post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post ->delete();
        return redirect()->route('blogs.blog')->with('message','Your Post has been deleted!!');
    }
}
