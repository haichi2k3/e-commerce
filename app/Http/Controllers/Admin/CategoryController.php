<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Models\Categories;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Categories::all();
        return view ('admin.category.category', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        return view ('admin.category.add-category');

    }

    
    public function insert(CategoryRequest $request)
    {
        $category = new Categories();
        $category->name = $request->input('category');
        $category->save();

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $category = Categories::find($id);
        $category->delete();

        return redirect()->route('category.index');
    }
}