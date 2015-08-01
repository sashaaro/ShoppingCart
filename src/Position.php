<?php

namespace Sashaaro\ShoppingCart;

/**
 * Class Position
 */
class Position implements PositionInterface
{
    /**
     * @var ProductInterface
     */
    protected $product;
    /**
     * @var int
     */
    protected $quantity;

    function __construct(ProductInterface $product, $quantity)
    {
        $this->procudt = $product;
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return ProductInterface
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
}