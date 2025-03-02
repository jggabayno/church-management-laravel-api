<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baptism extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'date_of_baptism',
        'baptism_no',
        'pastor_id',
        'added_by'
    ];

    public function withDateFilter($request)
    {

        $hasDateToFilter = $request->start_date != '';
        
        $userWithDateFilter = $hasDateToFilter
            ? Baptism::whereBetween('created_at', [$request->start_date, $request->end_date])
            : Baptism::whereNotNull('created_at');
        return $userWithDateFilter;
    }

    // Relationships

    public function person()
    {
        return $this->belongsTo(User::class, 'person_id');
    }

    public function pastor()
    {
        return $this->belongsTo(User::class, 'pastor_id');
    }
}
