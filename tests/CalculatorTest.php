<?php

class CalculatorTest extends \PHPUnit\Framework\TestCase
{
    private \Src\Calculator\Application\CalculatePaymentsUseCase $useCase;

    protected function setUp(): void
    {
        $this->useCase = new \Src\Calculator\Application\CalculatePaymentsUseCase();
    }

    public function testCreateUseCaseWithMissingParams()
    {
        $this->expectException(DomainException::class);
        $this->useCase->execute(null, null, null, null);
    }

    public function testCalculatePaymentsOnNormalDay()
    {
        $result = $this->useCase->execute(10000, 10, 2, "2022-04-01T22:58:24.562Z");
        $policy = $result["policy"];
        $installments = $result["installments"];
        $this->assertJsonStringEqualsJsonString(
            json_encode($policy),
            json_encode(new \Src\Calculator\Domain\Entities\PaymentEntity(1100, 187, 110, 1397)),
            "Policy was not calculated correctly");
        $installment = $installments[0];
        $this->assertJsonStringEqualsJsonString(
            json_encode($installment),
            json_encode(new \Src\Calculator\Domain\Entities\PaymentEntity(550, 93.5, 55, 698.5)),
            "Installments where not calculated correctly");
    }

    public function testCalculatePaymentsOnFridayPolicy(){
        $result = $this->useCase->execute(10000, 10, 2, "2022-04-01T16:58:24.562Z");
        $policy = $result["policy"];
        $installments = $result["installments"];
        $this->assertJsonStringEqualsJsonString(
            json_encode($policy),
            json_encode(new \Src\Calculator\Domain\Entities\PaymentEntity(1300, 221, 130, 1651)),
            "Policy was not calculated correctly");
        $installment = $installments[0];
        $this->assertJsonStringEqualsJsonString(
            json_encode($installment),
            json_encode(new \Src\Calculator\Domain\Entities\PaymentEntity(650, 110.5, 65, 825.5)),
            "Installments where not calculated correctly");
    }
}