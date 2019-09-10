<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function index()
    {
        $user = request()->user();

        return view('password', compact('user'));
    }

    public function update(UpdatePasswordRequest $request, $id)
    {
        // $this->authorize('editar', User::class);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('home');
    }
}
