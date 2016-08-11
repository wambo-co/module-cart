<?php

namespace Wambo\Cart\Model;


use Money\Money;

class Total
{

    /**
     * @var Money
     */
    private $subTotal;

    /**
     * @var Money
     */
    private $grandTotal;

    /**
     * @var TotalItemInterface[]
     */
    private $totals = [];

    /**
     * Totals constructor.
     * @param Money $subTotal
     * @param Money $grandTotal
     */
    public function __construct(Money $subTotal)
    {
        $this->subTotal = $subTotal;
        $this->grandTotal = $subTotal;
    }

    public function getSubTotal() : Money
    {
        return $this->subTotal;
    }

    /**
     * @param TotalItemInterface $total
     */
    public function addTotal(TotalItemInterface $total)
    {
        array_push($this->totals, $total);
        $this->sortTotals();
    }

    /**
     * Sort Totals by total->getSort()
     */
    private function sortTotals()
    {
        usort($this->totals, function($a, $b){
            if ($a->getSort() == $b->getSort()) {
                return 0;
            }
            return ($a->getSort() < $b->getSort() ) ? -1 : 1;
        });
    }

    /**
     * @return Money
     */
    public function getGrandTotal(): Money
    {
        return $this->grandTotal;
    }

    /**
     * @param Money $grandTotal
     */
    public function setGrandTotal(Money $grandTotal)
    {
        $this->grandTotal = $grandTotal;
    }


}