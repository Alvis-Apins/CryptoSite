<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DealsHandlingRepository
{
    public function getAvailableMoney(): object
    {
        $user = Auth::user()->getAuthIdentifier();
        return DB::table('users')
            ->select('valet')
            ->where('id', '=', "$user")
            ->first();
    }

    public function assetBuyingInfo(string $asset):array
    {
        $purchaseData = DB::table('crypto_assets')
            ->select('asset_id', 'price')
            ->where('crypto_assets.name', '=', "$asset")
            ->first();

        return [
            'price' => $purchaseData->price,
            'asset_id' => $purchaseData->asset_id
        ];
    }

    public function moneyInvestedInfo()
    {
        $ownedAssets = DB::table('purchases')->get();

        echo "<pre>";
        var_dump($ownedAssets);
        die;
    }

}
