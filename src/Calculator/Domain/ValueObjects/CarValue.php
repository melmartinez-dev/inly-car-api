<?php

declare(strict_types=1);

namespace Src\Calculator\Domain\ValueObjects;

use Src\Calculator\Domain\Exceptions\IncorrectCarValue;

class CarValue
{
    /**
     * @var float
     */
    private float $carValue;

    public function __construct(?float $carValue)
    {
        $this->setCarValue($carValue);
    }

    /**
     * @return float
     */
    public function getCarValue(): float
    {
        return $this->carValue;
    }

    /**
     * @param float|null $carValue
     */
    private function setCarValue(?float $carValue): void
    {
        if (!is_null($carValue) && $carValue >= 100 && $carValue <= 100000) {
            $this->carValue = $carValue;
        } else {
            throw new IncorrectCarValue("[carValue] supplied must be a valid value between 100 and 100000");
        }
    }
}
