<?php


namespace Sashaaro\ShoppingCart;

/**
 * Interface ProductInterface
 * @package Sashaaro\ShoppingCart
 * @author Aleksandr Arofikin <sashaaro@gmail.com>
 */
interface ProductInterface
{
    /**
     * @return int|float
     */
    public function getPrice();

    /**
     * @return string|int
     */
    public function getId();
} 