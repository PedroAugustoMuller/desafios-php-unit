<?php

namespace listaDesafios02\Desafio02;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Root\Www\ListaDesafios02\Desafio02\MyClass;

class MyClassTest extends TestCase
{
    public function testAddMethod()
    {
        $myClass = $this->getMockBuilder(MyClass::class)
            ->onlyMethods(['addMethod'])
            ->getMock();
        $myClass
            ->method('addMethod')
            ->with('nomeDoMetodo')
            ->willReturn(true);
        $this->assertTrue($myClass->addMethod('nomeDoMetodo'));
    }
}