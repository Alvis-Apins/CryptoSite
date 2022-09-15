<?php

namespace App\Services;

use App\Repositories\DealsHandlingRepository;

class BuyAssetService
{
    private DealsHandlingRepository $dealsHandlingRepository;

    public function __construct(DealsHandlingRepository $dealsHandlingRepository)
    {
        $this->dealsHandlingRepository = $dealsHandlingRepository;
    }

    public function execute(string $asset): array
    {
        return $this->dealsHandlingRepository->assetBuyingInfo($asset);
    }
}
