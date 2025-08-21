<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatGroupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\ChatMemberController;
use App\Http\Controllers\ReadMessageController;
use App\Models\Attachment;
use App\Models\ChatMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResources([
    'users' => UserController::class,
    'chat-groups' => ChatGroupController::class,
    'chats' => ChatController::class,
    'members' => ChatMemberController::class,
    'messages' => MessageController::class,
    'attachments' => AttachmentController::class,
]);

Route::get('members/chat/{chat}', [ChatMemberController::class, 'list'])
    ->name('members.byChat');

// Сообщения: список по chat_id
Route::get('messages/chat/{chat}', [MessageController::class, 'list'])
    ->name('messages.byChat');

// Метки «прочитано»: группируем под префиксом и общим контроллером
Route::prefix('messages/read')
    ->name('messages.read.')
    ->controller(ReadMessageController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');    // все «прочитано»
        Route::get('{message}', 'list')->name('list');      // прочитали конкретное сообщение
        Route::get('{message}/{user}', 'show')->name('show');      // статус одного юзера
        Route::post('/', 'store')->name('store');    // пометить прочитанным
        Route::delete('{message}/{user}', 'destroy')->name('destroy'); // снять метку
    });


