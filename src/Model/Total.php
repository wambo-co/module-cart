<?php

namespace Wambo\Cart\Model;


use Money\Money;

class Total implements TotalInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Money
     */
    private $amount;

    /**
     * @var int
     */
    private $sort;

    /**
     * Total constructor.
     * @param string $name
     * @param Money $amount
     * @param int $sort
     */
    public function __construct(string $name, Money $amount, int $sort)
    {
        $this->name = $name;
        $this->amount = $amount;
        $this->sort = $sort;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @return Money
     */
    public function getAmount()
    {
        return $this->amount;
    }
}