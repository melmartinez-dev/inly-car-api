<?php

declare(strict_types=1);

namespace App\http\controllers;

use App\http\BaseController;
use Src\Calculator\Application\CalculatePaymentsUseCase;

class CalculatorController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke()
    {
        $input = $this->getJsonData();
        $useCase = new CalculatePaymentsUseCase();
        try {
            $response_data = $useCase->execute($input->carValue, $input->taxPercentage, $input->policyInstallments, $input->userTime);
            $this->respondJson($response_data);
        } catch (\DomainException | \TypeError $e) {
            $this->respondJson(["message" => $e->getMessage()], 400);
        } catch (\Throwable $e) {
            $this->respondJson(["message" => $e->getMessage()]);
        }
    }
}
