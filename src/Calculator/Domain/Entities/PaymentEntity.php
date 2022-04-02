<?php

namespace Src\Calculator\Domain\Entities;

class PaymentEntity
{
    /**
     * @var float
     */
    public float $basePrice;
    /**
     * @var float
     */
    public float $commission;
    /**
     * @var float
     */
    public float $tax;
    /**
     * @var float
     */
    public float $total;

    /**
     * @param float $basePrice
     * @param float $commission
     * @param float $tax
     * @param float $total
     */
    public function __construct(float $basePrice, float $commission, float $tax, float $total)
    {
        $this->basePrice = round($basePrice, 2);
        $this->commission = round($commission, 2);
        $this->tax = round($tax, 2);
        $this->total = round($total, 2);
    }
}
