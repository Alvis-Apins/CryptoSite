<?php

namespace App\Services;

use App\Repositories\DealsHandlingRepository;

class AvailableMoneyService
{
    private DealsHandlingRepository $dealsHandlingRepository;

    public function __construct(DealsHandlingRepository $dealsHandlingRepository)
    {
        $this->dealsHandlingRepository = $dealsHandlingRepository;
    }

    public function execute(): object
    {
        return $this->dealsHandlingRepository->getAvailableMoney();
    }
}
