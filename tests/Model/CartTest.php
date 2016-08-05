<?php

namespace Wambo\Cart\Model;

use Money\Money;
use PHPUnit\Framework\TestCase;
use Wambo\Catalog\Model\SKU;
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
        $cart = new Cart(3,[]);

    }

    public function test_bigAllInOneTestNotFinal()
    {
        $cartItem1 = new CartItem(
            new SKU('ab-123'),
            new Qty(2),
            Money::EUR(399)
        );
        $cart = new Cart('asdfasdf', [$cartItem1]);

        $taxPlugin = new TaxCartPlugin(0.19);
        $cart->addPlugin($taxPlugin);

        $totals = $cart->getTotals();
        print_r($totals);
    }
}