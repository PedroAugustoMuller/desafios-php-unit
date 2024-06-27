<?php

namespace ListaDesafios03\Desafio02;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Root\Www\ListaDesafios03\Desafio02\Cadastro;

class CadastroTest extends TestCase
{
    private Cadastro $cadastroValido;
    protected function setUp(): void
    {
        $this->cadastroValido = new Cadastro('Pedro',
            false,
            '29/09/2004',
            'Masculino',
            '040.842.710-80',
            '+5551999648130',
            'pedro.muller.a@gmail.com');
    }

    public function testCadastroValido()
    {
        $this->cadastroValido = new Cadastro('Pedro',
            false,
            '29/09/2004',
            'Masculino',
            '040.842.710-80',
            '+5551999648130',
            'pedro.muller.a@gmail.com');
        $this->assertInstanceOf(Cadastro::class, $this->cadastroValido);
    }
    public function testCadastroDataDeNascimentoInvalida()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Formado da data inválido - Formato Desejado: dddd/mm/YYYY');
        $cadastro = new Cadastro('Pedro',
            false,
            '29/13/2004',
            'Masculino',
            '040.842.710-80',
            '+5551999648130',
            'pedro.muller.a@gmail.com');
    }
    public function testCadastroCpfInvalido()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Formato de CPF inválido - Formato Desejado: XXX.XXX.XXX-XX');
        $this->cadastroValido = new Cadastro('Pedro',
            false,
            '29/09/2004',
            'Masculino',
            '040.842.710-AA',
            '+5551999648130',
            'pedro.muller.a@gmail.com');
    }
    public function testCadastroTelefoneInvalido()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Formato de Telefone Inválido - Formato Desejado: +55XXXXXXXXX');
        $this->cadastroValido = new Cadastro('Pedro',
            false,
            '29/09/2004',
            'Masculino',
            '040.842.710-80',
            '+55999648130',
            'pedro.muller.a@gmail.com');
    }
    public function testCadastroEmailInvalido()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Email Inválido');
        $this->cadastroValido = new Cadastro('Pedro',
            false,
            '29/09/2004',
            'Masculino',
            '040.842.710-80',
            '+5551999648130',
            'pedro.muller.agmail.com');
    }
    public function testCadastroSetPasswordValido()
    {
        $this->assertTrue($this->cadastroValido->setPassword('123456','123456'));
    }
    public function testCadastroSetPasswordInvalido()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Senhas não coincidem');
        $this->cadastroValido->setPassword('123456','123');
    }
    public function testCadastroValidoGetters()
    {
        $this->cadastroValido = new Cadastro('Pedro',
            false,
            '29/09/2004',
            'Masculino',
            '040.842.710-80',
            '+5551999648130',
            'pedro.muller.a@gmail.com');
        $this->assertInstanceOf(Cadastro::class, $this->cadastroValido);
        $this->assertStringContainsString('Pedro',$this->cadastroValido->getFullName());
        $this->assertFalse($this->cadastroValido->getIsForeing());
        $this->assertEquals('29/09/2004',$this->cadastroValido->getBirthDate()->format('d/m/Y'));
        $this->assertEquals('Masculino',$this->cadastroValido->getGender());
        $this->assertEquals('040.842.710-80',$this->cadastroValido->getCpf());
        $this->assertEquals('+5551999648130', $this->cadastroValido->getPhoneNumber());
        $this->assertEquals('pedro.muller.a@gmail.com',$this->cadastroValido->getEmail());
        $this->assertEquals('Ainda não existe',$this->cadastroValido->getPassword());
        $this->cadastroValido->setPassword('123456','123456');
        $this->assertEquals('123456',$this->cadastroValido->getPassword());
    }
}