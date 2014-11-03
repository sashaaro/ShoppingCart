<?php

namespace Sashaaro\ShoppingCart;

use Doctrine\ORM\EntityManager;

/**
 * Class DbCartStorage
 *
 * @todo rename class
 *
 * @package Sashaaro\ShoppingCart
 */
class DbCartStorage implements CartStorageInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * @var IdentityDbCartStorageInterface
     */
    public $identity;

    /**
     * @param EntityManager $em
     * @param IdentityDbCartStorageInterface $identity
     */
    public function __construct(EntityManager $em, IdentityDbCartStorageInterface $identity)
    {
        $this->em = $em;
        $this->identity = $identity;

        if(!class_exists($this->identity->getEntityName()))
            throw new \Exception('Assigned Entity Name is not exist');
    }
    /**
     * @param ProductInterface $item
     * @param integer $quantity
     */
    public function add(ProductInterface $item, $quantity)
    {
        if(!is_int($this->identity->getId()) && strval($this->identity->getId()) === '') //TODO: isValid()
            return;

        $className = $this->identity->getEntityName();
        $post = new $className; //TODO: make EntityCartPositionInterface

        $post->setProduct(serialize($item));
        $post->setUserId($this->identity->getId());
        $post->setQuantity($quantity);

        $this->em->persist($post);
        $this->em->flush();
    }

    /**
     * @return ProductInterface[]
     */
    public function get()
    {
        if(!is_int($this->identity->getId()) && strval($this->identity->getId()) === '')
            return [];


        $positions = $this->getPositions();

        $result = [];
        foreach($positions as $position)
            $result[] = ['product' => @unserialize($position->getProduct()), 'qty' => $position->getQuantity()]; //TODO EntityCartPositionInterface

        return $result;
    }

    /**
     * @return array
     */
    public function getPositions()
    {
        $repository = $this->em->getRepository($this->identity->getEntityName());
        return $repository->findBy([$this->identity->getFieldName() => $this->identity->getId()]);
    }

    public function clear()
    {
        if(!is_int($this->identity->getId()) && strval($this->identity->getId()) === '')
            return;

        $positions = $this->getPositions();

        foreach($positions as $p)
            $this->em->remove($p);
        if($positions)
            $this->em->flush();
    }

} 