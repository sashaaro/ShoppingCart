<?php

namespace Sashaaro\ShoppingCart;

interface CartStorageInterface
{
    /**
     * @param PositionInterface[] $position
     */
    public function set(array $position);

    /**
     * @return PositionInterface[]
     */
    public function getAll();

    public function clear();

    //TODO: public function remove($item);
} 