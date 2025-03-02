<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function index(User $user, Request $request)
    {

        if ($user->id) {

            $user->update(['password' => Hash::make($request->password)]);

            return response()->json(['message' => 'password successfully changed'], 200);

        } else {

            return response()->json(['message' => 'invalid credentials'], 401);

        }
    }
}
