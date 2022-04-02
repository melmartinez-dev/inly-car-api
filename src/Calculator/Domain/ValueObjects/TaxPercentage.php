<?php

declare(strict_types=1);

namespace Src\Calculator\Domain\ValueObjects;

use Src\Calculator\Domain\Exceptions\IncorrectTaxPercentage;

class TaxPercentage
{
    /**
     * @var float
     */
    private float $taxPercentage;

    public function __construct(?float $taxPercentage)
    {
        $this->setTaxPercentage($taxPercentage);
    }

    /**
     * @return float
     */
    public function getTaxPercentage(): float
    {
        return $this->taxPercentage;
    }

    /**
     * @param float|null $taxPercentage
     */
    private function setTaxPercentage(?float $taxPercentage): void
    {
        if (!is_null($taxPercentage) && $taxPercentage > 0 && $taxPercentage <= 100) {
            $this->taxPercentage = $taxPercentage;
        } else {
            throw new IncorrectTaxPercentage("[taxPercentage] supplied must be a valid value between 0 and 100");
        }
    }
}
