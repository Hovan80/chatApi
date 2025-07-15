<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Message::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = Message::create($request->all());
        return $message->id;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Message::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        $message->update($request->all());
        return $message->id;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return Message::destroy($id);
    }
}
