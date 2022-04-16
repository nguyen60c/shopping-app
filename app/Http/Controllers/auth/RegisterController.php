<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Display register page
     */
    public function show()
    {
        return view("auth.register");
    }

    /**
     * Handle account registration request
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        auth()->login($user);

        return redirect("/")->with("success", "Account successfully registered");
    }
}
