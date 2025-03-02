<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

 

class Activity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'agenda',
        'participants',
        'remarks',
        'date',
        'added_by'
    ];

    public function withDateFilter($request)
    {

        $hasDateToFilter = $request->start_date != '';
        
        $userWithDateFilter = $hasDateToFilter
            ? Activity::whereBetween('created_at', [$request->start_date, $request->end_date])
            : Activity::whereNotNull('created_at');
        return $userWithDateFilter;
    }

    // Relationships

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}