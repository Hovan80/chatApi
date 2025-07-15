<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatGroupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\AttachmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index');
    Route::get('/users/{id}','show');
    Route::post('/users', 'store');
    Route::put('/users/{id}','update');
    Route::delete('/users/{id}','delete');
});

Route::controller(ChatGroupController::class)->group(function () {
    Route::get('/chats_group', 'index');
    Route::get('/chats_group/{id}', 'show');
    Route::post('/chats_group', 'strore');
    Route::delete('/chats_group/{id}', 'delete');
});


Route::controller(ChatController::class)->group(function () {
    Route::get('/chats', 'index');
    Route::get('/chats/{id}', 'show');
    Route::post('/chats', 'store');
    Route::put('/chats/{id}', 'update');
    Route::delete('/chats/{id}', 'delete');
});

Route::controller(MessageController::class)->group(function () {
    Route::get('/messages','index');
    Route::get('/messages/{id}','show');
    Route::get('/chats/{id}/messages', 'list');
    Route::post('/messages','store');
    Route::put('/messages/{id}','update');
    Route::delete('/messages/{id}', 'delete');
});

Route::controller(SystemController::class)->group(function () {
    Route::get('/systems','index');
    Route::get('/systems/{id}','show');
    Route::post('/systems','store');
    Route::put('/systems/{id}','update');
    Route::delete('/systems/{id}', 'delete');
});

Route::controller(AttachmentController::class)->group(function () {
    Route::get('/attachments','index');
    Route::get('/attacments/{id}','show');
    Route::post('/attachments','store');
    Route::put('/attachments/{id}','update');
    Route::delete('/attachments/{id}', 'delete');
});