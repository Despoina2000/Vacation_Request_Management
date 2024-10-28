<?php

function get_username($username, $pdo){

$statement = $pdo->prepare("SELECT username FROM users WHERE username = :username;");
$statement->bindValue(':username', $username);
$statement->execute();

return $statement->fetch(PDO::FETCH_ASSOC);
}
