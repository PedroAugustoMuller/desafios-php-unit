<?php


namespace ListaDesafios03\Desafio01;

use Error;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Root\Www\ListaDesafios03\Desafio01\Product;
use TypeError;

class ProductTest extends TestCase
{
    private Product $product;

    public function testCreateProductValid()
    {
        $this->product = new Product(1, 'Amaciante', 2.00);
        $this->assertInstanceOf(Product::class, $this->product);
    }

    public function testCreateProductInvalid()
    {
        $this->expectException(Error::class);
        $this->product = new Product('teste', 'Amaciante', 20.00);
    }
    public function testAlterProductValid()
    {
        $this->product = new Product(1, 'Amaciante', 2.00);
        $this->product->setName('Batata');
        $this->assertEquals('Batata', $this->product->getName());
    }
    public function testAlterProductInvalid()
    {
        $this->expectException(Error::class);
        $this->product = new Product(1, 'Amaciante', 20.00);
        $this->product->setId('teste');
    }
}