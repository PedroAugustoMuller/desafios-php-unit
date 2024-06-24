<?php

namespace Root\Www\ListaDesafios02\Desafio04;
class CepApiExample
{
    private string $url = 'viacep.com.br/ws/';
    private string $formato = '/json/';

    public function getCepData(string $cep)
    {
        $curl = curl_init($this->url . $cep . $this->formato);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($curl);
        curl_close($curl);
        var_dump($json);
        //return json_decode($json, true);
    }
}