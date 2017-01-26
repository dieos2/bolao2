<?php

namespace app\models;

use Yii;
use app\models;

class Setup extends \yii\db\ActiveRecord {

    const DATE_FORMAT = 'php:Y-m-d';
    const DATETIME_FORMAT = 'php:Y-m-d H:i:s';
    const TIME_FORMAT = 'php:H:i:s';

    public static function AntesDeSalvar($dateStr, $type = 'date', $format = null) {

        if ($dateStr != '1970-01-01 00:00:00' && $dateStr != '') {
            $parts = explode('/', $dateStr);
            $dateStr = $parts[2] . '-' . $parts[1] . '-' . $parts[0];
            if ($type === 'datetime') {
                $fmt = ($format == null) ? self::DATETIME_FORMAT : $format;
            } elseif ($type === 'time') {
                $fmt = ($format == null) ? self::TIME_FORMAT : $format;
            } else {
                $fmt = ($format == null) ? self::DATE_FORMAT : $format;
            }
            return \Yii::$app->formatter->asDate($dateStr, $fmt);
        } else {
            return $dateStr = '';
        }
    }

    const DATE_FORMATD = 'php:d/m/Y';
    const DATETIME_FORMATD = 'php:d/m/Y H:i:s';
    const TIME_FORMATD = 'php:H:i:s';

    public static function DepoisDePegar($dateStr, $type = 'date', $format = null) {
        if ($dateStr != '1970-01-01 00:00:00' && $dateStr != '') {
            if ($type === 'datetime') {
                $fmt = ($format == null) ? self::DATETIME_FORMATD : $format;
            } elseif ($type === 'time') {
                $fmt = ($format == null) ? self::TIME_FORMATD : $format;
            } else {
                $fmt = ($format == null) ? self::DATE_FORMATD : $format;
            }
            return \Yii::$app->formatter->asDate($dateStr, $fmt);
        } else {
            return $dateStr = '';
        }
    }

    public static function ExtraiMes($dateStr, $type = 'date', $format = null) {

        if ($dateStr != '1970-01-01 00:00:00' && $dateStr != '') {
            $parts = explode('-', $dateStr);
            $dateStr = $parts[1];

            return $dateStr;
        } else {
            return $dateStr = '';
        }
    }

    public static function ExtraiAno($dateStr, $type = 'date', $format = null) {

        if ($dateStr != '1970-01-01 00:00:00' && $dateStr != '') {
            $parts = explode('-', $dateStr);
            $dateStr = $parts[0];

            return $dateStr;
        } else {
            return $dateStr = '';
        }
    }

    public static function ExtraiDia($dateStr, $type = 'date', $format = null) {

        if ($dateStr != '1970-01-01 00:00:00' && $dateStr != '') {
            $parts = explode('-', $dateStr);
            $dateStr = $parts[2];

            return $dateStr;
        } else {
            return $dateStr = '';
        }
    }

    public static function AtualizaAluguel() {
        $teste = "-";
        $contratos = models\Contrato::getAtivos();
        foreach ($contratos as $item) {
            $contrato = models\Contrato::findOne($item->id);

            if (\app\models\Despesa::verificaAluguel($contrato->id)) {

                $despesa = \app\models\Despesa::verificaAluguel($contrato->id);

                if (Setup::VerificaDia($despesa->data)) {
                    $aluguel = models\Despesa::LancaAluguel(Setup::VerificaDia($despesa->data), $contrato->id);
                }
            } else {
                if (Setup::VerificaDia($contrato->data_inicio)) {
                    $aluguel = models\Despesa::LancaAluguel($contrato->data_inicio, $contrato->id);
                }
            }
        }
    }

    public static function VerificaDia($data) {


        if (Setup::TiraADiferenca($data) >= 25) {

            return date('Y-m-d', strtotime("+1 months", strtotime($data)));
        } else {
            return false;
        }
    }

    public static function FormataMoeda($valor) {
        return 'R$ ' . number_format($valor, 2, ",", ".");
    }

    public static function CalculaPorcentagem($porcentagem, $valor) {
        $porcentagem = $porcentagem / 100;
        $valor = $valor * $porcentagem;
        return $valor;
    }

    public static function TiraADiferenca($data) {
        $hoje = date('Y/m/d');
        $data_final = $data;

        // Usa a função strtotime() e pega o timestamp das duas datas:
        $time_inicial = strtotime($hoje);
        $time_final = strtotime($data_final);

        // Calcula a diferença de segundos entre as duas datas:
        $diferenca = $time_inicial - $time_final; // 19522800 segundos
        // Calcula a diferença de dias
        $diferencaEmDias = (int) floor($diferenca / (60 * 60 * 24)); // 225 dias

        return $diferencaEmDias;
    }

    public static function Extenso($valor = 0, $maiusculas = false, $moeda = true) {

        $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
        $plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões",
            "quatrilhões");

        $c = array("", "cem", "duzentos", "trezentos", "quatrocentos",
            "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
        $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta",
            "sessenta", "setenta", "oitenta", "noventa");
        $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze",
            "dezesseis", "dezesete", "dezoito", "dezenove");
        $u = array("", "um", "dois", "três", "quatro", "cinco", "seis",
            "sete", "oito", "nove");

        $z = 0;
        $rt = "";

        $valor = number_format($valor, 2, ".", ".");
        $inteiro = explode(".", $valor);
        for ($i = 0; $i < count($inteiro); $i++)
            for ($ii = strlen($inteiro[$i]); $ii < 3; $ii++)
                $inteiro[$i] = "0" . $inteiro[$i];

        $fim = count($inteiro) - ($inteiro[count($inteiro) - 1] > 0 ? 1 : 2);
        for ($i = 0; $i < count($inteiro); $i++) {
            $valor = $inteiro[$i];
            $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
            $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
            $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

            $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd &&
                    $ru) ? " e " : "") . $ru;
            $t = count($inteiro) - 1 - $i;
            if ($moeda) {
                $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
                if ($valor == "000")
                    $z++;
                elseif ($z > 0)
                    $z--;
                if (($t == 1) && ($z > 0) && ($inteiro[0] > 0))
                    $r .= (($z > 1) ? " de " : "") . $plural[$t];
            }
            if ($r)
                $rt = $rt . ((($i > 0) && ($i <= $fim) &&
                        ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
        }

        if (!$maiusculas) {
            return($rt ? $rt : "zero");
        } else {

            if ($rt)
                $rt = strtoupper($rt);
            return (($rt) ? ($rt) : "Zero");
        }
    }

    const DATE_EXTENSO = 'php:d F Y';

    public static function DataExtenso($dateStr, $comDia = true) {
        if ($dateStr != '1970-01-01 00:00:00' && $dateStr != '') {
            setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            date_default_timezone_set('America/Sao_Paulo');
            if($comDia)
            {
            echo strftime('%d de %B de %Y', strtotime($dateStr));
            }else
            {
                echo strftime('%B / %Y', strtotime($dateStr));
            }
            
        } else {
            return $dateStr = '';
        }
    }
  public static function aasort(&$array, $key) {
        $sorter = array();
        $ret = array();

        foreach ($array as $ii => $va) {
            $sorter[$ii] = $va[$key];
        }
        arsort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii] = $array[$ii];
        }
        $array = $ret;
        return $array;
    }
   
}
