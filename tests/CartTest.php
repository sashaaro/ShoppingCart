<?php

/**
 * Class CartTest
 */
class CartTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Sashaaro\ShoppingCart\Cart
     */
    protected $cart;

    protected function setUp()
    {
        $session = new \Symfony\Component\HttpFoundation\Session\Session(new \Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage());
        $storage = new \Sashaaro\ShoppingCart\SessionCartStorage($session);
        $this->cart = new \Sashaaro\ShoppingCart\Cart($storage);
    }

    public function testAdd()
    {
        $productMock = $this->getMock('\Sashaaro\ShoppingCart\ProductInterface', ['getPrice', 'getId']);
        $productMock->expects($this->once())
            ->method('getPrice')
            ->will($this->returnValue(50));

        $this->cart->add($productMock, 2);
        $this->assertEquals($this->cart->getTotalPrice(), 100);
    }
}
