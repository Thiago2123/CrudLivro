<?php

require("../../def/function.php");

$idlivro = $_GET["idlivro"];

$connection = connection();
$result = $connection->query("DELETE FROM livro WHERE idlivro = {$idlivro}");
if($result){
    json_success();
}else{
    $erro = $connection->errorInfo();
    json_error($erro[2]);
}