<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\ReadMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReadMessageController extends Controller
{
    /**
     * Все прочтения
     */
    public function index()
    {
        $read = ReadMessage::orderBy('created_at','desc')->get();
        return response()->json(['data' => $read]);
    }
    /**
     *Список пользователей, прочитавших сообщение
     */
    public function list(int $messageId){
        $read = ReadMessage::where('message_id', $messageId)->orderBy('created_at','desc')->get();
        return response()->json(['data'=> $read]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message_id'=> ['required','integer', Rule::exists('messages', 'id')->whereNull('deleted_at')],
            'user_id'=> [
                'required',
                'integer',
                'exists:users,id',
                Rule::unique('read_messages','user_id')
                    ->where('message_id', $request->input('message_id')),
            ],
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors()],422);
        }
        $read = ReadMessage::create($request->all());
        return response()->json(['data'=> $read, 'message' => 'The message was read successfully']);
    }

    /**
     * Возвращает само прочтение
     */
    public function show(int $messageId, int $userId)
    {
        $read = ReadMessage::where([
            ['message_id','=', $messageId],
            ['user_id','=', $userId],
        ])->get();
        return response()->json(['data'=> $read]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($messageId, $userId)
    {
        ReadMessage::where( [
            ['message_id','=', $messageId],
            ['user_id','=', $userId],
        ])->delete();
        return response()->json(['message' => 'Message has become unread successfully']);
    }
}
