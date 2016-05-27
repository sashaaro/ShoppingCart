<?php

namespace Sashaaro\ShoppingCart;

/**
 * Class SimpleCalculateStrategy
 * @package Sashaaro\ShoppingCart
 * @author Arofikin Aleksandr <sashaaro@gmail.com>
 */
class SimpleCalculateStrategy implements CalculateStrategyInterface
{
    /**
     * @param Cart $cart
     * @return float|int
     */
    public function calculate(Cart $cart)
    {
        $total = 0;

        foreach ($cart->getPositions() as $position) {
            $total += $position->getProduct()->getPrice() * $position->getQuantity();
        }

        return $total;
    }
}