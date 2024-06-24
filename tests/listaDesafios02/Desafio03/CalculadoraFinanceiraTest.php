<?php

namespace listaDesafios02\Desafio03;

use PHPUnit\Framework\TestCase;
use Root\Www\ListaDesafios02\Desafio03\CalculadoraFinanceira;

class CalculadoraFinanceiraTest extends TestCase
{
    private CalculadoraFinanceira $calculadoraFinanceira;

    protected function setUp(): void
    {
        $this->calculadoraFinanceira = new CalculadoraFinanceira();
    }

    public function testJurosSimplesValido()
    {
        $retorno = $this->calculadoraFinanceira->jurosSimples(1000, 1, 10);
        $this->assertEquals(100, $retorno);
    }

    public function testJurosCompostosValido()
    {
        $retorno = $this->calculadoraFinanceira->jurosCompostos(1000, 1, 10);
        $this->assertEquals(104.62, $retorno);
    }

    public function testAmortizacaoSACValido()
    {
        $retorno = $this->calculadoraFinanceira->calcularAmortizacao(60000, 5.8, 6, 'SAC');
        $controle = ['valor_amortizacao' => 10000, 'totalJuros' => 12180];
        $this->assertEquals($controle, $retorno);
    }

    public function testAmortizacaoPriceValido()
    {
        $retorno = $this->calculadoraFinanceira->calcularAmortizacao(60000, 5.8, 6, 'PRICE');
        $totalAmortizacao = 59999.99;
        $totalRetorno = 0;
        foreach ($retorno['parcelas_amortizacao'] as $parcela) {
            $totalRetorno += $parcela;
        }
        $this->assertEquals($totalAmortizacao, round($totalRetorno, 2));
        $this->assertEquals(12751.14, $retorno['totalJuros']);
    }
}