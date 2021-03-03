<?php
date_default_timezone_set('America/Sao_Paulo');

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

    // Data em que foi gerado: '.date('d/m/Y - H:i:s').'

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

    // Data em que foi gerado: '.date('d/m/Y - H:i:s').'

    require_once("Dao.php");

    class Dao'.underlineToCamelUp($table)."Generic extends Dao{\n\n";

    // Adiciona atributos
    foreach($columns as $col){
        $code .= '        private $'.underlineToCamelDown($col).";\n";
    }

    // Adiciona getters
    $code .= "\n        /* Getters */\n";
    foreach($columns as $col){
        $code .= '        protected function get'.underlineToCamelUp($col).'(){ return $this->'.underlineToCamelDown($col)."; }\n";
    }

    // Adiciona setters
    $code .= "\n        /* Setters */\n";
    foreach($columns as $col){
        $code .= '        protected function set'.underlineToCamelUp($col).'($param){ $this->'.underlineToCamelDown($col).' = $param; }'."\n";
    }

    // Adiciona finds
    $code .= "\n        /* Finds */";
    foreach($columns as $col){
        $code .= '
        public function findBy'.underlineToCamelUp($col).'($param){
            $sql = $this->sql("SELECT * FROM '.$table.' WHERE '.$col.' = '."'".'$param'."'".'");
            if($select = mysqli_fetch_array($sql)){
                return ['."\n";


                foreach($columns as $column){
                    $code .= '                    "'.$column.'" => $select['."'".$column."'".'],'."\n";
                }


        $code .= '                ];
            } else {
                return false;
            }
        }
        ';
    }

    // Adiciona FindAlls
    $code .= "\n        /* FindAlls */";
    foreach($columns as $col){
        $code .= '
        public function findAllBy'.underlineToCamelUp($col).'($param){
            $sql = $this->sql("SELECT * FROM '.$table.' WHERE '.$col.' = '."'".'$param'."'".'");
            $response = [];
            while($select = mysqli_fetch_array($sql)){
                array_push($response, ['."\n";

                foreach($columns as $column){
                    $code .= '                    "'.$column.'" => $select['."'".$column."'".'],'."\n";
                }

        $code .= '
                ]);
            }

            return $response;
        }
        ';
    }

    $code .='

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

    // Data em que foi gerado: '.date('d/m/Y - H:i:s').'

    require_once("Dao'.underlineToCamelUp($table).'Generic.php");

    class Dao'.underlineToCamelUp($table).'Service extends Dao'.underlineToCamelUp($table).'Generic{

        // Custom functions here

    }
?>';

    $arquivoPath = $path."\Dao".underlineToCamelUp($table)."Service.php";
    if(!file_exists($arquivoPath)){
        $arquivo = fopen($arquivoPath, "w");
        fwrite($arquivo, $code);
        fclose($arquivo);
    }
}
