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
    public function __construct(SessionInterface $session, $key = 'cart')
    {
        $this->_session = $session;
        $this->_key = $key;
    }

    public function add(ProductInterface $item, $quantity)
    {
        $products = (array)$this->_session->get($this->_key);
        $product = serialize($item);

        $added = false;
        foreach($products as &$item)
            if($item['product'] == $product){
                $item['qty'] += $quantity;
                $added = true;
                break;
            }

        if(!$added)
            $products[] = ['product' => $product, 'qty' => $quantity];

        $this->_session->set($this->_key, $products);
    }

    public function get()
    {
        $result = [];
        foreach($this->_session->get($this->_key) as $item){
            $component = @unserialize($item['product']);
            if($component instanceof ProductInterface)
                $result[] = ['product' => $component, 'qty' => $item['qty']];
        }

        return $result;
    }

    public function clear()
    {
        $this->_session->clear($this->_key);
    }

} 