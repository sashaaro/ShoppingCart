<?php

namespace Sashaaro\ShoppingCart;

/**
 * Class Position
 * @author Aleksandr Arofikin <sashaaro@gmail.com>
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
        $this->product = $product;
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
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return ProductInterface
     */
    public function getProduct()
    {
        return $this->product;
    }
}