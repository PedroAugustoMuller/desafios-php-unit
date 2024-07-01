<?php

namespace Src\Desafio02;

class StringManipulator
{
    public function capitalizeString(string $string)
    {
        if(empty($string))
        {
            return $string;
        }
        return mb_strtoupper($string);
    }
    public function concatenateString(string $primeiraString, string $segundaString)
    {
        if(empty($primeiraString) && empty($segundaString))
        {
            return '';
        }
        return "$primeiraString $segundaString";
    }
    public function countVowels(string $string)
    {
        preg_match_all('/([aeiou])/i',$string,$matches);
        return $matches[0];
    }
}