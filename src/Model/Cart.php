<?php

namespace Wambo\Cart\Model;
use Money\Currency;
use Money\Money;

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
     * @var CartPluginInterface[] $plugins
     */
    private $plugins;

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
        $this->plugins = [];
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

    public function addPlugin(CartPluginInterface $plugin)
    {
        $this->plugins[] = $plugin;
    }

    public function getSubtotal()
    {
        $subtotal = new Money(0, new Currency('EUR'));
        foreach($this->cartItems as $item){
            $subtotal = $subtotal->add($item->getPrice());
        }
        return $subtotal;
    }

    public function getTotals()
    {
        $totals['subtotal'] = $this->getSubtotal();
        foreach($this->plugins as $plugin){
            $total = $plugin->execute($this);
            $totals = array_merge($totals, $total);
        }
        return $totals;
    }



}