<?php

namespace Sashaaro\ShoppingCart;

/**
 * Interface CalculateStrategyInterface
 * @package Sashaaro\ShoppingCart
 * @author Aleksandr Arofikin <sashaaro@gmail.com>
 */
interface CalculateStrategyInterface
{
    /**
     * @param Cart $cart
     * @return int|float Total price
     */
    public function calculate(Cart $cart);
}