<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('account_edit', compact('user'));
    }

    public function update(UpdateUserRequest $request)
    {
        $validatedData = $request->validated();
        $user = Auth::user();
        $user->update($validatedData);
        return redirect()->route('mypage')->with('success', 'アカウント情報を更新しました');
    }
}
