<?php

namespace Wambo\Cart\Model;


class TaxCartPlugin implements CartPluginInterface
{
    /**
     * @var float
     */
    private $taxRate;

    public function __construct(float $taxRate)
    {
        $this->taxRate = $taxRate;
    }

    public function execute(Cart $cart)
    {
        $subtotal = $cart->getSubtotal();

        $taxAmount = $subtotal->multiply($this->taxRate);
        return array('tax' => $taxAmount);
    }
}