<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ActOfGiving;
use App\Models\ActivityLog;

class ActOfGivingController extends Controller
{
    public function index()
    {
        return ActOfGiving::whereNull('deleted_at')->latest()->get();
    }

    public function store(Request $request)
    { 

        $aog_no = 'DOFAOG-'.time().$request->provider_id;

        $query = ActOfGiving::create([
            'creator_id' => auth()->user()->id,
            'type' => $request->type,
            'provider_id' => $request->provider_id,
            'aog_no' => $aog_no,
            'amount' => $request->amount,
            'remarks' => $request->remarks
         ]);

        ActivityLog::create([
            'author_id' => auth()->user()->id,
            'module' => $request->type === 1 ? 'Offerings' : 'Donations',
            'description' => 'Add '. $query->aog_no. ' with amount of '. $query->amount
        ]);
 
         if ($query) return response()->json($query);

    }

    public function update(ActOfGiving $act_of_giving,Request $request)
    { 
        $selectedActOfGiving = ActOfGiving::where('id', $act_of_giving->id);

        $selectedActOfGiving->update([
            'provider_id' => $request->provider_id,
            'amount' => $request->amount,
            'remarks' => $request->remarks
         ]);

         ActivityLog::create([
            'author_id' => auth()->user()->id,
            'module' => $request->type === 1 ? 'Offerings' : 'Donations',
            'description' => 'Update '. $selectedActOfGiving->aog_no. ' with amount of '. $selectedActOfGiving->amount
        ]);
 
         if ($selectedActOfGiving) return response()->json($selectedActOfGiving->first());

    }

    public function destroy(ActOfGiving $act_of_giving)
    {
        $selectedActOfGiving = ActOfGiving::where('id', $act_of_giving->id);

        if ($selectedActOfGiving) {

            ActivityLog::create([
                'author_id' => auth()->user()->id,
                'module' => $act_of_giving->type === 1 ? 'Offerings' : 'Donations',
                'description' => 'Delete '. $act_of_giving->aog_no
            ]);

            $selectedActOfGiving->delete();
            return response()->json($act_of_giving->id,200);
        }
    }

}
