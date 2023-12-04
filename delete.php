<?php

if ( isset($_GET["id"]) ) {
    $id = $_GET["id"];

$servername = "localhost";
$username = "root";
$password = "";
$database = "teste";

// conexão
$connection = new mysqli($servername, $username, $password, $database);

$sql = "DELETE FROM produtos WHERE id=$id";
$connection->query($sql);
}
header("location:/crud/index.php");
?>
