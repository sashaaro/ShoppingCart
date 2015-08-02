<?php


namespace Sashaaro\ShoppingCart;

/**
 * Interface ProductInterface
 * @package Sashaaro\ShoppingCart
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