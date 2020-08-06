<?php

require("../../def/function.php");

$idlivro = $_GET["idlivro"];

$connection = connection();
$result = $connection->query("SELECT* FROM livro WHERE idlivro = {$idlivro}");
$arr = $result->fetchAll(2);
if(count($arr) === 0){
    json_error("Livro não encontrado!!"); 
}
$livro = $arr[0];

$datacriacao = $livro["datacriacao"];
$datacriacao = explode('-', $datacriacao);
$datacriacao = array_reverse($datacriacao);
$datacriacao = implode("/", $datacriacao);

$horacriacao = $livro["horacriacao"];
$horacriacao = substr($horacriacao, 0, 8);

$criadoem = $datacriacao." ".$horacriacao;
json_success(array(
    "idlivro" => $livro["idlivro"],
    "nomelivro" => $livro["nome"],
    "biblioteca" => $livro["idbiblioteca"],
    "preco" => number_format( $livro["preco"], 2, ",", "."),
    "inputCriadoEm" => $criadoem
));

