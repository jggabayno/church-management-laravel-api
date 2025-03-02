<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentDetail;
use App\Models\Wedding;
use App\Models\Baptism;

class PaymentDetailController extends Controller
{
    public function index()
    {
        return PaymentDetail::latest()->get();
    }

}
