<?php

class ConectaBD {
    private $conexao;

    function __construct($informacoesAcessoContent){
        $informacoesAcesso = json_decode($informacoesAcessoContent);

        $hostname = "localhost";
        $banco = $informacoesAcesso->banco;
        $username = $informacoesAcesso->usuario;
        $senha = $informacoesAcesso->senha;
        $conexao = mysqli_connect($hostname, $username, $senha, $banco);
        if(!$conexao) {
            die("Falha na conexão: " . mysqli_connect_error());
        } else {
            $this->conexao = $conexao;
        }
    }

    function sql($sql){
        return mysqli_query($this->conexao, $sql);
    }

    function getAllTables(){
        $sqlSelect = $this->sql("SHOW TABLES");
        $tables = array();
        while($tbl = mysqli_fetch_array($sqlSelect)){
            array_push($tables, $tbl[0]);
        }
        return $tables;
    }

    function getAllColumnsFromTable($table){
        $sqlSelect = $this->sql("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$table'");
        $columns = array();
        while($col = mysqli_fetch_array($sqlSelect)){
            array_push($columns, $col[0]);
        }
        return $columns;
    }

}

?>