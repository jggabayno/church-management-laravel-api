<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(RegisterRequest $request)
    {

       $query = User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'mobile_number' => $request->mobile_number,
        'address' => $request->address,
        'user_type_id' => $request->user_type_id,
        'email' => $request->email,
        'password' => Hash::make($request->password),
     ]);


        if ($query) return response()->json($query);
    }
}
