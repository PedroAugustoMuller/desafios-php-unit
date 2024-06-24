<?php

namespace Root\Www\ListaDesafios02\Desafio02;

class MyClass
{
    private int $valorCompra;
    protected MetodoPagamento $metodoPagamento;

    public function __construct(MetodoPagamento $metodoPagamento)
    {
        $this->metodoPagamento = $metodoPagamento;
    }
    public function realizaCompra()
    {
        return $this->metodoPagamento->processaCompra($this->valorCompra);
    }
    public function setValorCompra(int $valorCompra): void
    {
        $this->valorCompra = $valorCompra;
    }
}