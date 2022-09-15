<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class EvaluationController extends Controller
{
    public function index(): View
    {
        $dailyBest = DB::table('crypto_assets')
            ->select('asset_id', 'name', 'percent_change_day', 'price')
            ->orderBy('percent_change_day','desc')
            ->take(3)
            ->get();
        $weeklyBest = DB::table('crypto_assets')
            ->select('asset_id', 'name', 'percent_change_week', 'price')
            ->orderBy('percent_change_week','desc')
            ->take(3)
            ->get();
        $monthlyBest = DB::table('crypto_assets')
            ->select('asset_id', 'name', 'percent_change_month', 'price')
            ->orderBy('percent_change_month','desc')
            ->take(3)
            ->get();
        $threeMonthsBest = DB::table('crypto_assets')
            ->select('asset_id', 'name', 'percent_change_trimester', 'price')
            ->orderBy('percent_change_trimester','desc')
            ->take(3)
            ->get();

        $dailyWorst = DB::table('crypto_assets')
            ->select('asset_id', 'name', 'percent_change_day', 'price')
            ->orderBy('percent_change_day',)
            ->take(3)
            ->get();
        $weeklyWorst = DB::table('crypto_assets')
            ->select('asset_id', 'name', 'percent_change_week', 'price')
            ->orderBy('percent_change_week')
            ->take(3)
            ->get();
        $monthlyWorst = DB::table('crypto_assets')
            ->select('asset_id', 'name', 'percent_change_month', 'price')
            ->orderBy('percent_change_month')
            ->take(3)
            ->get();
        $threeMonthsWorst = DB::table('crypto_assets')
            ->select('asset_id', 'name', 'percent_change_trimester', 'price')
            ->orderBy('percent_change_trimester')
            ->take(3)
            ->get();

        return view('evaluation', [
            'daily_best' => $dailyBest,
            'weekly_best' => $weeklyBest,
            'monthly_best' => $monthlyBest,
            'trimester_best' => $threeMonthsBest,
            'daily_worst' => $dailyWorst,
            'weekly_worst' => $weeklyWorst,
            'monthly_worst' => $monthlyWorst,
            'trimester_worst' => $threeMonthsWorst
        ]);
    }
}

