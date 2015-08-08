<?php

namespace Sashaaro\ShoppingCart;

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