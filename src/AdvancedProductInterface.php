<?php

namespace Sashaaro\ShoppingCart;

/**
 * Interface AdvancedProductInterface
 * @package Sashaaro\ShoppingCart
 * @author Aleksandr Arofikin <sashaaro@gmail.com>
 */
interface AdvancedProductInterface extends ProductInterface
{
    /**
     * @return string
     */
    public function getTitle();
}