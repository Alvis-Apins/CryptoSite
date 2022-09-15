<?php

namespace App\Services;

use App\Repositories\EvaluationRepository;
use function Symfony\Component\Translation\t;

class EvaluationService
{
    private EvaluationRepository $evaluationRepository;

    public function __construct(EvaluationRepository $evaluationRepository)
    {
        $this->evaluationRepository = $evaluationRepository;
    }

    public function execute():array{
        return $this->evaluationRepository->getEvaluationData();
    }
}
