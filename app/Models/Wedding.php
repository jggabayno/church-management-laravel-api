<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{
    use HasFactory;

    protected $fillable = [
        'bride_id',
        'groom_id',
        'wedding_no',
        'date_of_seminar',
        'date_schedule_of_marriage',
        'pastor_id',
        'location',
        'added_by'
    ];

    public function withDateFilter($request)
    {

        $hasDateToFilter = $request->start_date != '';
        
        $userWithDateFilter = $hasDateToFilter
            ? Wedding::whereBetween('created_at', [$request->start_date, $request->end_date])
            : Wedding::whereNotNull('created_at');
        return $userWithDateFilter;
    }

    // Relationships

    public function bride()
    {
        return $this->belongsTo(User::class, 'bride_id');
    }

    public function groom()
    {
        return $this->belongsTo(User::class, 'groom_id');
    }

    public function pastor()
    {
        return $this->belongsTo(User::class, 'pastor_id');
    }
}
