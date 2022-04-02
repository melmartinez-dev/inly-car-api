<?php

declare(strict_types=1);

namespace Src\Calculator\Domain\Entities;

use Src\Calculator\Domain\ValueObjects\CarValue;
use Src\Calculator\Domain\ValueObjects\PolicyInstallments;
use Src\Calculator\Domain\ValueObjects\TaxPercentage;
use Src\Calculator\Domain\ValueObjects\UserTime;

class CalculatorEntity
{
    /**
     * @var CarValue
     */
    private CarValue $carValue;
    /**
     * @var TaxPercentage
     */
    private TaxPercentage $taxPercentage;
    /**
     * @var PolicyInstallments
     */
    private PolicyInstallments $policyInstallments;
    /**
     * @var UserTime
     */
    private UserTime $userTime;

    /**
     * @param CarValue $carValue
     * @param TaxPercentage $taxPercentage
     * @param PolicyInstallments $policyInstallments
     * @param UserTime $userTime
     */
    public function __construct(CarValue $carValue, TaxPercentage $taxPercentage, PolicyInstallments $policyInstallments, UserTime $userTime)
    {
        $this->carValue = $carValue;
        $this->taxPercentage = $taxPercentage;
        $this->policyInstallments = $policyInstallments;
        $this->userTime = $userTime;
    }

    public function calculatePayments(): array
    {
        $basePrice = $this->carValue->getCarValue() * ($this->determineIfFridayPolicy() ? 0.13 : 0.11);
        $commission = $basePrice * 0.17;
        $tax = $basePrice * ($this->taxPercentage->getTaxPercentage() / 100);
        $total = $basePrice + $commission + $tax;
        $policy = new PaymentEntity($basePrice, $commission, $tax, $total);
        $installments = [];
        $policyInstallments = $this->policyInstallments->getPolicyInstallments();
        if ($policyInstallments > 1) {
            $installment = new PaymentEntity($basePrice / $policyInstallments, $commission / $policyInstallments, $tax / $policyInstallments, $total / $policyInstallments);
            $installments = array_merge($installments, array_fill(0, $policyInstallments, $installment));
        }
        return compact(["policy", "installments"]);
    }

    private function determineIfFridayPolicy(): bool
    {
        list($dayOfWeek, $hour) = explode(" ", $this->userTime->getUserTime()->format("l G"));
        return $dayOfWeek === "Friday" && (int)$hour >= 15 && (int)$hour < 20;
    }
}
