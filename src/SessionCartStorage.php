<?php

namespace Sashaaro\ShoppingCart;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class SessionCartStorage
 * @package Blog\Bundle\Lib\Cart
 */
class SessionCartStorage implements CartStorageInterface
{
    /**
     * @var SessionInterface
     */
    private $_session;

    /**
     * @var string
     */
    private $_key;

    /**
     * @param SessionInterface $session
     * @param string $key
     */
    public function __construct(SessionInterface $session, $key = '__cart')
    {
        $this->_session = $session;
        $this->_key = $key;
    }


    public function set(array $positions)
    {
        $this->_session->set($this->_key, serialize($positions));
    }

    public function getAll()
    {
        return (array)@unserialize($this->_session->get($this->_key));
    }

    public function clear()
    {
        $this->_session->clear($this->_key);
    }

} 