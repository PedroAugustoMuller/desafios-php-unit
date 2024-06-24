<?php

namespace Root\Www\ListaDesafios02\Desafio03;

class CalculadoraFinanceira
{
    public function jurosSimples($capital,$taxa,$parcelas)
    {
        return $this->validarDados([$capital,$taxa,$parcelas]) ? $capital*($taxa/100)*$parcelas : 'Valores informados não são numéricos';
    }
    public function jurosCompostos($capital,$taxa,$parcelas)
    {
        return $this->validarDados([$capital,$taxa,$parcelas]) ? round($capital*(1+($taxa/100))**$parcelas-$capital,2) : 'Valores informados não são numéricos';
    }
    public function calcularAmortizacao($capital,$taxa,$parcelas,$tipo)
    {
        if(!$this->validarDados([$capital,$taxa,$parcelas]))
        {
            return 'Valores informados não são numéricos';
        }
        if($tipo == 'SAC')//SAC
        {
            $valorAmortizacao = $capital/$parcelas;
            $totalJuros = 0;
            for ($i = 0; $i < $parcelas; $i++) {
                $juros = $capital * ($taxa / 100);
                $totalJuros += $juros;
                $capital -= $valorAmortizacao;
            }
            $amortizacao = ['valor_amortizacao'=>$valorAmortizacao,'totalJuros'=>$totalJuros];
            return $amortizacao;
        }else if ($tipo == 'PRICE')
        {
            $prestacao = round($capital*(((1+$taxa/100)**$parcelas)*($taxa/100))/(((1+($taxa/100))**$parcelas)-1),2);
            $totalJuros = 0;
            $parcelasAmortizacao = array();
            for ($i = 0; $i < $parcelas; $i++){
                $juros = $capital * ($taxa / 100);
                $parcelasAmortizacao[$i] = $prestacao - $juros;
                $totalJuros += $juros;
                $capital -= $parcelasAmortizacao[$i];
                $parcelasAmortizacao[$i] = round($parcelasAmortizacao[$i],2);
            }
            $totalJuros = round($totalJuros,2);
            $amortizacao = ['parcelas_amortizacao'=>$parcelasAmortizacao,'totalJuros'=>$totalJuros];
            return $amortizacao;
        }
        return 'Tipo Inválido';

    }

    public function validarDados(array $dados): bool
    {
        foreach($dados as $dado)
        {
            if (!is_numeric($dado))
            {
                return false;
            }
        }
        return true;
    }
}