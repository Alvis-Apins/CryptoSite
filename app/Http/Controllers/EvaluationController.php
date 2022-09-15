<?php

namespace App\Http\Controllers;

use App\Services\EvaluationService;
use Illuminate\View\View;

class EvaluationController extends Controller
{
    public function index(EvaluationService $evaluationService): View
    {
        $evaluation = $evaluationService->execute();

        return view('evaluation', [
            'daily_best' => $evaluation['dailyBest'],
            'weekly_best' => $evaluation['weeklyBest'],
            'monthly_best' => $evaluation['monthlyBest'],
            'trimester_best' => $evaluation['seasonalBest'],
            'daily_worst' => $evaluation['dailyWorst'],
            'weekly_worst' => $evaluation['weeklyWorst'],
            'monthly_worst' => $evaluation['monthlyWorst'],
            'trimester_worst' => $evaluation['seasonalWorst']
        ]);
    }
}

