<?php

namespace Sashaaro\ShoppingCart;

use Symfony\Component\Security\Core\User\UserInterface;
use Sashaaro\ShoppingCart\IdentityDbCartStorageInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * Class IdentityCartUserAdapter for example 
 * Adapter for Symfony SecurityContextInterface
 */
class IdentityCartUserAdapter implements IdentityDbCartStorageInterface
{
    /**
     * @var \Symfony\Component\Security\Core\User\User
     */
    private $user;

    public function __construct(SecurityContextInterface $security)
    {
        $this->user = $security->getToken()->getUser();
    }


    public function getId()
    {
        if($this->user instanceof UserInterface)
            return $this->user->getId();//$this->user->getId();

        return null;
    }

    public function getFieldName()
    {
        return 'user_id';
    }

    public function getEntityName()
    {
        return 'Blog\Bundle\Entity\CartPosition';
    }
} 
