<?php

namespace listaDesafios02\Desafio04;

use PHPUnit\Framework\TestCase;
use Root\Www\ListaDesafios02\Desafio04\CepApi;

class CepApiTest extends TestCase
{
    private CepApi $cepApi;

    protected function setUp(): void
    {
        $this->cepApi = new CepApi();
    }

    public function testCepValido()
    {
        $dadosUniversitario = ['cep' => '96815-710',
            'logradouro' => 'Rua Vinte e Oito de Outubro',
            'complemento' => '',
            'unidade' => '',
            'bairro' => 'Universitário',
            'localidade' => 'Santa Cruz do Sul',
            'uf'=> 'RS',
            'ibge'=>'4316808',
            'gia'=>'',
            'ddd'=>'51',
            'siafi'=>'8839'];
        $retorno = $this->cepApi->getAddressByCep('96815710');
        $this->assertEquals($dadosUniversitario, $retorno);
    }
    public function testCepInvalido()
    {
        $retorno = $this->cepApi->getAddressByCep('00000000');
        $this->assertArrayHasKey('erro',$retorno);
    }
}