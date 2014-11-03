<?php


namespace Sashaaro\ShoppingCart;

/**
 * Interface IdentityDbCartStorageInterface
 *
 * For finding cart positions by id
 * @see DbCartStorage
 *
 * @package Sashaaro\ShoppingCart
 */
interface IdentityDbCartStorageInterface
{
    //TODO: isValid()

    /**
     * @return int|string|null
     */
    public function getId();

    /**
     * @return string
     */
    public function getFieldName();

    /**
     * Get Doctrine Entity Name
     * @return string
     */
    public function getEntityName();
}