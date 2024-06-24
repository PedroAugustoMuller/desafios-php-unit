<?php

namespace Root\Www\ListaDesafios02\Desafio03;

class CalculadoraFinanceira
{
    public function jurosSimples($capital,$taxa,$parcelas)
    {
        return $this->validarDados([$capital,$taxa,$parcelas]) ? $capital*$taxa*$parcelas : 'Valores informados não são numéricos';
    }
    public function jurosCompostos($capital,$taxa,$parcelas)
    {
        return $this->validarDados([$capital,$taxa,$parcelas]) ? $capital*(1+($taxa/100))^$parcelas : 'Valores informados não são numéricos';
    }
    public function calcularAmortizacao($capital,$taxa,$parcelas,$tipo)
    {
        if(!$this->validarDados([$capital,$taxa,$parcelas]))
        {
            return 'Valores informados não são numéricos';
        }
        if($tipo == 'SAC')//SAC
        {
            $amortizacao['valor_amortizacao'] = $capital/$parcelas;
            $amortizacao['juros_primeira_parcela'] = $capital*$taxa;
            $amortizacao['taxa_de_reducao'] = $amortizacao['amortizacao']*$taxa;
            $amortizacao['juros_ultima_parcela'] = $amortizacao['juros_primeira_parcela'] - ($parcelas*$amortizacao['taxa_de_reducao']);
            return $amortizacao;
        }else if ($tipo == 'PRICE')
        {
            $amortizacao['prestacao'] = $capital*(((1+$taxa)^$parcelas)*$taxa)/(((1+$taxa)^$parcelas)-1);
            $amortizacao['amortizacao_primeira_parcela'] = $amortizacao['prestacao'] - ($taxa*$capital);
            $amortizacao['amortizacao_ultima_arcela'] = $amortizacao['prestacao'] - ($amortizacao['prestacao']/$parcelas);
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