<?php

namespace Wambo\Cart\Model;


use Money\Money;
use Wambo\Checkout\Model\Core\SKU;
use Wambo\Core\Model\Qty;

interface CartItemInterface
{
    public function getSku() : SKU;
    public function getQty() : Qty;
    public function getPrice() : Money;
}