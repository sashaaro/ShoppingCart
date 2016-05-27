<?php

namespace Sashaaro\ShoppingCart;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class SessionCartStorage
 * @package Blog\Bundle\Lib\Cart
 * @author Aleksandr Arofikin <sashaaro@gmail.com>
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
     * @var PositionInterface[]
     */
    private $_positions;

    /**
     * @param SessionInterface $session
     * @param string $key
     */
    public function __construct(SessionInterface $session, $key = '__cart')
    {
        $this->_session = $session;
        $this->_key = $key;
    }

    /**
     * @return PositionInterface[]
     */
    public function getPositions()
    {
        if (!$this->_positions) {
            $this->loadPositions();
        }

        return $this->_positions;
    }

    public function setPositions(array $positions)
    {
        $this->_session->set($this->_key, serialize($positions));
        $this->_positions = $positions;
    }

    private function loadPositions()
    {
        $positions = unserialize($this->_session->get($this->_key));
        $this->_positions = is_array($positions) ? $positions : [];
    }

    public function clear()
    {
        $this->_session->remove($this->_key);
        $this->_positions = null;
    }

} 