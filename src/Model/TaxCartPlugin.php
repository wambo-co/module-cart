<?php

namespace Wambo\Cart\Model;


class TaxCartPlugin implements CartPluginInterface
{
    const NAME = 'tax';

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
        $subtotal = $cart->getSubtotal()->getAmount();
        $taxAmount = $subtotal->multiply($this->taxRate);

        $total = new Total(self::NAME, $taxAmount, 1);
        $cart->addTotal($total);
    }
}