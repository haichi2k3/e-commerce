<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use Illuminate\Http\Request;
use App\Models\Brands;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brand = Brands::all();
        return view('admin.brand.brand', compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function add()
    {
        return view('admin.brand.add-brand');
    }

     
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function insert(BrandRequest $request)
    {
        $brand = new Brands();
        $brand->name = $request->input('brand');
        $brand->save();

        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $brand = Brands::find($id);
        $brand->delete();

        return redirect()->route('brand.index');
    }

}
