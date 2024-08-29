<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddCountryRequest;
use App\Models\User;
use App\Models\Country;


class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $country = Country::all();
        return view('admin.country.country', compact('country'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        return view('admin.country.add-country');
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
    public function insert(AddCountryRequest $request)
    {
        $country = new Country();
        $country->name = $request->input('country');
        $country->save();

        return redirect()->route('country.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $country = Country::find($id);
        $country->delete();

        return redirect()->route('country.index');
    }
}
