<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserPosition;

class UserPositionController extends Controller
{
    
    public function index()
    {
        return UserPosition::latest()->get();
    }

    // public function store(Request $request)
    // {
    //     $query = UserPosition::create($request->validated());

    //     if ($query) return response()->json($query);
    // }

    // public function update(UserPosition $position, Request $request)
    // {
    //     $query = $position->update($request->only('name', 'description'));
    //     return response()->json($query, 200);
    // }

}
