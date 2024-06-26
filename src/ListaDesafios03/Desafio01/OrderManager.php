<?php

namespace Root\Www\ListaDesafios03\Desafio01;

use function PHPUnit\Framework\arrayHasKey;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\isEmpty;

class OrderManager
{
    /**
     * @var Order[] $orders
     */
    private array $orders = array();

    public function createOrder(int $id)
    {
        if (!$this->validate([$id])) {
            return false;
        }
        $order = new Order($id, array());
        $this->orders[] = $order;
        return $order;
    }

    public function addProductToOrder(int $orderId, Product $product)
    {
        if (!$this->validate([$orderId])) {
            return false;
        }
        if (!$this->validateOrderExists($orderId)) {
            return false;
        }
        foreach ($this->orders as $order){
            if ($order->getId() == $orderId){
                $order->addProduct($product);
            }
        }
        return $this->orders;
    }

    public function removeProductFromOrder(int $orderId, int $productId)
    {
        if (!$this->validate([$orderId, $productId])) {
            return false;
        }
        if (!$this->validateOrderExists($orderId)) {
            return false;
        }
        foreach ($this->orders as $order){
            if ($order->getId() == $orderId){
                $order->removeProduct($productId);
            }
        }
        return $this->orders;
    }
    public function getTotalFromOrder(int $orderId)
    {
        if(!$this->validate([$orderId])){
            return false;
        }
        if(!$this->validateOrderExists($orderId))
        {
            return false;
        }
        return $this->orders[$orderId]->getTotalPrice();
    }

    public function validate(array $fields): bool
    {
        if (sizeof($fields) <= 0) {
            return false;
        }
        foreach ($fields as $field) {
            //Valida se o objeto é instância de Product
            if (is_object($field) && !$field instanceof Product) {
                return false;
            }
            //Valida se o ID é um campo válido
            if (!isset($field) || !is_numeric($field) || $field < 0) {

                return false;
            }
        }
        return true;
    }

    public function validateOrderExists(int $orderId): bool
    {
        if (!arrayHasKey($orderId, $this->orders)) {
            return false;
        }
        return true;
    }
}