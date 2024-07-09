<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view-blog', ['only' => ['index']]);
        $this->middleware('permission:create-blog', ['only' => ['create', 'store']]);
        $this->middleware('permission:show-blog', ['only' => ['show']]);
        $this->middleware('permission:edit-blog', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-blog', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::paginate(5);

        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        Blog::create($request->all());

        return redirect()->route('blogs.index');
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
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        $blog->update($request->all());

        return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::find($id);
        $blog->delete();

        return redirect()->route('blogs.index');
    }
}
