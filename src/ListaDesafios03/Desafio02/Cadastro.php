<?php

namespace Root\Www\ListaDesafios03\Desafio02;

use DateTime;
use http\Exception\InvalidArgumentException;

class Cadastro
{
    private string $fullName;
    private bool $isForeing;
    private DateTime $birthDate;
    private string $gender;
    private string $cpf;
    private string $phoneNumber;
    private string $email;
    private string $password;
    private string $confirmPassword;

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
            return $this->validateCadastro($fullName,$isForeing, $birthDate, $gender, $cpf, $phoneNumber, $email);
    }
    public function validateCadastro($fullName,$isForeing, $birthDate, $gender, $cpf, $phoneNumber, $email): bool
    {
        $birthDate = $this->validateBirthDate($birthDate);
        $cpf = $this->validateCPF($cpf);
        $phoneNumber = $this->validatePhoneNumber($phoneNumber);
        if(!$birthDate)
        {
            throw new InvalidArgumentException('Formado da data inválido - Formato Desejado: dddd/mm/YYYY');
        }
        if(!$cpf)
        {
            throw new InvalidArgumentException('Formato de CPF inválido - Formato Desejado: XXX.XXX.XXX-XX');
        }
        if (!$phoneNumber)
        {
            throw new InvalidArgumentException('Formato de Telefone Inválido - Formato Desejado: +55XXXXXXXXX');
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
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
        if(!preg_match('/^\+55[1-9]\d{10}$/', $phoneNumber))
        {
            return false;
        }
        return $phoneNumber;
    }
    public function validateBirthDate($birthDate)
    {
        $format =  'd/m/Y';
        $dateTimeObject = DateTime::createFromFormat($birthDate,$format);
        if(!$dateTimeObject || $dateTimeObject->format($format) != $birthDate)
        {
            return false;
        }
        return $dateTimeObject;
    }
    public function validateCPF($cpf)
    {
        $cpf = preg_replace('/\D/', '', $cpf);
        if (!preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $cpf))
        {
            return false;
        }
        return $cpf;
    }
    public function setPassword($password, $confirmPassword)
    {
        if($password != $confirmPassword)
        {
            throw new InvalidArgumentException('Senhas não coincidem');
        }
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }
}