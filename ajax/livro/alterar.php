<?php

require("../../def/function.php");

$idlivro = $_GET["idlivro"];
$nomelivro = $_GET["nomelivro"];
$biblioteca = $_GET["biblioteca"];
$preco = $_GET["preco"];

$preco = value_number($preco);

$connection = connection();
$result = $connection->query("UPDATE livro SET nome = '{$nomelivro}', idbiblioteca = '{$biblioteca}', preco = '{$preco}' WHERE idlivro = {$idlivro}");

if ($result) {
    json_success(["idlivro" => $idlivro]);
} else {
    $erro = $connection->errorInfo();
    json_error($erro[2]);  
}
