<?php

namespace Wambo\Cart\Model;

use Wambo\Core\Model\Qty;

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
     * @var Qty
     */
    private $qty;

    /**
     * Create a new CartItem instance.
     *
     * @param string    $sku    The SKU of a product
     * @param Qty       $qty    The Qty of a item for the product
     */
    public function __construct(string $sku, Qty $qty)
    {
        $this->sku = $sku;
        $this->qty = $qty;
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