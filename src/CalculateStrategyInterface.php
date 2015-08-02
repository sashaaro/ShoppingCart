<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 02.08.15
 * Time: 8:57
 */

namespace Sashaaro\ShoppingCart;


interface CalculateStrategyInterface
{
    /**
     * @param Cart $cart
     * @return int|float Total price
     */
    public function calculate(Cart $cart);
}