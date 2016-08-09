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
     * @var TotalInterface[] $totals
     */
    private $totals;

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
        $this->totals = [];
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

    /**
     * @return Total
     */
    public function getSubtotal()
    {
        $subtotalSum = new Money(0, new Currency('EUR'));
        foreach($this->cartItems as $item){
            $subtotalSum = $subtotalSum->add($item->getPrice());
        }

        $subtotal = new Total('subtotal', $subtotalSum, 0);
        return $subtotal;
    }

    /**
     * @param TotalInterface $total
     */
    public function addTotal(TotalInterface $total)
    {
        array_push($this->totals, $total);
    }

    /**
     * @return array|TotalInterface[]
     */
    public function getTotals()
    {
        $subtotal = $this->getSubtotal();
        array_push($this->totals, $subtotal);
        foreach($this->plugins as $plugin){
            $plugin->execute($this);
        }
        $this->sortTotals();
        return $this->totals;
    }
    
    private function sortTotals()
    {
        usort($this->totals, function($a, $b){
            if ($a->getSort() == $b->getSort()) {
                return 0;
            }
            return ($a->getSort() < $b->getSort() ) ? -1 : 1;
        });
    }



}