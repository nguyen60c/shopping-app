<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

        /*Assign role and permissions*/
        $user->assignRole("user");
        return redirect("/")->with("success", "Account successfully registered");
    }
}
