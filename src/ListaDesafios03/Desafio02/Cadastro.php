<?php

namespace Root\Www\ListaDesafios03\Desafio02;

use DateTime;
use InvalidArgumentException;

class Cadastro
{
    private string $fullName;
    private bool $isForeing;
    private DateTime $birthDate;
    private string $gender;
    private string $cpf;
    private string $phoneNumber;
    private string $email;
    private string $password = 'Ainda não existe';
    private string $confirmPassword = 'Ainda não existe';

    /**
     * @param string $fullName
     * @param bool $isForeing
     * @param string $birthDate
     * @param string $gender
     * @param string $cpf
     * @param string $phoneNumber
     * @param string $email
     */
    public function __construct(string $fullName, bool $isForeing, string $birthDate, string $gender, string $cpf, string $phoneNumber, string $email)
    {
        $this->validateCadastro($fullName, $isForeing, $birthDate, $gender, $cpf, $phoneNumber, $email);
    }

    public function validateCadastro($fullName, $isForeing, $birthDate, $gender, $cpf, $phoneNumber, $email)
    {
        $birthDate = $this->validateBirthDate($birthDate);
        $cpf = $this->validateCPF($cpf);
        $phoneNumber = $this->validatePhoneNumber($phoneNumber);
        if (!$birthDate) {
            throw new InvalidArgumentException('Formado da data inválido - Formato Desejado: dddd/mm/YYYY');
        }
        if (!$cpf) {
            throw new InvalidArgumentException('Formato de CPF inválido - Formato Desejado: XXX.XXX.XXX-XX');
        }
        if (!$phoneNumber) {
            throw new InvalidArgumentException('Formato de Telefone Inválido - Formato Desejado: +55XXXXXXXXX');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email Inválido');
        }
        $this->fullName = $fullName;
        $this->isForeing = $isForeing;
        $this->birthDate = $birthDate;
        $this->gender = $gender;
        $this->cpf = $cpf;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        return true;
    }

    public function validatePhoneNumber($phoneNumber)
    {
        if (!preg_match('/^\+55\d{2}9\d{8}$/', $phoneNumber)) {
            return false;
        }
        return $phoneNumber;
    }

    public function validateBirthDate($birthDate)
    {
        $format = 'd/m/Y';
        $dateTimeObject = DateTime::createFromFormat($format, $birthDate);
        if (!$dateTimeObject || $dateTimeObject->format($format) != $birthDate) {
            return false;
        }
        return $dateTimeObject;
    }

    public function validateCPF($cpf)
    {
        if (!preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $cpf)) {
            return false;
        }
        $cpfValido = $cpf;
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        if (strlen($cpf) != 11) {
            return false;
        }
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += intval($cpf[$i]) * (10 - $i);
        }
        $remainder = $sum % 11;
        $digit1 = ($remainder < 2) ? 0 : (11 - $remainder);
        if (intval($cpf[9]) !== $digit1) {
            return false;
        }
        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += intval($cpf[$i]) * (11 - $i);
        }
        $remainder = $sum % 11;
        $digit2 = ($remainder < 2) ? 0 : (11 - $remainder);
        if (intval($cpf[10]) !== $digit2) {
            return false;
        }
        return $cpfValido;
    }

    public function setPassword($password, $confirmPassword)
    {
        if ($password != $confirmPassword) {
            throw new InvalidArgumentException('Senhas não coincidem');
        }
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        return true;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getIsForeing(): bool
    {
        return $this->isForeing;
    }

    public function getBirthDate(): DateTime
    {
        return $this->birthDate;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getConfirmPassword(): string
    {
        return $this->confirmPassword;
    }
}