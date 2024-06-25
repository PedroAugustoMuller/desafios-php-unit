<?php

namespace listaDesafios02\Desafio02;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Root\Www\ListaDesafios02\Desafio02\MyClass;

class MyClassTest extends TestCase
{
    public function testAddMethod()
    {
        $myClass = $this->getMockBuilder(MyClass::class)->disableOriginalConstructor()->getMock();
        $myClass->method("addMethod")->with('novoMetodo')->willReturn(true);
        $this->assertTrue($myClass->addMethod('novoMetodo'));
    }
    public function testSetConstructorArgs()
    {
        $myClass = $this->getMockBuilder(MyClass::class)
            ->setConstructorArgs([['methods']])
            ->getMock();
        $myClass->method('addMethod')->willReturn(true);
        $this->assertTrue($myClass->addMethod('teste'));
    }
    public function testSetMockClassName()
    {
        $myClass = $this->getMockBuilder(MyClass::class)->disableOriginalConstructor()->getMock();
        $myClass->method("setMockClassName")->with('novoNome')->willReturn('novoNome');
        $this->assertEquals('novoNome',$myClass->setMockClassName('novoNome'));
    }
    public function testDisableOriginalConstructor()
    {
        $myClass = $this->getMockBuilder(MyClass::class)->disableOriginalConstructor()->getMock();
        $myClass->method("disableOriginalConstructor")->willReturn(false);
        $this->assertFalse($myClass->disableOriginalConstructor());
    }
    public function testDisableOriginalClone()
    {
        $myClass = $this->getMockBuilder(MyClass::class)->disableOriginalConstructor()->getMock();
        $myClass->method("disableOriginalClone")->willReturn(false);
        $this->assertFalse($myClass->disableOriginalClone());
    }
    public function testDisableAutoload()
    {
        $myClass = $this->getMockBuilder(MyClass::class)->disableOriginalConstructor()->getMock();
        $myClass->method("disableAutoload")->willReturn(false);
        $this->assertFalse($myClass->disableAutoload());
    }
    public function testMethodWillReturn10()
    {
        $myClass = $this->getMockBuilder(MyClass::class)->disableOriginalConstructor()->getMock();
        $myClass->method("methodWillReturn10")->willReturn(10);
        $this->assertEquals(10,$myClass->methodWillReturn10());
    }
    public function testMethodWillReturnSelf()
    {
        $myClass = $this->getMockBuilder(MyClass::class)->disableOriginalConstructor()->getMock();
        $myClass->method("methodWillReturnSelf")->willReturnSelf();
        $this->assertSame($myClass,$myClass->methodWillReturnSelf());
    }
}