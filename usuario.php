<?php
require  'includes/config/database.php';
$db = conectarDB();

$email = "coreo@coreo.com";
$password = "123456";

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$querry = "INSERT INTO USUARIOS (email, password) VALUES ('{$email}', '{$passwordHash}' )";

$resultado =mysqli_query($db,$querry);
?>