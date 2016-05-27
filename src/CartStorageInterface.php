<?php

namespace Sashaaro\ShoppingCart;

/**
 * Interface CartStorageInterface
 * @package Sashaaro\ShoppingCart
 * @author Aleksandr Arofikin <sashaaro@gmail.com>
 */
interface CartStorageInterface
{
    /**
     * @param PositionInterface[] $position
     */
    public function setPositions(array $position);

    /**
     * @return PositionInterface[]
     */
    public function getPositions();

    public function clear();
}