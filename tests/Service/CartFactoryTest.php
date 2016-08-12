<?php
namespace Wambo\Cart\Service;

use PHPUnit\Framework\TestCase;
use RandomLib\Generator;

class CartFactoryTest extends TestCase
{
    public function test_createCart()
    {
        // arrange
        $generator = $this->createMock(Generator::class);
        $generator->method('generateString')->willReturn('asdfasdfa2312');
        /** @var Generator $generator */

        $cartFactory = new CartFactory($generator);

        // act
        $cart = $cartFactory->createCart();
    }
}