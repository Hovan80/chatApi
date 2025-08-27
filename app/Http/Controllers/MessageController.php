<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Attachment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use function Pest\Laravel\delete;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::orderBy("created_at","desc")->with('sender', 'attachments')->get();
        return response()->json(['data' => $messages]);
    }

    public function list($chatId){
        $messages = Message::where('chat_id', $chatId)->orderBy('created_at','desc')->with('sender', 'attachments')->get();
        return response()->json(['data'=> $messages]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'chat_id' => [
                'required|exists:chats,id',
                Rule::exists('chat_members','chat_id')
                    ->where('user_id', $request->input('user_id'))
                    ->whereNull('deleted_at'),
            ],
            'body' => 'required_without:attachments|string',
            'attachments' => 'nullable|array',
            'attachments.*' => 'string',
        ]);
        if ($validator->fails()) {
            return response()->json(['data'=> $validator->errors()],422);
        }

        $message = Message::create($request->only([
            'user_id', 'chat_id', 'body',
        ]));

        $attachments = $request->input('attachments');
        if (!empty($attachment)){
            foreach ($attachments as $attachment){
                $message->attachments()->create([
                    'guid' => $attachment,
                ]);
            }
        }

        $message->load(['sender', 'attachments']);
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
                    ->where('deleted_at', false),
            ],
            'body'=> 'string',
            'attachments' => 'nullable|array',
            'attachments.*' => 'string',
            'delete_attachments' => 'nullable|array',
            'delete_attachments.*' => 'integer|exists:attachments,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['data'=> $validator->errors()],422);
        }

        $message->update($request->only(['body',]));

        $deleteAttachments = $request->input('delete_attachments');
        if(!empty($deleteAttachments)){
            foreach($deleteAttachments as $attachmentId){
                $attachment = $message->attachmnets()->find($attachmentId);
                if($attachment) $attachment->delete();
            }
        }

        $attachments = $request->input('attachments');
        if(!empty($attachments)){
            foreach($attachments as $attachment){
                $message->attachmnets()->create([
                    'guid' => $attachment
                ]);
            }
        }

        $message->load(['sender', 'attachments']);
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
        $message->delete();
        return response()->json(['message' => 'Message delete successfully']);
    }
}
