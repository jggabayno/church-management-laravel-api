<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'remarks', 'amount'
    ];

    public function withDateFilter($request)
    {

        $hasDateToFilter = $request->start_date != '';
        
        $userWithDateFilter = $hasDateToFilter
            ? Expense::whereBetween('created_at', [$request->start_date, $request->end_date])->whereNull('deleted_at')
            : Expense::whereNull('deleted_at');
        
            return $userWithDateFilter;
    }

    // Relationships

}
