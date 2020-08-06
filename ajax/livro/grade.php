<?php

require("../../def/function.php");

$connection = connection();

$query = implode(" ", [
    "SELECT livro.*, biblioteca.nome AS biblioteca",
    "FROM livro",
    "INNER JOIN biblioteca ON (livro.idbiblioteca = biblioteca.idbiblioteca)",
    "ORDER BY idlivro"
]);
$result = $connection->query($query);

//$result = $connection->query("SELECT * FROM livro ORDER BY idlivro");

$arr = $result->fetchAll(2);

json_success($arr);