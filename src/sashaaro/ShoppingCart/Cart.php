<?php

namespace Sashaaro\ShoppingCart;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Sashaaro\ShoppingCart\Event\CartEvent;

/**
 * Class Cart
 * @package Sashaaro\ShoppingCart
 *
 * @todo removeItem
 */
class Cart
{
    /**
     * @var CartStorageInterface
     */
    private $_storage;

    /**
     * @var \Symfony\Component\EventDispatcher\EventDispatcher
     */
    private $_eventDispatcher;

    /**
     * @param CartStorageInterface $storage
     */
    public function __construct(CartStorageInterface $storage)
    {
        $this->_storage = $storage;
    }

    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        $this->_eventDispatcher = $eventDispatcher;
    }

    public function add(ProductInterface $product, $quantity)
    {
        $this->_storage->add($product, $quantity);
        if($this->_eventDispatcher)
            $this->_eventDispatcher->dispatch(CartEvent::AFTER_ADD, new CartEvent($this));
    }

    public function getTotalPrice()
    {
        $total = 0;
        foreach($this->getProducts() as $item)
            $total += $item['product']->getPrice() * $item['qty'];

        return $total;
    }

    public function clear()
    {
        $this->_storage->clear();
    }

    /**
     * @todo return EntityCartPositionInterface[] (ProductInterface with quantity)
     * @return array
     */
    public function getProducts()
    {
        return $this->_storage->get();
    }
}