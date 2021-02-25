<?php

    $banco = trim($_POST['banco']);
    $usuario = trim($_POST['usuario']) == "" ? "root" : trim($_POST['usuario']);
    $senha = trim($_POST['senha']);
    $path = trim($_POST['path']) == "" ? "C:\\" : trim($_POST['path']);

    $newJson = [
        "banco" => $banco,
        "usuario" => $usuario,
        "senha" => $senha,
        "path" => $path,
    ];

    $newJsonEncoded = json_encode($newJson);

    $path = '../informacoes-acesso.json';
    unlink($path);
    $json = fopen($path, 'w');
    fwrite($json, $newJsonEncoded);
    fclose($json);

    header('Location: '.$_SERVER['HTTP_REFERER']);

?>