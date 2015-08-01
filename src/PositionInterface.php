<?php

namespace Sashaaro\ShoppingCart;

use Sashaaro\ShoppingCart\ProductInterface;

/**
 * Interface PositionInterface
 * @author Aleksandr Arofkin
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