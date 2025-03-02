<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Wedding;
use App\Models\User;
use App\Models\ActivityLog;
use App\Models\PaymentDetail;

class WeddingController extends Controller
{

    public function index()
    {
        return Wedding::latest()->with(['bride.address','groom.address','pastor.address'])->get();
    }

    public function store(Request $request)
    {

        $weddingNo = 'DOFSW-'.$request->bride_id.time().$request->groom_id;

        $wedding = Wedding::create([
            'wedding_no' => $weddingNo,
            'bride_id' => $request->bride_id,
            'groom_id' => $request->groom_id,
            'location' => $request->location,
            'date_of_seminar' => $request->date_of_seminar,
            'date_schedule_of_marriage' => $request->date_schedule_of_marriage,
            'pastor_id' => $request->pastor_id,
            'added_by' => auth()->user()->id
        ]);

        $paymentDetail = PaymentDetail::create([
            'manage_by' => auth()->user()->id,
            'user_taken_service_id' => $wedding->id,
            'user_taken_service_no' => $wedding->wedding_no,
            'service_fee_id' => $request->service_fee_id,
            'service_fee_detail' => $request->service_fee_detail,
            'amount' => $request->amount
        ]);

        ActivityLog::create([
            'author_id' => auth()->user()->id,
            'module' => 'Weddings',
            'description' => 'Create wedding'.$wedding->wedding_no
        ]);

        $bride = $request->user()->where('id',$wedding->bride_id);

        $bride->update([
            'fathers_maiden_name' => $request->bride_fathers_maiden_name,
            'mothers_maiden_name' => $request->bride_mothers_maiden_name,
            'occupation' => $request->bride_occupation
        ]);

        $groom = $request->user()->where('id',$wedding->groom_id);
        
        $groom->update([
            'fathers_maiden_name' => $request->groom_fathers_maiden_name,
            'mothers_maiden_name' => $request->groom_mothers_maiden_name,
            'occupation' => $request->groom_occupation
         ]);

        if ($wedding) return response()->json($wedding->latest()->with(['bride.address','groom.address','pastor.address'])->first());

    }

    public function update(Wedding $wedding, Request $request)
    {
        $selectedWedding = Wedding::where('id', $wedding->id);
 
        $selectedWedding->update([
            'wedding_no' => $wedding->wedding_no,
            'bride_id' => $wedding->bride_id,
            'groom_id' => $wedding->groom_id,
            'location' => $request->location,
            'date_of_seminar' => $request->date_of_seminar,
            'date_schedule_of_marriage' => $request->date_schedule_of_marriage,
            'pastor_id' => $request->pastor_id,
            'added_by' => auth()->user()->id
        ]);

        ActivityLog::create([
            'author_id' => auth()->user()->id,
            'module' => 'Weddings',
            'description' => 'Update wedding '.$wedding->wedding_no
        ]);

        $bride = $request->user()->where('id',$wedding->bride_id);

        $bride->update([
            'fathers_maiden_name' => $request->bride_fathers_maiden_name,
            'mothers_maiden_name' => $request->bride_mothers_maiden_name,
            'occupation' => $request->bride_occupation
        ]);

        $groom = $request->user()->where('id',$wedding->groom_id);
        
        $groom->update([
            'fathers_maiden_name' => $request->groom_fathers_maiden_name,
            'mothers_maiden_name' => $request->groom_mothers_maiden_name,
            'occupation' => $request->groom_occupation
        ]);


        if ($selectedWedding) return response()->json($selectedWedding->latest()->with(['bride.address','groom.address','pastor.address'])->first());

    }

}
