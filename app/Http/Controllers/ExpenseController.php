<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\ActivityLog;

class ExpenseController extends Controller
{
    
    public function index()
    {
        return Expense::whereNull('deleted_at')->latest()->get();
    }

    public function store(Request $request)
    {

        $query = Expense::create([
            'name' => $request->name,
            'remarks' => $request->remarks,
            'amount' => $request->amount,
            // 'added_by' => auth()->user()->id
        ]);

        ActivityLog::create([
            'author_id' => auth()->user()->id,
            'module' => 'Expenses',
            'description' => 'Create '. $query->name
        ]);

        if ($query) return response()->json($query);
    }

 
        public function update(Expense $expense, Request $request)
        {
    
            $selectedExpense = Expense::where('id', $expense->id);
    
            $selectedExpense->update([
                'name' => $request->name,
                'remarks' => $request->remarks,
                'amount' => $request->amount,
                // 'added_by' => auth()->user()->id
            ]);

            ActivityLog::create([
                'author_id' => auth()->user()->id,
                'module' => 'Expenses',
                'description' => 'Update '. $request->name
            ]);
    
            if ($selectedExpense) return response()->json($selectedExpense->first());

        }

        public function destroy(Expense $expense)
        {
            if (Expense::findOrFail($expense->id)) {
                $expense->delete();
              
                if ($expense) {
    
                    ActivityLog::create([
                        'author_id' => auth()->user()->id,
                        'module' => 'Expenses',
                        'description' => 'Delete '. $expense->name
                    ]);
     
                    return response()->json($expense->id,200);
                }
    
            }
        }

}