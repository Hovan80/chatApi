<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Chat::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Chat::create($request->validate(
            [
                'title' => ['required','string','max:100'],
                'chat_type' => ['required','string', 'in:personal,group'],
                'chat_group_id' => ['required','integer'],
            ]
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Chat::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        return Chat::findOrFail($id)
                    ->update($request->validate([
                        'title'=> ['required','string','max:100'],
                    ]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return Chat::destroy($id);
    }
}
