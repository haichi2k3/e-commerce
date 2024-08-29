<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AddBlogRequest;
use App\Models\Blog;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog = Blog::all();
        return view('admin.blog.blog', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        return view('admin.blog.add-blog');
    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('admin.blog.edit-blog', compact('blog'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function insert(AddBlogRequest $request)
    {
        $blog = new Blog();
        $blog->title = $request->input('title');
        $blog->description = $request->input('description');
        $blog->content = $request->input('content');
        
        $file = $request->file('image');
        if(!empty($file)) {
            $image =  $file->getClientOriginalName();
            $path = public_path('upload/blog/image');
            $file->move($path, $image);

            $blog->image = $image ; 
        };
        $blog->save();

        return redirect()->route('blog.index');
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
 

    /**
     * Update the specified resource in storage.
     */
    public function update(AddBlogRequest $request, $id)
    {
        $blog = Blog::find($id);
        $blog->title = $request->input('title');
        $blog->description = $request->input('description');
        $blog->content = $request->input('content');
        
        $file = $request->file('image');
        if(!empty($file)) {
            $image =  $file->getClientOriginalName();
            $path = public_path('upload/blog/image');
            $file->move($path, $image);

            $blog->image = $image ; 
        };
        $blog->save();

        return redirect()->route('blog.index')->with('success', __('Blog updated successfully.'));;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        Blog::find($id)->delete();
        return redirect()->route('blog.index');
    }
}
