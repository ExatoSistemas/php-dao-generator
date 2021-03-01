<?php

/** Converte uma string que separa palavras_com_underline para o padrão camelCase com a primeira letra minuscula */
function underlineToCamelDown($word){
    $wordArray = explode("_", $word);
    $wordCamel = "";

    for($singleWord = 0; $singleWord < count($wordArray); $singleWord++){
        if($singleWord == 0){
            $wordCamel .= strtolower($wordArray[$singleWord]);
        } else {
            $wordCamel .= ucfirst(strtolower($wordArray[$singleWord]));
        }
    }

    return $wordCamel;
}

/** Converte uma string que separa palavras_com_underline para o padrão camelCase com a primeira letra maiuscula */
function underlineToCamelUp($word){
    $wordArray = explode("_", $word);
    $wordCamel = "";

    for($singleWord = 0; $singleWord < count($wordArray); $singleWord++){
        $wordCamel .= ucfirst(strtolower($wordArray[$singleWord]));
    }

    return $wordCamel;
}

function createDao($path, $banco, $username, $senha, $hostname = "localhost"){
    $code =
'<?php
    class Dao {
        private $conexao;

        function __construct(){
            $hostname = "'.$hostname.'";
            $banco = "'.$banco.'";
            $username = "'.$username.'";
            $senha = "'.$senha.'";
            $conexao = mysqli_connect($hostname, $username, $senha, $banco);
            if(!$conexao) {
                die("Falha na conexão: " . mysqli_connect_error());
            } else {
                $this->conexao = $conexao;
            }
        }

        protected function sql($sql){
            return mysqli_query($this->conexao, $sql);
        }
    }
?>';

    $arquivoPath = $path."\Dao.php";
    if(file_exists($arquivoPath)) unlink($arquivoPath);
    $arquivo = fopen($arquivoPath, "w");
    fwrite($arquivo, $code);
    fclose($arquivo);
}

function createGenericDao($path, $table, $columns){
    $code =
'<?php
    require_once("Dao.php");

    class Dao'.underlineToCamelUp($table).'Generic extends Dao{
        private $cod;
        private $name;
        private $passWord;

        // The functions

    }
?>';

    $arquivoPath = $path."\Dao".underlineToCamelUp($table)."Generic.php";
    if(file_exists($arquivoPath)) unlink($arquivoPath);
    $arquivo = fopen($arquivoPath, "w");
    fwrite($arquivo, $code);
    fclose($arquivo);
}

function createServiceDao($path, $table){
    $code =
'<?php
    require_once("Dao.php");

    class Dao'.underlineToCamelUp($table).'Service extends Dao{
        private $cod;
        private $name;
        private $passWord;

        // The functions

    }
?>';

    $arquivoPath = $path."\Dao".underlineToCamelUp($table)."Service.php";
    if(file_exists($arquivoPath)) unlink($arquivoPath);
    $arquivo = fopen($arquivoPath, "w");
    fwrite($arquivo, $code);
    fclose($arquivo);
}

?>