<?php

namespace App\Http\Controllers;

use App\Models\ReadMessage;
use Illuminate\Http\Request;

class ReadMessageController extends Controller
{
    /**
     * Список пользователей, прочитавших сообщение
     */
    public function index(int $messageId)
    {
        return ReadMessage::where('message_id', $messageId)->orderBy('created_at','desc')->user();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $messageId, int $userId)
    {
        $read = ReadMessage::create(
            [
                'message_id'=> $messageId,
                'user_id'=> $userId,
            ]
        );
        return $read;
    }

    /**
     * Сообщения, прочитанные пользователем
     */
    public function show(int $userId)
    {
        return ReadMessage::where('user_id', $userId)->orderBy('created_at','desc')->message();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($messageId, $userId)
    {
        return ReadMessage::where( [
                ['message_id','=', $messageId],
                ['user_id','=', $userId],
            ])->first()->delete();
    }
}
