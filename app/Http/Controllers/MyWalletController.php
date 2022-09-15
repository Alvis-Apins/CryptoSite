<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Repositories\CoinMarketCapApiRepository;
use App\Services\AvailableMoneyService;
use App\Services\SummaryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyWalletController extends Controller
{
    public function index(SummaryService $summaryService, AvailableMoneyService $availableMoneyService): View
    {
        $update = new Purchase();
        $update->updatePurchases();

        $ownedAssets = DB::table('purchases')
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->paginate(5);

        $soldAssets = DB::table('sales')
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->orderBy('sold_at', 'desc')
            ->take(10)
            ->get();

        $summary = $summaryService->execute($availableMoneyService)->toArray();

        return view('my-wallet', [
            'assets' => $ownedAssets,
            'sold_assets' => $soldAssets,
            'summary' => $summary
        ]);
    }

    public function store(Request $request): RedirectResponse
    {

        $user = Auth::user()->getAuthIdentifier();
        $asset = $request->get('asset');
        $amount = DB::table('purchases')
            ->select('amount')
            ->where('user_id', '=', "$user")
            ->where('asset', '=', "$asset")
            ->first();

        $this->validate($request, [
            'asset' => ['string'],
            'value' => ['required', 'numeric', "max:$amount->amount", "min:0"]
        ]);

        $assetToSell = $request->get('asset');
        $amountToSell = $request->get('value');

        $purchase = new Purchase();
        if ($assetToSell == null && $amountToSell == null) {
            $purchase->sellAll();
        } else {
            $purchase->sellOne($assetToSell, $amountToSell);
        }

        return redirect('/my-wallet');
    }
}
