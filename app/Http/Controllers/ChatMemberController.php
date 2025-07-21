<?php

namespace App\Http\Controllers;

use App\Models\ChatMember;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ChatMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($chatId)
    {
        $members = ChatMember::where('chat_id', $chatId)->get();
        return response()->json(['data' => $members]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'chat_id' => ['required', 'exists:chats,id'],
            'user_id' => ['required', 'exists:users,id'],
            'joined_at' => ['nullable', 'date'],
            'left_at' => ['nullable', 'date', 'after:joined_at'],
            'is_admin' => ['boolean'],
        ]);
        if ($validator->fails()) {
            return response()->json(['data'=> $validator->errors()],422);
        }
        $member = ChatMember::create($request->all());
        return response()->json([
            'data'=> $member,
            'message' => 'Member created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ChatMember $member)
    {
        return response()->json(['data'=> $member]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChatMember $member)
    {
        $validator = Validator::make($request->all(),[
            'chat_id' => 'exists:chats,id',
            'user_id' => 'exists:users,id',
            'joined_at' => ['nullable', 'date'],
            'left_at'=> ['nullable', 'date', 'after:joined_at'],
            'is_admin' => 'boolean',
        ]);
        if ($validator->fails()) {
            return response()->json(['data'=> $validator->errors()],422);
        }

        $member->update($request->all());

        return response()->json([
            'data'=> $member,
            'message'=> 'Member updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChatMember $member)
    {
        $member->delete();
        return response()->json(['message' => 'Member deleted successfully']);
    }
}
