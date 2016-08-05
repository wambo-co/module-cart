<?php

namespace Wambo\Cart\Model;

use Money\Money;
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
     * @var Money
     */
    private $price;

    /**
     * Create a new CartItem instance.
     *
     * @param string $sku The SKU of a product
     * @param Qty $qty The Qty of a item for the product
     * @param Money $price
     */
    public function __construct(string $sku, Qty $qty, Money $price)
    {
        $this->sku = $sku;
        $this->qty = $qty;
        $this->price = $price;
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

    /**
     * @return Qty
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * @return Money
     */
    public function getPrice()
    {
        return $this->price;
    }
}