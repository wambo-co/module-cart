<?php

namespace Wambo\Cart\Model;

/**
 * Class Cart is the shopping cart model.
 *
 * @package Wambo\Cart\Model
 */
class Cart
{
    /**
     * @var string
     */
    private $cartIdentifier;

    /** @var CartItem[] $cartItems */
    private $cartItems;

    /**
     * Create a new Cart instance.
     *
     * @param string $cartIdentifier A cart identifier
     * @param array  $cartItems      A list of cart items
     */
    public function __construct(string $cartIdentifier, array $cartItems)
    {
        $this->cartIdentifier = $cartIdentifier;
        $this->cartItems = $cartItems;
    }

    /**
     * @return string
     */
    public function getCartIdentifier(): string
    {
        return $this->cartIdentifier;
    }

    /**
     * Get all cart items
     *
     * @return CartItem[]
     */
    public function getItems(): array
    {
        return $this->cartItems;
    }
}