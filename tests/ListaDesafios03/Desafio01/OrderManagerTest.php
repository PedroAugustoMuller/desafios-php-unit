<?php

namespace ListaDesafios03\Desafio01;

use PHPUnit\Framework\TestCase;
use Root\Www\ListaDesafios03\Desafio01\Order;
use Root\Www\ListaDesafios03\Desafio01\OrderManager;
use Root\Www\ListaDesafios03\Desafio01\Product;

class OrderManagerTest extends TestCase
{
    private $orderManager;
    protected function setUp(): void
    {
        $this->orderManager = new OrderManager();
    }

    public function testOrderManagerCreateOrderValid()
    {
        $order = $this->orderManager->createOrder(1);
        $this->assertInstanceOf(Order::class,$order);
    }
    public function testOrderManagerCreateOrderInvalid()
    {
        $order = $this->orderManager->createOrder(-1);
        $this->assertFalse($order);
    }
    public function testOrderManagerAddProductToOrderValid()
    {
        $order = $this->orderManager->createOrder(1);
        $product = new Product(1,'Maionese',9.5);
        $order = $this->orderManager->addProductToOrder($order->getId(),$product)[0];
        $this->assertContains($product, $order->getProducts());
    }
}