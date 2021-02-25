<?php

    $banco = trim($_POST['banco']);
    $usuario = trim($_POST['usuario']) == "" ? "root" : trim($_POST['usuario']);
    $senha = trim($_POST['senha']);

    $newJson = [
        "banco" => $banco,
        "usuario" => $usuario,
        "senha" => $senha,
    ];

    $newJsonEncoded = json_encode($newJson);

    $path = '../informacoes-acesso.json';
    unlink($path);
    $json = fopen($path, 'w');
    fwrite($json, $newJsonEncoded);
    fclose($json);

    header('Location: '.$_SERVER['HTTP_REFERER']);

?>