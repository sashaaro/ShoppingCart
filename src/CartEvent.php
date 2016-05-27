<?php

namespace Sashaaro\ShoppingCart;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class BasketEvent
 * @package Blog\Bundle\Event
 * @author Aleksandr Arofikin <sashaaro@gmail.com>
 */
class CartEvent extends Event
{
    const AFTER_ADD = 'cart.after_add';
    const AFTER_CLEAR = 'cart.after_clear';

    /**
     * @var Cart
     */
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * @return Cart
     */
    public function getCart()
    {
        return $this->cart;
    }
}