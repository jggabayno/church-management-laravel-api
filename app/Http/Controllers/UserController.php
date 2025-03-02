<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Models\Address;
use App\Models\ActivityLog;

class UserController extends Controller
{

    public function index()
    {
        return User::whereNull('deleted_at')->with(['address','user'])->latest()->get();
    }

    public function profile()
    {
        return User::where('id', auth()->user()->id)->with(['address'])->first();
    }

    public function store(Request $request)
    { 

        $userQuery = User::create([
            'position_id' => $request->position_id,
            'photo' => $request->photo,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'birth_date' => $request->birth_date,
            'place_of_birth' => $request->place_of_birth,
            'age' => $request->age,
            'gender' => $request->gender,
            'citizenship' => $request->citizenship,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'status' => $request->status,
            'added_by' => auth()->user()->id,
         ]);

         if ($userQuery) {

            $userAddressQuery = Address::create([
                'user_id' => $userQuery->id,
                'house_no' => $request->house_no,
                'street' => $request->street,
                'barangay' => $request->barangay,
                'municipality' => $request->municipality
            ]);

            ActivityLog::create([
                'author_id' => $userQuery->added_by,
                'module' => 'Members',
                'description' => 'Add '.$userQuery->first_name .' '.$userQuery->last_name
             ]);

            return [
                'user' => $userQuery,
                'user_address' => $userAddressQuery
            ];
        }

    }

    public function update(User $user,Request $request)
    {
        $selectedUser = $request->user()->where('id', $user->id);

        $selectedUser->update([
            'position_id' => $request->position_id,
            'photo' => $request->photo,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'birth_date' => $request->birth_date,
            'place_of_birth' => $request->place_of_birth,
            'age' => $request->age,
            'gender' => $request->gender,
            'citizenship' => $request->citizenship,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'status' => $request->status,
            'password' => $request->actionType ? Hash::make($request->password) : $user->password ,
            'user_type_id' => $request->actionType ?  $request->user_type_id : $user->user_type_id,
            'added_by' => auth()->user()->id
        ]);

        if($selectedUser) {

            $userAddressQueryId = Address::where('user_id', $user->id)->updateOrCreate([
                'user_id' => $user->id,
                'house_no' => $request->house_no,
                'street' => $request->street,
                'barangay' => $request->barangay,
                'municipality' => $request->municipality
            ]);
                
            ActivityLog::create([
                'author_id' => auth()->user()->id,
                'module' => !$request->actionType ? 'Members' : 'User Management',
                'description' => $request->actionType  == 'add' ? 'Add '.$user->first_name .' '.$user->last_name. ' account.'
                : 
                $request->actionType  == 'edit' ? ('Update '.$user->first_name .' '.$user->last_name.' account.')
                :
                $request->actionType  == 'delete' ? ('Delete '.$user->first_name .' '.$user->last_name.' account.')
                : 'Update '.$user->first_name .' '.$user->last_name. ' Details' 
 
             ]);
    
            return [
                'user' => $selectedUser->first(),
                'user_address' => Address::where('user_id', $user->id)->first()
            ];
        }
     

    }

    public function destroy(User $user)
    {
        if (auth()->user()->findOrFail($user->id)) {
            $user->delete();
          
            if ($user) {

                ActivityLog::create([
                    'author_id' => auth()->user()->id,
                    'module' => 'Members',
                    'description' => 'Delete '. $user->first_name . $user->first_name
                 ]);

                Address::where('user_id', $user->id)->first()->delete();
                return response()->json($user->id,200);
            }

        }
    }

}
