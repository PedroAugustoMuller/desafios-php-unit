<?php

namespace ListaDesafios03\Desafio01;

use Error;
use PHPUnit\Framework\TestCase;
use Root\Www\ListaDesafios03\Desafio01\Order;
use Root\Www\ListaDesafios03\Desafio01\Product;

class OrderTest extends TestCase
{
    private Order $order;
    protected function setUp(): void
    {
        $this->order = new Order(1,array());
    }

    public function testCreateOrderValid()
    {
        $testOrder = new Order(2,array());
        $this->assertInstanceOf(Order::class, $testOrder);
    }
    public function testCreateOrderInvalid()
    {
        $this->expectException(Error::class);
        $testOrder = new Order(3);
    }
    public function testGetProductsFromOrder()
    {
        $product = new Product(1,'Abacaxi',9.5);
        $this->order->addProduct($product);
        $this->assertContains($product, $this->order->getProducts());
    }
    public function testGetProductsFromOrderEmpty()
    {
        $this->assertEmpty($this->order->getProducts());
    }
    public function testAddProductToOrderValid()
    {
        $product = new Product(1,'Banana',4.5);
        $this->order->addProduct($product);
        $this->assertContains($product, $this->order->getProducts());
    }
    public function testAddProductToOrderInvalid()
    {
        $this->expectException(Error::class);
        $this->order->addProduct('teste');
    }
    public function testAddProductToOrderDuplicated()
    {
        $product = new Product(1,'Banana',4.5);
        $this->order->addProduct($product);
        $this->order->addProduct($product);
        $this->assertCount(1, $this->order->getProducts());
    }
    public function testRemoveProductFromOrderValid()
    {
        $product = new Product(2,'Banana',4.5);
        $this->order->addProduct($product);
        $this->assertContains($product, $this->order->getProducts());
        $this->order->removeProduct($product->getId());
        $this->assertEmpty($this->order->getProducts());
    }
    public function testRemoveProductFromOrderInvalid()
    {
        $this->assertFalse($this->order->removeProduct(1));
    }
    public function testRemoveAllProductsFromOrder(){
        $product = new Product(1,'Banana',4.5);
        $product2 = new Product(2,'Amaciante',20);
        $this->order->addProduct($product);
        $this->order->addProduct($product2);
        $this->assertContains($product, $this->order->getProducts());
        $this->assertContains($product2, $this->order->getProducts());
        $this->order->removeAllProducts();
        $this->assertEmpty($this->order->getProducts());
    }
    public function testGetOrderTotalPrice()
    {
        $this->order->addProduct(new Product(1,'Banana',4.5));
        $this->order->addProduct(new Product(2,'Amaciante',20));
        $this->assertEquals(24.5,$this->order->getTotalPrice());
    }
    public function testGetOrderTotalValueShouldBeZero()
    {
        $this->assertEquals(0,$this->order->getTotalPrice());
    }
}