<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAccountRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        $user = request()->user();

        return view('perfil', compact('user'));
    }

    public function update(UpdateAccountRequest $request, $id)
    {
        // $this->authorize('editar', User::class);

        $user = User::findOrFail($id);
        $user->fill($request->validated());
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('home');
    }
}
