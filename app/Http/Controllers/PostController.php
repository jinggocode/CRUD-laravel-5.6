<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Input;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $posts = Post::paginate(10);
        return view('post.index', compact('posts'));
    }
 
    public function search(Request $request)
    {
        $input = $request->input('title'); 
        $posts = Post::where('title', 'LIKE', '%'.$input.'%')->paginate(10);
        
        $posts->appends(['title' => $input]);
        return view('post.index', compact('posts', 'input'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $this->validate($request, [
            'title' => 'required|min:5',
            'body' => 'required|min:5',
        ]);
        Post::create($request->all());
 
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('post.view', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'body' => 'required|min:5',
        ]);
        $post = Post::findOrFail($id);
        $post->update($request->all());

        return redirect()->route('post.index')->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id); 
        $post->delete();

        return redirect()->route('post.index');

    }
}
