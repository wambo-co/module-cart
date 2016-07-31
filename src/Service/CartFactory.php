<?php

namespace Wambo\Cart\Service;

use RandomLib\Generator;
use Wambo\Cart\Model\Cart;

/**
 * Class CartFactory creates new Cart models.
 *
 * @package Wambo\Cart\Service
 */
class CartFactory
{
    /**
     * @var Generator
     */
    private $randomNumberGenerator;

    /**
     * Create a new CartFactory instance.
     *
     * @param Generator $randomNumberGenerator
     */
    public function __construct(Generator $randomNumberGenerator)
    {
        $this->randomNumberGenerator = $randomNumberGenerator;
    }

    /**
     * Create a new Cart model.
     *
     * @return Cart
     */
    public function createCart(): Cart
    {
        $cartIdentifier = $this->randomNumberGenerator->generateString(40, "abcdef0123456789");
        return new Cart($cartIdentifier, []);
    }
}