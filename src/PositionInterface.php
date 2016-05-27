<?php

namespace Sashaaro\ShoppingCart;

/**
 * Interface PositionInterface
 * @author Aleksandr Arofikin <sashaaro@gmail.com>
 */
interface PositionInterface
{
    /**
     * @return int
     */
    public function getQuantity();

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity);

    /**
     * @return ProductInterface
     */
    public function getProduct();
}