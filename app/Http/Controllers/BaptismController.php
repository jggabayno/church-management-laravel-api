<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Baptism;
use App\Models\User;
use App\Models\ActivityLog;
use App\Models\PaymentDetail;

class BaptismController extends Controller
{

    public function index()
    {
        return Baptism::latest()->with(['person.address', 'pastor.address'])->get();
    }

    public function store(Request $request)
    {

        $baptismNo = 'DOFSB-'.time().$request->person_id;

        $baptism = Baptism::create([
            'baptism_no' => $baptismNo,
            'person_id' => $request->person_id,
            'date_of_baptism' => $request->date_of_baptism,
            'pastor_id' => $request->pastor_id,
            'added_by' => auth()->user()->id
        ]);

        PaymentDetail::create([
            'manage_by' => auth()->user()->id,
            'user_taken_service_id' => $baptism->id,
            'user_taken_service_no' => $baptism->baptism_no,
            'service_fee_id' => $request->service_fee_id,
            'service_fee_detail' => $request->service_fee_detail,
            'amount' => $request->amount
        ]);

        ActivityLog::create([
            'author_id' => auth()->user()->id,
            'module' => 'Baptisms',
            'description' => 'Create baptism '.$baptism->baptism_no
        ]);
        
        $person = $request->user()->where('id',$baptism->person_id);

        $person->update([
            'fathers_maiden_name' => $request->fathers_maiden_name,
            'mothers_maiden_name' => $request->mothers_maiden_name,
        ]);

        if ($baptism) return response()->json($baptism->latest()->with(['person.address','pastor.address'])->first());

    }

  
    public function update(Baptism $baptism, Request $request)
    {
        $selectedBaptism = Baptism::where('id', $baptism->id);
 
        $selectedBaptism->update([
            'baptism_no' => $baptism->baptism_no,
            'person_id' => $baptism->person_id,
            'date_of_baptism' => $request->date_of_baptism,
            'pastor_id' => $request->pastor_id,
            'added_by' => auth()->user()->id
        ]);

        ActivityLog::create([
            'author_id' => auth()->user()->id,
            'module' => 'Baptisms',
            'description' => 'Update baptism '.$baptism->wedding_no
        ]);

        $person = $request->user()->where('id',$baptism->person_id);

        $person->update([
            'fathers_maiden_name' => $request->fathers_maiden_name,
            'mothers_maiden_name' => $request->mothers_maiden_name,
        ]);

        if ($selectedBaptism) return response()->json($selectedBaptism->latest()->with(['person.address','pastor.address'])->first());

    }

}
