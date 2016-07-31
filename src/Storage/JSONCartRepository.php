<?php

namespace Wambo\Cart\Storage;

use Wambo\Cart\Model\Cart;

/**
 * Class CartRepository provides read/write access to Carts.
 *
 * @package Wambo\Cart\Storage
 */
class JSONCartRepository implements CartRepositoryInterface
{
    /**
     * Get the cart with the given identifier
     *
     * @param string $cartIdentifier A cart identifier
     *
     * @return Cart
     */
    public function getCart(string $cartIdentifier): Cart
    {
        return new Cart($cartIdentifier);
    }

    /**
     * Save the given cart.
     *
     * @param Cart $cart
     */
    public function saveCart(Cart $cart)
    {
    }
}