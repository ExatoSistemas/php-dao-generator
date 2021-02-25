<?php
    require_once("../classes/ConectaBd.php");

    $gerarDaoPrincipal = isset($_POST['gerarDaoPrincipal']);
    $gerarServer = isset($_POST['gerarServer']);
    $numTables = $_POST['numTables'];

    $conectaBd = new ConectaBD(file_get_contents("..\informacoes-acesso.json"));

    for($table = 1; $table <= $numTables; $table++){
        if(isset($_POST['tbl'.$table])){
            $currentTable = $_POST['tbl'.$table];

            var_dump($conectaBd->getAllColumnsFromTable($currentTable));

        }
    }


?>