<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\ActOfGiving;
use App\Models\Wedding;
use App\Models\Baptism;
use App\Models\PaymentDetail;
use App\Models\Expense;

class DashboardController extends Controller
{

    public function index(Request $request)
    {

        // AGE BRACKET
        $ageBracket19Below = User::withDateFilter($request)->where([['age','<=', 19]]);
        $ageBracket20To29 = User::withDateFilter($request)->where([
            ['age','>=', 20],
            ['age','<=', 29]
        ]);
        $ageBracket30YearsAbove = User::withDateFilter($request)->where([['age','>=', 30]]);

        $ageBrackets = [
            [
                'bracket' => 1,
                'total' => $ageBracket19Below->get()->count(),
            ],
            [
                'bracket' => 2,
                'total' => $ageBracket20To29->get()->count(),
            ],
            [
                'bracket' => 3,
                'total' => $ageBracket19Below->get()->count(),
            ]
        ];

        // OFFERINGS
        $offerings = ActOfGiving::withDateFilter($request)->where([['type', '=', 1]])->select(['id','amount'])->get();
        $totalOfferings = 0;

        foreach ($offerings as $offering) {
            $totalOfferings += $offering->amount;
        }

        // DONATIONS
        $donations = ActOfGiving::withDateFilter($request)->where([['type', '=', 2]])->select(['id','amount'])->get();
        $totalDonations = 0;

        foreach ($donations as $donation) {
            $totalDonations += $donation->amount;
        }

        // PAYMENTS
        $paymentDetail = PaymentDetail::withDateFilter($request)->select(['id','amount'])->get();

        $totalPaymentAmount = 0;

        foreach ($paymentDetail as $detail) {
            $totalPaymentAmount += $detail->amount;
        }


        // MEMBERS BY POSITIONS
        $member = User::withDateFilter($request)->where('position_id', 1);
        $worker = User::withDateFilter($request)->where('position_id', 2);
        $leader = User::withDateFilter($request)->where('position_id', 3);
        $pastor = User::withDateFilter($request)->where('position_id', 4);

        $member_positions = [
            [
                'name' => 'Member',
                'count' => $member->get()->count(),
            ],
            [
                'name' => 'Worker',
                'count' => $worker->get()->count(),
            ],
            [
                'name' => 'Leader',
                'count' => $leader->get()->count(),
            ],
            [
                'name' => 'Pastor',
                'count' => $pastor->get()->count(),
            ],
        ];

        $expenses = Expense::withDateFilter($request)->get();

        $totalExpenses = 0;

        foreach ($expenses as $expense) {
            $totalExpenses += $expense->amount;
        }

        $statistics = [
            'members' => User::withDateFilter($request)->get()->count(),
            'weddings' => Wedding::withDateFilter($request)->latest()->get()->count(),
            'baptisms' => Baptism::withDateFilter($request)->latest()->get()->count(),
            'offerings' => $totalOfferings,
            'donations' => $totalDonations,
            'age_brackets' => $ageBrackets,
            'payment_amount' => $totalPaymentAmount,
            'member_positions' => $member_positions,
            'expenses' => $totalExpenses
         ];

        return response()->json($statistics);

    }

}
