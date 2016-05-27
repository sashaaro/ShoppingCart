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
     * @var CalculateStrategyInterface
     */
    private $_calculateStrategy;

    /**
     * @var \Symfony\Component\EventDispatcher\EventDispatcher|null
     */
    private $_eventDispatcher;

    /**
     * @var CartEvent|null
     */
    private $_event;

    /**
     * @param CartStorageInterface $storage
     * @param CalculateStrategyInterface|null $calculateStrategy
     * @param EventDispatcherInterface|null $eventDispatcher
     */
    public function __construct(CartStorageInterface $storage, CalculateStrategyInterface $calculateStrategy = null, EventDispatcherInterface $eventDispatcher = null)
    {
        $this->_storage = $storage;
        $this->_calculateStrategy = $calculateStrategy ? $calculateStrategy : new SimpleCalculateStrategy();
        $this->_eventDispatcher = $eventDispatcher;
        if ($this->_eventDispatcher) {
            $this->_event = new CartEvent($this);
        }
    }

    /**
     * @param ProductInterface $product
     * @param $quantity
     */
    public function add(ProductInterface $product, $quantity)
    {
        $this->addPosition(new Position($product, $quantity));
        $this->fireEvent(CartEvent::AFTER_ADD);
    }

    /**
     * @param PositionInterface $position
     */
    public function addPosition(PositionInterface $position)
    {
        /** @var PositionInterface[] $positions */
        $positions = $this->getPositions();

        $added = false;
        foreach ($positions as &$item) {
            if ($this->isEqualProducts($position->getProduct(), $item->getProduct())) {
                $item->setQuantity($item->getQuantity() + $position->getQuantity());
                $added = true;
                break;
            }
        }

        if (!$added) {
            $positions[] = $position;
        }

        $this->_storage->setPositions($positions);
    }

    /**
     * @return PositionInterface[]
     */
    public function getPositions()
    {
        return $this->_storage->getPositions();
    }

    /**
     * get cost
     * @return int|float
     */
    public function getTotalPrice()
    {
        return $this->_calculateStrategy->calculate($this);
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        $quantity = 0;

        foreach ($this->getPositions() as $position) {
            $quantity += $position->getQuantity();
        }

        return $quantity;
    }

    public function clear()
    {
        $this->_storage->clear();
        $this->fireEvent(CartEvent::AFTER_CLEAR);
    }

    /**
     * @param ProductInterface $product
     */
    public function removeProduct(ProductInterface $product)
    {
        $positions = $this->getPositions();
        foreach ($positions as $k => $position) {
            if ($this->isEqualProducts($position->getProduct(), $product)) {
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
     * @param string $event
     */
    private function fireEvent($event)
    {
        if ($this->_eventDispatcher) {
            $this->_eventDispatcher->dispatch($event, $this->_event);
        }
    }
}
