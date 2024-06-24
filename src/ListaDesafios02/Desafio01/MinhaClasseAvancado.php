<?php

namespace Root\Www\ListaDesafios02\Desafio01;
class MinhaClasseAvancado
{
    public function somar($valor1,$valor2)
    {
        return $this->validar([$valor1,$valor2]) ? $valor1 + $valor2 : "Valores informados não são numéricos";
    }
    public function subtracao($minuendo, $subtraendo)
    {
        return $this->validar([$minuendo,$subtraendo]) ? $minuendo - $subtraendo : "Valores informados não são numéricos";
    }
    private function validar(array $valores): bool
    {
        foreach($valores as $valor)
        {
            if(!is_numeric($valor))
            {
                return false;
            }
        }
        return true;
    }
}