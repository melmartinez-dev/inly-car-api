<?php

declare(strict_types=1);

namespace Src\Calculator\Domain\ValueObjects;

use Src\Calculator\Domain\Exceptions\IncorrectUserTime;

class UserTime
{
    /**
     * @var \DateTime
     */
    private \DateTime $userTime;

    public function __construct(?string $userTime)
    {
        $this->setUserTime($userTime);
    }

    /**
     * @return \DateTime
     */
    public function getUserTime(): \DateTime
    {
        return $this->userTime;
    }

    /**
     * @param string|null $userTime
     */
    private function setUserTime(?string $userTime): void
    {
        if (is_null($userTime)) {
            throw new IncorrectUserTime("[userTime] value not provided");
        }
        try {
            $this->userTime = new \DateTime($userTime);
        } catch (\Exception $e) {
            throw new IncorrectUserTime($e->getMessage());
        }
    }
}
