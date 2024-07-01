<?php

namespace Src\Desafio03;

class ListaNumerica
{
    public function somarElementos(array $lista)
    {
        return array_sum($lista);
    }
    public function encontraMaiorElemento(array $lista)
    {
        return max($lista);
    }
    public function encontraMenorElemento(array $lista)
    {
        return min($lista);
    }
    public function ordenarLista(array $lista)
    {
        sort($lista);
        return $lista;
    }
    public function filtrarNumerosPares(array $lista)
    {
        return array_filter($lista, function ($item) {
            return  !($item & 1);
        });
    }
}