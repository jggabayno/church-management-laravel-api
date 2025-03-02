<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class ActOfGiving extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'creator_id',
        'type',
        'provider_id',
        'aog_no',
        'amount',
        'remarks'
    ];

    public function withDateFilter($request)
    {

        $hasDateToFilter = $request->start_date != '';
        
        $userWithDateFilter = $hasDateToFilter
        ? ActOfGiving::whereBetween('created_at', [$request->start_date, $request->end_date])->whereNull('deleted_at')
        : ActOfGiving::whereNull('deleted_at');

        return $userWithDateFilter;
    }

}
