<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create($request->validate(
            [
                'login' => ['required', 'string', 'min:6'],
                'password' => [
                    'required',
                    Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                ],
                'display_name' => ['required', 'string']
            ]
        ));
        return $user->id;
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return User::findOrFail($id); 
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
