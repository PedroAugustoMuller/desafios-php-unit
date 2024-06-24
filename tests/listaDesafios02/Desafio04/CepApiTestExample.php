<?php

namespace listaDesafios02\Desafio04;

use PHPUnit\Framework\TestCase;
use Root\Www\ListaDesafios02\Desafio04\CepApi;


class CepApiTestExample extends TestCase
{
    private CepApi $cepApi;

    protected function setUp(): void
    {
        $this->cepApi = new CepApi();
    }

    public function testCepValido()
    {
        $this->cepApi->getCepData('96815710');
    }
}