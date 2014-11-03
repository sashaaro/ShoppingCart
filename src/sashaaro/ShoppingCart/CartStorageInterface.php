<?php

namespace Sashaaro\ShoppingCart;

interface CartStorageInterface
{
    /**
     * @param ProductInterface $item
     * @param integer $quantity
     */
    public function add(ProductInterface $item, $quantity);

    /**
     * @todo return EntityCartPositionInterface[]
     *
     * @return array
     */
    public function get();

    public function clear();

    //TODO: public function remove($item);
} 