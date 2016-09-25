<?php

namespace Wambo\Cart\Model;

use Money\Money;
use PHPUnit\Framework\TestCase;
use Wambo\Core\Model\SKU;
use Wambo\Core\Model\Qty;

/**
 * Class CartTest
 * @package Wambo\Cart\Model
 */
class CartTest extends TestCase
{
    /**
     * @test
     */
    public function test_constructor()
    {
        // arrange
        $cart = new Cart(3);
    }

    public function test_bigAllInOneTestNotFinal()
    {

        $cartItem1 = new CartItem(
            new SKU('ab-123'),
            new Qty(2),
            Money::EUR(99)
        );

        $cartItem2 = new CartItem(
            new SKU('xy-321'),
            new Qty(2),
            Money::EUR(500)
        );


        $taxPlugin = new TaxCartPlugin(0.19);


        $cart = new Cart('asdfasdf', [$cartItem1, $cartItem2], [$taxPlugin]);

        $totals = $cart->getTotal();
    }
}