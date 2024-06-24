<?php

namespace listaDesafios02\Desafio01;

use PHPUnit\Framework\TestCase;
use Root\Www\ListaDesafios02\Desafio01\MinhaClasseAvancado;

class MinhaClasseAvancadoTest extends TestCase
{
    private MinhaClasseAvancado $minhaClasseAvancado;

    protected function setUp(): void
    {
        $this->minhaClasseAvancado = new MinhaClasseAvancado();
    }

    public function testSomaValida()
    {
        $resultado = $this->minhaClasseAvancado->somar(1, 2);
        $this->assertEquals(3, $resultado);
    }

    public function testSomaNumeroNulo()
    {
        $resultado = $this->minhaClasseAvancado->somar(-1, 0);
        $this->assertEquals(-1, $resultado);
    }

    public function testSomaDecimal()
    {
        $resultado = $this->minhaClasseAvancado->somar(1.5, 2.5);
        $this->assertEquals(4, $resultado);
    }

    public function testSomaStringValida()
    {
        $resultado = $this->minhaClasseAvancado->somar('-1', '4');
        $this->assertEquals(3, $resultado);
    }

    public function testSomaStringInvalida()
    {
        $resultado = $this->minhaClasseAvancado->somar('Pedro', 'PHP');
        $this->assertStringContainsString('Valores informados não são numéricos', $resultado);
    }

    public function testSubtracaoValida()
    {
        $resultado = $this->minhaClasseAvancado->subtracao(3, 1);
        $this->assertEquals(2, $resultado);
    }

    public function testSubtracaoNumeroNulo()
    {
        $resultado = $this->minhaClasseAvancado->subtracao(-3, 0);
        $this->assertEquals(-3, $resultado);
    }

    public function testSubtracaoDecimal()
    {
        $resultado = $this->minhaClasseAvancado->subtracao(3.5, 2.5);
        $this->assertEquals(1, $resultado);
    }

    public function testSubtracaoStringValida()
    {
        $resultado = $this->minhaClasseAvancado->subtracao('1', '1');
        $this->assertEquals(0, $resultado);
    }

    public function testSubtracaoStringInvalida()
    {
        $resultado = $this->minhaClasseAvancado->subtracao('Pedro', 'PHP');
        $this->assertStringContainsString('Valores informados não são numéricos', $resultado);
    }
    public function testSubtracaoNegativa()
    {
        $resutaldo = $this->minhaClasseAvancado->subtracao(1,-1);
        $this->assertEquals(2,$resutaldo);
    }
}