<?php

namespace Sashaaro\ShoppingCart\Event;

use Symfony\Component\EventDispatcher\Event;
use Sashaaro\ShoppingCart\Cart;

/**
 * Class BasketEvent
 * @package Blog\Bundle\Event
 */
class CartEvent extends Event
{
    const AFTER_ADD = 'busket.after_add';

    /**
     * @var \Sashaaro\ShoppingCart\Cart
     */
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * @return \Sashaaro\ShoppingCart\Cart
     */
    public function getCart()
    {
        return $this->cart;
    }
}