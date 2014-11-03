<?php


namespace Sashaaro\ShoppingCart;

/**
 * Interface ProductInterface
 * @package Sashaaro\ShoppingCart
 * @todo add method getTitle
 */
interface ProductInterface
{
    /**
     * @return int
     */
    public function getPrice();

    public function getId();
} 