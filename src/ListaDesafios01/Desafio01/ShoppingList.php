<?php

namespace Src\Desafio01;
class ShoppingList
{
    private array $listaDeCompras = ['Pão',
        'Queijo',
        'Maionese',
        'Sabão'];

    public function addItem(string $item)
    {
        if (in_array($item, $this->listaDeCompras)) {
            return "Item já está na lista de compras";
        }
        $this->listaDeCompras[] = $item;
        return $this->listaDeCompras;
    }

    public function getItems()
    {
        if (empty($this->listaDeCompras)) {
            return "Lista de Compras vazia";
        }
        return $this->listaDeCompras;
    }

    public function removeItem(int $index)
    {
        if (!array_key_exists($index, $this->listaDeCompras)) {
            return "Item não existe na lisa de compras";
        }
        unset($this->listaDeCompras[$index]);
        return $this->listaDeCompras;
    }

    public function clearList()
    {
        $this->listaDeCompras = array();
        return $this->listaDeCompras;
    }
}