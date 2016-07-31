<?php

namespace Wambo\Cart\Model;

/**
 * Class CartItem represents a single cart item.
 *
 * @package Wambo\Cart\Model
 */
class CartItem
{
    /**
     * @var string
     */
    private $sku;

    /**
     * Create a new CartItem instance.
     *
     * @param string $sku The SKU of a product
     */
    public function __construct(string $sku)
    {
        $this->sku = $sku;
    }

    /**
     * Get the SKU of the product.
     *
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }
}