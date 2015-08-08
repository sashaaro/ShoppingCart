<?php

namespace Sashaaro\ShoppingCart;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class Cart
 * @author Aleksandr Arofikin <sashaaro@gmail.com>
 */
class Cart
{
    /**
     * @var CartStorageInterface
     */
    private $_storage;

    /**
     * @var \Symfony\Component\EventDispatcher\EventDispatcher|null
     */
    private $_eventDispatcher;

    /**
     * @var CalculateStrategyInterface
     */
    private $_calculateStrategy;

    /**
     * @param CartStorageInterface $storage
     */
    public function __construct(CartStorageInterface $storage)
    {
        $this->_storage = $storage;
        $this->_calculateStrategy = new SimpleCalculateStrategy();
    }

    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        $this->_eventDispatcher = $eventDispatcher;
    }

    public function add(ProductInterface $product, $quantity)
    {
        $this->addPosition(new Position($product, $quantity));
        $this->fireEvent(CartEvent::AFTER_ADD);
    }

    private function fireEvent($event)
    {
        static $cartEvent;
        if(!$cartEvent)
            $cartEvent = new CartEvent($this);

        if($this->_eventDispatcher)
            $this->_eventDispatcher->dispatch($event, $cartEvent);
    }

    public function addPosition(PositionInterface $position)
    {
        /** @var PositionInterface[] $positions */
        $positions = $this->getPositions();

        $added = false;
        foreach($positions as &$item)
            if($this->isEqualProducts($position->getProduct(), $item->getProduct())){
                $item->setQuantity($item->getQuantity() + $position->getQuantity());
                $added = true;
                break;
            }

        if(!$added) {
            $positions[] = $position;
        }

        $this->_storage->setPositions($positions);
    }

    /**
     * get cost
     * @return int|float
     */
    public function getTotalPrice()
    {
        return $this->_calculateStrategy->calculate($this);
    }

    public function setCalculateStrategy(CalculateStrategyInterface $strategy)
    {
        $this->_calculateStrategy = $strategy;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        $quantity = 0;

        foreach($this->getPositions() as $position)
            $quantity += $position->getQuantity();

        return $quantity;
    }

    public function clear()
    {
        $this->_storage->clear();
        $this->fireEvent(CartEvent::AFTER_CLEAR);
    }

    public function removeProduct(ProductInterface $product)
    {
        $positions = $this->getPositions();
        foreach($positions as $k => $position) {
            if($this->isEqualProducts($position->getProduct(), $product)) {
                unset($positions[$k]);
            }
        }
        $this->_storage->clear();
        $this->_storage->setPositions($positions);
    }

    /**
     * @param ProductInterface $product
     * @param ProductInterface $otherProduct
     * @return bool
     */
    private function isEqualProducts(ProductInterface $product, ProductInterface $otherProduct)
    {
        return $product === $otherProduct || $product->getId() == $otherProduct->getId();
    }

    /**
     * @return PositionInterface[]
     */
    public function getPositions()
    {
        return $this->_storage->getPositions();
    }
}
