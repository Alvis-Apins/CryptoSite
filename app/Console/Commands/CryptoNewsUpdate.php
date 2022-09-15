<?php

namespace App\Console\Commands;

use App\Repositories\NewsDataApiRepository;
use Illuminate\Console\Command;

class CryptoNewsUpdate extends Command
{
    protected $signature = 'quote:news_update';
    protected $description = 'Gets latest crypto news and updates database';

    public function handle(NewsDataApiRepository $newsDataApiRepository)
    {
        $newsDataApiRepository->getApiData();

        $this->info('Crypto-News database has been updated');
    }
}
