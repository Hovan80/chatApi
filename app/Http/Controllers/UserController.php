<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json(['datra' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login'=> [
                'required',
                'string',
                'min:6',
                'unique:users,login',
            ],
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'display_name' => ['required', 'string', 'max:60']
        ]);
        if ($validator->fails()) {
            return response()->json(['data'=> $validator->errors()],422);
        }
        $user = User::create($request->all());

        return response()->json(['data' => $user]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json(['data' => $user]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->validate(
            [
                'display_name' => ['required', 'string'],
            ]
        ));
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return User::destroy($id);
    }
}
