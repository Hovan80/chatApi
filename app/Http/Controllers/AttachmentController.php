<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Chat;
use App\Models\User;

use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attachments = Attachment::all();
        return response()->json(['data' => $attachments]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Attachment $attachment)
    {
        return response()->json(['data' => $attachment]);
    }

    public function list(Chat $chat){
        $attachments = $chat->messages()->attachments()->get();
        return response()->json(['data' => $attachments]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attachment $attachment)
    {
        $attachment->delete();
        return response()->json(['message' => 'Attachment delete successfully']);
    }
}
