<?php

namespace Wambo\Cart\Model;

/**
 * Class Cart is the shopping cart model.
 *
 * @package Wambo\Cart\Model
 */
class Cart
{
    /** @var CartItem[] $items */
    public $items;

    /**
     * @var string
     */
    private $cartIdentifier;

    /**
     * Create a new Cart instance.
     *
     * @param string $cartIdentifier A cart identifier
     */
    public function __construct(string $cartIdentifier)
    {
        $this->cartIdentifier = $cartIdentifier;
        $this->items = [];
    }

    /**
     * @return string
     */
    public function getCartIdentifier(): string
    {
        return $this->cartIdentifier;
    }
}