<?php

namespace Root\Www\ListaDesafios02\Desafio02;

class MyClass
{
    private array $methods;
    private $mockClassName;
    private $disableOriginalConstructor;
    private $disableOriginalClone;
    private $disableAutoload;
    public function __construct($methods)
    {
        $this->methods = $methods;
    }

    public function addMethod($method)
    {
        $this->methods[] = $method;
        return $this->methods;
    }
    public function setMockClassName($mockClassName)
    {
        $this->mockClassName = $mockClassName;
        return $this->mockClassName;
    }
    public function disableOriginalConstructor()
    {
        $this->disableOriginalConstructor = false;
        return $this->disableOriginalConstructor;
    }
    public function disableOriginalClone()
    {
        $this->disableOriginalClone = false;
        return $this->disableOriginalClone();
    }
    public function disableAutoload()
    {
        $this->disableAutoload = false;
        return $this->disableAutoload;
    }
    public function methodWillReturn10()
    {
        return 10;
    }
    public function methodWillReturnSelf()
    {
        return self::class;
    }
}