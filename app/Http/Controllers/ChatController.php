<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chats = Chat::orderBy('created_at', 'desc')->get();
        return response()->json(['data' => $chats]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'title' => ['required', 'string', 'max:100'],
                'chat_type' => ['required', 'string', 'in:personal,group'],
                'chat_group_id' => ['required', 'exists:chat_groups,id'],
        ]);
        if ($validator->fails()){
            return response()->json(['data'=> $validator->errors()],422);
        }
        $chat = Chat::create($request->all());
        return response()->json([
            'data'=> $chat,
            'message' => 'Chat created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        return response()->json(['data' => $chat]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chat $chat)
    {
        $validator = Validator::make($request->all(), [
            'title'=> ['string','max:100'],
        ]);
        if ($validator->fails()){
            return response()->json(['data'=> $validator->errors()],422);
        }
        $chat->update($request->all());
        return response()->json([
            'data'=> $chat,
            'message'=> 'Chat updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat )
    {
        $chat->update([
            'is_deleted' => true,
        ]);
        return response()->json(['message' => 'Chat deleted successfully']);
    }
}
