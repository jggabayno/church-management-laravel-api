<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ServiceFee;
use App\Models\ActivityLog;

class ServiceFeeController extends Controller
{

    public function index()
    {
        return ServiceFee::latest()->get();
    }

    public function store(Request $request)
    { 
       
        $query = ServiceFee::create([
            'name' =>  $request->name,
            'details' => json_encode($request->details),
        ]);

        ActivityLog::create([
            'author_id' => auth()->user()->id,
            'module' => 'Service Fee',
            'description' => 'Create '. $query->name. ' fee'
        ]);
 
         if ($query) return response()->json($query);

    }

    public function update(ServiceFee $service_fee, Request $request)
    { 
        $selectedServiceFee = ServiceFee::where('id', $service_fee->id);

        $selectedServiceFee->update([
            'name' =>  $request->name,
            'details' => json_encode($request->details),
        ]);

        ActivityLog::create([
            'author_id' => auth()->user()->id,
            'module' => 'Service Fee',
            'description' => 'Update '. $request->name. ' fee'
        ]);
 
         if ($selectedServiceFee) return response()->json($selectedServiceFee->first());

    }

}
