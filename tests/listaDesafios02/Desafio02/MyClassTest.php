<?php

namespace listaDesafios02\Desafio02;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Root\Www\ListaDesafios02\Desafio02\MyClass;

class MyClassTest extends TestCase
{
    public function testRealizaCompra()
    {
        $metodoPagamento = $this->createStub(MetodoPagamento::class);
        $metodoPagamento->expects($this->once())
            ->method('processaCompra')
            ->with($this->equalTo(200))
            ->willReturn(true);
        $myClass = new MyClass($metodoPagamento);
        $myClass->setValorCompra(200);
        $retorno = $myClass->realizaCompra();
        $this->assertTrue($retorno);
    }
}