<?php

namespace Sashaaro\ShoppingCart;


class SimpleCalculateStrategy implements CalculateStrategyInterface
{
    public function calculate(Cart $cart)
    {
        $total = 0;

        foreach($cart->getPositions() as $position)
            $total += $position->getProduct()->getPrice() * $position->getQuantity();

        return $total;
    }
}