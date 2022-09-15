<?php

namespace App\Repositories;

use App\Models\Summary;
use App\Services\AvailableMoneyService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CryptoSummaryRepository
{
    public function getSummaryData(AvailableMoneyService $availableMoneyService): Summary
    {
        $user = Auth::user()->getAuthIdentifier();
        $toInvest = $availableMoneyService->execute();

        $invested = DB::table('purchases')
            ->where('user_id', '=', "$user")
            ->sum('buy_value');

        $pastGains = DB::table('sales')
            ->where('user_id', '=', "$user")
            ->sum('money_earned');

        $possibleGains = DB::table('purchases')
            ->where('user_id', '=', "$user")
            ->sum('sell_value');

        $summary = new Summary();
        $summary->money_invested = $invested;
        $summary->money_to_invest = $toInvest->valet;
        $summary->historic_gains= $pastGains;
        $summary->possible_gains = $possibleGains - $invested;

        return $summary;
    }


}
