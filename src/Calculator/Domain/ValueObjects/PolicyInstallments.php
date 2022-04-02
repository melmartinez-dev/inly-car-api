<?php

declare(strict_types=1);

namespace Src\Calculator\Domain\ValueObjects;

use Src\Calculator\Domain\Exceptions\IncorrectPolicyInstallments;

class PolicyInstallments
{
    /**
     * @var int
     */
    private int $policyInstallments;

    public function __construct(?int $policyInstallments)
    {
        $this->setPolicyInstallments($policyInstallments);
    }

    /**
     * @return int
     */
    public function getPolicyInstallments(): int
    {
        return $this->policyInstallments;
    }

    /**
     * @param int $policyInstallments
     */
    private function setPolicyInstallments(?int $policyInstallments): void
    {
        if (!is_null($policyInstallments) && $policyInstallments >= 1 && $policyInstallments <= 12) {
            $this->policyInstallments = $policyInstallments;
        } else {
            throw new IncorrectPolicyInstallments("[policyInstallments] supplied must be a valid value between 1 and 12");
        }
    }
}
