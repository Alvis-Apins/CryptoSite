<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Purchase extends Model
{
    use HasFactory;

    public function sellOne(string $asset, string $amount):void
    {

        $asset = DB::table('purchases')
            ->where('asset', '=', "$asset")
            ->first();


        $user = Auth::user()->getAuthIdentifier();

        $price = DB::table('crypto_assets')
            ->select('price')
            ->where('name', '=', "$asset->asset")
            ->first();

        if ($asset->amount == (float)$amount) {
            $sale = new Sale();
            $sale->crypto_id = $asset->crypto_id;
            $sale->user_id = $user;
            $sale->asset = $asset->asset;
            $sale->amount = $asset->amount;
            $sale->sell_value = $price->price * $amount;
            $sale->money_earned = ($price->price * $amount) - $asset->buy_value;
            $sale->sold_at = now();
            $sale->save();

            DB::table('purchases')
                ->where('asset', '=', "$asset->asset")
                ->where('user_id', '=', "$user")
                ->delete();

            $wallet = new User();
            $wallet->updateWallet(($price->price * $amount), 'add');
        } else {
            $amountLeft = $asset->amount - $amount;

            DB::table('purchases')
                ->where('asset', '=', "$asset->asset")
                ->where('user_id', '=', "$user")
                ->update([
                    'amount' => $amountLeft
                ]);

            $sale = new Sale();
            $sale->crypto_id = $asset->crypto_id;
            $sale->user_id = $user;
            $sale->asset = $asset->asset;
            $sale->amount = $amount;
            $sale->sell_value = $price->price * $amount;
            $sale->money_earned = ($price->price * $amount) - $asset->buy_value;
            $sale->sold_at = now();
            $sale->save();
        }
    }

    public function sellAll():void
    {
        $assetsToSell = Purchase::all()->toArray();

        foreach ($assetsToSell as $asset) {
            $cryptoAsset = $asset['asset'];
            $price = DB::table('crypto_assets')
                ->select('price')
                ->where('name', '=', "$cryptoAsset")
                ->first();

            $sale = new Sale();
            $sale->crypto_id = $asset['crypto_id'];
            $sale->user_id = $asset['user_id'];
            $sale->asset = $asset['asset'];
            $sale->amount = $asset['amount'];
            $sale->sell_value = $price->price * $asset['amount'];
            $sale->money_earned = ($price->price * $asset['amount']) - $asset['buy_value'];
            $sale->sold_at = now();
            $sale->save();
        }

        $user = $asset['user_id'];
        DB::table('purchases')
            ->where('user_id', '=', "$user")
            ->delete();
    }

    public function buy($asset, $assetId, $value, $price):void
    {
        $user = Auth::user()->getAuthIdentifier();
        $assetExists = DB::table('purchases')
            ->where('asset', '=', "$asset")
            ->where('user_id', '=', "$user")
            ->first();

        if ($assetExists === null) {
            $purchase = new Purchase();
            $purchase->crypto_id = $assetId;
            $purchase->user_id = Auth::user()->getAuthIdentifier();
            $purchase->asset = $asset;
            $purchase->amount = calculateCryptoAmount($value, $price);
            $purchase->buy_value = $value;
            $purchase->buying_price = $price;
            $purchase->sell_value = $price;
            $purchase->save();
        } else {
            $id = $assetExists->id;
            DB::table('purchases')
                ->where('id', '=', "$id")
                ->update([
                    'amount' => $assetExists->amount + calculateCryptoAmount($value, $price),
                    'buy_value' => $assetExists->buy_value + $value
                ]);
        }
    }

    public function updatePurchases():void
    {
        $assetsToUpdate = Purchase::all()->toArray();

        foreach ($assetsToUpdate as $asset) {
            $cryptoAsset = $asset['asset'];
            $price = DB::table('crypto_assets')
                ->select('price')
                ->where('name', '=', "$cryptoAsset")
                ->first();

            $id = $asset['id'];
            DB::table('purchases')
                ->where('id', '=', "$id")
                ->update([
                    'sell_value' => $asset['amount'] * $price->price
                ]);
        }
    }
}
