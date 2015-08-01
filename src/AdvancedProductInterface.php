<?php

namespace Sashaaro\ShoppingCart;


interface AdvancedProductInterface extends ProductInterface
{
    /**
     * @return string
     */
    public function getTitle();
}