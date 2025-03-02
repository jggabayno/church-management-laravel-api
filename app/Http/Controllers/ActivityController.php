<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Activity;
use App\Models\ActivityLog;


class ActivityController extends Controller
{
    public function index()
    {
        return Activity::whereNull('deleted_at')->latest()->get();
    }

    public function store(Request $request)
    { 

        $query = Activity::create([
            'agenda' => $request->agenda,
            'participants' => $request->participants,
            'remarks' => $request->remarks,
            'date' => $request->date,
            'added_by' => auth()->user()->id,
         ]);

        ActivityLog::create([
            'author_id' => auth()->user()->id,
            'module' => 'Church Activities',
            'description' => 'Add '. $query->agenda
        ]);
 
         if ($query) return response()->json($query);

    }

    public function update(Activity $activity, Request $request)
    { 
        $selectedActivity = Activity::where('id', $activity->id);

        $selectedActivity->update([
            'agenda' => $request->agenda,
            'remarks' => $request->remarks,
            'participants' => $request->participants,
            'date' => $request->date
         ]);

         ActivityLog::create([
            'author_id' => auth()->user()->id,
            'module' => 'Church Activities',
            'description' => 'Update '. $request->agenda
        ]);
 
         if ($selectedActivity) return response()->json($selectedActivity->first());

    }

    public function destroy(Activity $activity)
    {

        return $activity;

        $selectedActivity = Activity::where('id', $activity->id);

        if ($selectedActivity) {

            ActivityLog::create([
                'author_id' => auth()->user()->id,
                'module' => 'Church Activities',
                'description' => 'Delete '. $selectedActivity->agenda
            ]);

            $selectedActivity->delete();
            return response()->json($selectedActivity->id,200);
        }
    }

}
