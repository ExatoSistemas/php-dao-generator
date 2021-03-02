<?php
    require_once("../classes/ConectaBd.php");
    include_once("../classes/functions.php");

    $gerarDaoPrincipal = isset($_POST['gerarDaoPrincipal']);
    $gerarService = isset($_POST['gerarService']);
    $numTables = $_POST['numTables'];

    $conectaBd = new ConectaBD(file_get_contents("..\informacoes-acesso.json"));
    $informacoesAcessoJson = json_decode(file_get_contents("..\informacoes-acesso.json"));

    // Gerar Dao principal
    if($gerarDaoPrincipal){
        createDao(
            $informacoesAcessoJson->path,
            $informacoesAcessoJson->banco,
            $informacoesAcessoJson->usuario,
            $informacoesAcessoJson->senha
        );
    }

    // Gerar generics
    for($table = 1; $table <= $numTables; $table++){
        if(isset($_POST['tbl'.$table])){
            $currentTable = $_POST['tbl'.$table];

            createGenericDao(
                $informacoesAcessoJson->path,
                $currentTable,
                $conectaBd->getAllColumnsFromTable($currentTable)
            );

            if($gerarService){
                createServiceDao(
                    $informacoesAcessoJson->path,
                    $currentTable
                );
            }

        }
    }

    header('Location: '.$_SERVER['HTTP_REFERER']);
?>