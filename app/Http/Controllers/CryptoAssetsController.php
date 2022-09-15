<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\User;
use App\Services\AvailableMoneyService;
use App\Services\BuyAssetService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CryptoAssetsController extends Controller
{
    public function index(AvailableMoneyService $availableMoneyService): View
    {
        $money = $availableMoneyService->execute();
        $moneyInValet = $money->valet;

        $crypto_data = DB::table('crypto_assets')->paginate(10);

        return view('crypto-assets', [
            'assets' => $crypto_data,
            'available_money' => $moneyInValet
        ]);
    }

    public function store(Request $request, BuyAssetService $buyAssetService, AvailableMoneyService $availableMoneyService): RedirectResponse
    {
        $money = $availableMoneyService->execute();
        $moneyInValet = $money->valet;

        $this->validate($request, [
            'asset' => ['string'],
            'value' => ['required', 'numeric', "max:$moneyInValet"]
        ]);

        $moneyLeft = $moneyInValet - $request->get('value');
        $wallet = new User();
        $wallet->updateWallet($moneyLeft, 'subtract');

        $buyingInfo = $buyAssetService->execute($request->get('asset'));
        $purchase = new Purchase();
        $purchase->buy(
            $request->get('asset'),
            $buyingInfo['asset_id'],
            $request->get('value'),
            $buyingInfo['price']);

        return redirect('/my-wallet');
    }
}
