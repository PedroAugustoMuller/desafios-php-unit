<?php

namespace Root\Www\ListaDesafios03\Desafio01;

class Order
{
    private int $id;
    private array $products;
    private float $totalPrice;

    public function __construct(int $id, array $products)
    {
        $this->id = $id;
        $this->products = $products;
        $this->setTotalPrice();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }
    public function addProduct(Product $productToAdd): bool
    {
        foreach($this->products as $product)
        {
            if($productToAdd->getId() == $product->getId()){
                return false;
            }
        }
        $this->products[] = $productToAdd;
        $this->setTotalPrice();
        return true;
    }
    public function removeProduct(int $productId): bool
    {
        foreach ($this->products as $key => $product){
            if($product->getId() == $productId){
                unset($this->products[$key]);
                $this->setTotalPrice();
                return true;
            }
        }
        return false;
    }
    public function removeAllProducts(): true
    {
        $this->products = [];
        $this->setTotalPrice();
        return true;
    }
    private function setTotalPrice() : void
    {
        $totalPrice = 0;
        foreach($this->products as $product)
        {
            if($product instanceof Product)
            {
                $totalPrice += $product->getPrice();
            }
        }
        $this->totalPrice = $totalPrice;
    }
}