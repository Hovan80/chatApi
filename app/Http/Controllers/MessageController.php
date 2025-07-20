<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::orderBy("created_at","desc")->get();
        return response()->json(['data' => $messages]);
    }

    public function list($chatId){
        $messages = Message::where('chat_id', $chatId)->orderBy('created_at','desc')->get();
        return response()->json(['data'=> $messages]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id'],
            'chat_id' => [
                'required',
                'exists:chats,id',
                Rule::exists('chat_members','chat_id')
                    ->where('user_id', $request->input('user_id'))
                    ->where('is_deleted', false),
            ],
            'body' => ['required', 'string'],
            'is_deleted' => ['boolean'],
        ]);
        if ($validator->fails()) {
            return response()->json(['data'=> $validator->errors()],422);
        }
        $message = Message::create($request->all());
        return response()->json([
            'data'=> $message,
            'message' => 'Message create successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        return response()->json(['data'=> $message]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        $validator = Validator::make($request->all(), [
            'user_id'=> 'exists:users,id',
            'chat_id'=> [
                'exists:chats,id',
                Rule::exists('chat_members','chat_id')
                    ->where('user_id', $request->input('user_id'))
                    ->where('is_deleted', false),
            ],
            'body'=> 'string',
            'is_deleted'=> 'boolean',
        ]);
        if ($validator->fails()) {
            return response()->json(['data'=> $validator->errors()],422);
        }
        return response()->json([
            'data'=> $message,
            'message'=> 'Message update successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $message->update([
            'is_deleted' => true
        ]);
        return response()->json(['message' => 'Message delete successfully']);
    }
}
