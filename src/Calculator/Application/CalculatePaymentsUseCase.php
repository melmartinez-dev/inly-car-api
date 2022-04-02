<?php

namespace Src\Calculator\Application;

use Src\Calculator\Domain\ValueObjects\CarValue;
use Src\Calculator\Domain\ValueObjects\PolicyInstallments;
use Src\Calculator\Domain\ValueObjects\TaxPercentage;
use Src\Calculator\Domain\ValueObjects\UserTime;
use Src\Calculator\Domain\Entities\CalculatorEntity;

class CalculatePaymentsUseCase
{
    /**
     * @param int|null $carValue
     * @param int|null $taxPercentage
     * @param int|null $policyInstallments
     * @param string|null $userTime
     * @return array
     */
    public function execute(?int $carValue, ?int $taxPercentage, ?int $policyInstallments, ?string $userTime): array
    {
        $calculator = new CalculatorEntity(new CarValue($carValue), new TaxPercentage($taxPercentage), new PolicyInstallments($policyInstallments), new UserTime($userTime));
        return $calculator->calculatePayments();
    }
}
