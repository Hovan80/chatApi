<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return System::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $system = System::create($request->all());
        return $system->id;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return System::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $system = System::findOrFail($id);
        $system->update($request->all());
        return $system->id;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return System::destroy($id);
    }
}
