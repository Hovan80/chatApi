<?php

namespace App\Http\Controllers;

use App\Models\ChatGroup;
use Illuminate\Http\Request;
class ChatGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ChatGroup::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $group = ChatGroup::create($request->validate(
            [
                'title' => ['required', 'string', 'max:100'],
            ]
        ));
        return $group;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return ChatGroup::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        return $id->update($request->validate(
            [
                'title' => ['required', 'string'],
            ]
        ));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return ChatGroup::destroy($id);
    }
}
