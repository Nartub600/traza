<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(CreateUserRequest $request)
    {
        $user = new User($request->validated());
        $user->password = Hash::make($request->password);

        $user->save();

        $user->groups()->attach($request->groups);
        $user->assignRole($request->roles);
    }
}
