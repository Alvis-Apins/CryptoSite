<?php

namespace App\Console\Commands;

use App\Models\Purchase;
use App\Repositories\CoinMarketCapApiRepository;
use Illuminate\Console\Command;

class CryptoAssetsUpdate extends Command
{
    protected $signature = 'quote:assets_update';
    protected $description = 'Gets latest crypto assets and updates database';

    public function handle(CoinMarketCapApiRepository $coinMarketCapApiRepository)
    {
        $coinMarketCapApiRepository->getApiData();
        $this->info('crypto_assets database has been updated');
    }
}
