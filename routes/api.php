<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatGroupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\ReadMessageController;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/users', UserController::class);

Route::apiResource('/chats_group', ChatGroupController::class);


Route::apiResource('/chats', ChatController::class);


Route::apiResource('/messages', MessageController::class);
Route::get('/chats/{id}/messages', [MessageController::class, 'list']);

Route::controller(ReadMessageController::class)->group(function (){
    Route::get('/messages/{message_id}/read', 'index');
    Route::get('/users/{user_id}/read', 'show');
    Route::post('/messages/{message_id}/read/{user_id}', 'store');
    Route::delete('/messages/{message_id}/read/{user_id}', 'delete');
});

Route::apiResource('/attachments', AttachmentController::class);

