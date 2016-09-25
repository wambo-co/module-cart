<?php
namespace Wambo\Cart\Model;

use Money\Money;
use PHPUnit\Framework\TestCase;
use Wambo\Core\Model\Total;

class TotalTest extends TestCase
{
    /**
     * @test
     */
    public function test_constructor()
    {
        // arrange
        /** @var Money $subTotal */
        $subTotal = $this->createMock(Money::class);

        // act
        new Total($subTotal);
    }
}