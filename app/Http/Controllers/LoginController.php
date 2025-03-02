<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Models\ActivityLog;

class LoginController extends Controller
{

    public function index(LoginRequest $request)
    {
    
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid login credentials'], 401);
        } else {

            ActivityLog::create([
                'author_id' => auth()->user()->id,
                'module' => 'User',
                'description' => 'Login on the portal'
            ]);

            return response()->json([ 'user' =>
                auth()->user()
                ->where('email', $request->email)->with(['user_type'])
                ->select(['id','first_name', 'last_name', 'user_type_id'])
                ->first(),
                'token' => auth()->user()->createToken('authToken')->accessToken]);

        }

    }
}
