<?php

namespace Sashaaro\ShoppingCart;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Sashaaro\ShoppingCart\Event\CartEvent;

/**
 * Class Cart
 * @package Sashaaro\ShoppingCart
 *
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
        $this->addPosition(new Position($product, $quantity));

        if($this->_eventDispatcher)
            $this->_eventDispatcher->dispatch(CartEvent::AFTER_ADD, new CartEvent($this));
    }

    public function addPosition(PositionInterface $position)
    {
        /** @var PositionInterface[] $positions */
        $positions = $this->getPositions();

        $added = false;
        foreach($positions as &$item)
            if($position->getProduct() === $item->getProduct() || $position->getProduct()->getId() == $item->getProduct()->getId()){
                $item->setQuantity($item->getQuantity() + $position->getQuantity());
                $added = true;
                break;
            }

        if(!$added) {
            $positions[] = $position;
        }

        $this->_storage->set($positions);
    }

    public function getTotalPrice()
    {
        $total = 0;

        foreach($this->getPositions() as $position)
            $total += $position->getProduct()->getPrice() * $position->getQuantity();

        return $total;
    }

    public function clear()
    {
        $this->_storage->clear();
    }

    /**
     * @return PositionInterface[]
     */
    public function getPositions()
    {
        return $this->_storage->getAll();
    }
}
