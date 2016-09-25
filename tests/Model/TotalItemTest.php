<?php
namespace Wambo\Cart\Model;

use Money\Money;
use PHPUnit\Framework\TestCase;
use Wambo\Core\Model\TotalItem;

class TotalItemTest extends TestCase
{
    /**
     * @test
     */
    public function test_constructor()
    {
        // arrange
        $name = 'test';

        /** @var Money $amount */
        $amount = $this->createMock('Money\Money');
        $sort = 0;

        // act
        new TotalItem($name, $amount, $sort);
    }

    /**
     * @test
     * @expectedException \TypeError
     */
    public function test_set_name_null()
    {
        // act
        new TotalItem(null, null, null);
    }

    /**
     * @test
     */
    public function test_getter()
    {
        // arrange
        $name = 'test';

        /** @var Money $amount */
        $amount = $this->createMock('Money\Money');
        $sort = 3;

        // act
        $totalItem = new TotalItem($name, $amount, $sort);

        // assert
        $this->assertEquals($name, $totalItem->getName());
        $this->assertEquals($amount, $totalItem->getAmount());
        $this->assertEquals($sort, $totalItem->getSort());
    }
}