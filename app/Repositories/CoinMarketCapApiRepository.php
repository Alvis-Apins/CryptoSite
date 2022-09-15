<?php

namespace App\Repositories;

use App\Models\CryptoAsset;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class CoinMarketCapApiRepository implements ApiRequest
{
    public function getApiData()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest?CMC_PRO_API_KEY=' . config('services.coinmarketcap.key'));
        $cryptoData = json_decode($response->getBody());


        $count = DB::table('crypto_assets')->count('id');

        if ($count == null) {

            DB::table('crypto_assets')->truncate();

            foreach ($cryptoData->data as $cryptoAsset) {
                $asset = new CryptoAsset();
                $asset->asset_id = $cryptoAsset->id;
                $asset->name = $cryptoAsset->name;
                $asset->symbol = $cryptoAsset->symbol;
                if ($cryptoAsset->max_supply == null){
                    $asset->max_supply = 'unlimited';
                }else{
                    $asset->max_supply = $cryptoAsset->max_supply;
                }
                $asset->price = $cryptoAsset->quote->USD->price;
                $asset->market_cap = $cryptoAsset->quote->USD->market_cap;
                $asset->percent_change_day = $cryptoAsset->quote->USD->percent_change_24h;
                $asset->percent_change_week = $cryptoAsset->quote->USD->percent_change_7d;
                $asset->percent_change_month = $cryptoAsset->quote->USD->percent_change_30d;
                $asset->percent_change_trimester = $cryptoAsset->quote->USD->percent_change_90d;
                $asset->save();
            }
        }else{
            foreach ($cryptoData->data as $cryptoAsset){
                DB::table('crypto_assets')
                    ->where('asset_id','=',"$cryptoAsset->id")
                    ->update([
                        'price' => $cryptoAsset->quote->USD->price,
                        'market_cap' => $cryptoAsset->quote->USD->market_cap,
                        'percent_change_day' => $cryptoAsset->quote->USD->percent_change_24h,
                        'percent_change_week' => $cryptoAsset->quote->USD->percent_change_7d,
                        'percent_change_month' => $cryptoAsset->quote->USD->percent_change_30d,
                        'percent_change_trimester' => $cryptoAsset->quote->USD->percent_change_90d
                    ]);
            }
        }
    }
}
