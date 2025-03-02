<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'manage_by',
        'service_fee_id',
        'user_taken_service_id',
        'user_taken_service_no',
        'service_fee_detail',
        'amount'
    ];

    public function withDateFilter($request)
    {

        $hasDateToFilter = $request->start_date != '';
        
        $userWithDateFilter = $hasDateToFilter
        ? PaymentDetail::whereBetween('created_at', [$request->start_date, $request->end_date])
        : PaymentDetail::whereNotNull('created_at');

        return $userWithDateFilter;
    }

}
