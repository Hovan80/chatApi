<?php

namespace App\Http\Controllers;

use App\Models\ChatGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ChatGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $group = ChatGroup::orderBy("id","desc")->get();
        return response()->json(['data' => $group]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string','max:100'],
        ]);
        if ($validator->fails()) {
            return response()->json(['data'=> $validator->errors()],422);
        }
        $group = ChatGroup::create($request->all());
        return response()->json([
            'data'=> $group,
            'meessage' => 'Chats group created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ChatGroup $group)
    {
        return response()->json(['data' => $group]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChatGroup $group)
    {
        $validator = Validator::make($request->all(), [
            'title'=> ['string','max:100'],
        ]);
        if ($validator->fails()) {
            return response()->json(['data'=> $validator->errors()],422);
        }
        $group->update($request->all());
        return response()->json(['data'=> $group]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChatGroup $group)
    {
        $group->update(['is_deleted' => true]);
        return response()->json(['message' => 'Chats group deleted successfully']);
    }
}
