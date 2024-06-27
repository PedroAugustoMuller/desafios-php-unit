<?php

namespace ListaDesafios03\Desafio01;

use Error;
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
    public function testOrderManagerGetOrders()
    {
        $this->orderManager->createOrder(1);
        $this->orderManager->createOrder(2);
        $this->orderManager->createOrder(3);
        $this->assertCount(3,$this->orderManager->getOrder());
    }
    public function testOrderManagerDeleteOrderValid()
    {
        $this->orderManager->createOrder(1);
        $this->orderManager->deleteOrder(1);
        $this->assertCount(0,$this->orderManager->getOrder());
    }
    public function testOrderManagerDeleteOrderInvalid()
    {
        $this->assertFalse($this->orderManager->deleteOrder(1));
    }
    public function testOrderManagerAddProductToOrderValid()
    {
        $order = $this->orderManager->createOrder(1);
        $product = new Product(1,'Maionese',9.5);
        $order = $this->orderManager->addProductToOrder($order->getId(),$product)[0];
        $this->assertContains($product, $order->getProducts());
    }
    public function testOrderManagerAddMultipleProductsToOrderValid()
    {
        $order = $this->orderManager->createOrder(1);
        $product1 = new Product(1,'Maionese',9.5);
        $product2 = new Product(2,'Beterraba',4.5);
        $this->orderManager->addProductToOrder($order->getId(),$product1);
        $this->orderManager->addProductToOrder($order->getId(),$product2);
        $this->assertContains($product1, $order->getProducts());
        $this->assertContains($product2, $order->getProducts());
    }
    public function testOrderManagerAddProductToOrderInvalid()
    {
        $this->expectException(Error::class);
        $order = $this->orderManager->createOrder(1);
        $this->orderManager->addProductToOrder(1,'teste');
        $this->assertEmpty($order->getProducts());
    }
    public function testOrderManagerRemoveProductFromOrderValid()
    {
        $order = $this->orderManager->createOrder(1);
        $product1 = new Product(1,'Maionese',9.5);
        $this->orderManager->addProductToOrder($order->getId(),$product1);
        $this->assertContains($product1, $order->getProducts());
        $this->orderManager->removeProductFromOrder($order->getId(),$product1->getId());
        $this->assertEmpty($order->getProducts());
    }
    public function testOrderManagerRemoveProductFromOrderInvalid()
    {
        $order = $this->orderManager->createOrder(1);
        $this->assertFalse($this->orderManager->removeProductFromOrder($order->getId(),1));
    }
    public function testOrderManagerRemoveAllProductsFromOrderValid()
    {
        $order = $this->orderManager->createOrder(1);
        $product1 = new Product(1,'Maionese',9.5);
        $this->orderManager->addProductToOrder($order->getId(),$product1);
        $this->assertContains($product1, $order->getProducts());
        $this->orderManager->removeAllProductsFromOrder($order->getId());
        $this->assertEmpty($order->getProducts());
    }
    public function testOrderManagerGetTotalPriceFromOrder()
    {
        $order = $this->orderManager->createOrder(1);
        $product1 = new Product(1,'Maionese',9.5);
        $product2 = new Product(2,'Beterraba',4.5);
        $this->orderManager->addProductToOrder($order->getId(),$product1);
        $this->orderManager->addProductToOrder($order->getId(),$product2);
        $this->assertEquals(14,$this->orderManager->getTotalFromOrder($order->getId()));
    }
    public function testOrderManagerGetTotalPriceFromOrderShouldBeZero()
    {
        $this->assertEquals(0,$this->orderManager->getTotalFromOrder(1));
    }
}