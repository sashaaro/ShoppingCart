<?php


namespace Sashaaro\ShoppingCart;

/**
 * Interface ProductInterface
 * @package Sashaaro\ShoppingCart
 */
interface ProductInterface
{
    /**
     * @return int
     */
    public function getPrice();

    public function getId();
} 