<?php

namespace App\Services;

use App\Models\Summary;
use App\Repositories\CryptoSummaryRepository;

class SummaryService
{
    private CryptoSummaryRepository $cryptoSummaryRepository;

    public function __construct(CryptoSummaryRepository $cryptoSummaryRepository)
    {
        $this->cryptoSummaryRepository = $cryptoSummaryRepository;
    }

    public function execute(AvailableMoneyService $availableMoneyService): Summary
    {
        return $this->cryptoSummaryRepository->getSummaryData($availableMoneyService);
    }
}
