<?php

require("../../def/function.php");

$nomelivro = $_GET["nomelivro"];
$biblioteca = $_GET["biblioteca"];
$preco = $_GET["preco"];

$preco = value_number($preco);

$connection = connection();

$result = $connection->query("SELECT MAX(idlivro) FROM livro");
$idlivro = $result->fetchColumn() + 1;

$result = $connection->query("INSERT INTO livro (idlivro, nome, preco, idbiblioteca) VALUES ({$idlivro}, '{$nomelivro}', {$preco}, {$biblioteca})");
if($result === false){
    $erro = $connection->errorInfo();
    json_error($erro[2]);
}

json_success(array(
    "idlivro" => $idlivro
));